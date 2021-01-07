<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\BillSetting;
use App\Jobs\CreateBillPdf;
use App\Models\BillPayment;
use Illuminate\Http\Request;
use App\Notifications\SendBill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::all();

        return view('bill.index')->with('bills', $bills);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bill.create')->with(['customers' => Customer::all(), 'settings' => BillSetting::all()->pluck('setting_value', 'setting_name')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id'  => 'required|exists:App\Models\Customer,id',
            'billing_date' => 'required|date|after_or_equal:today',
            'bill_number'  => 'required|numeric|unique:bills,bill_number',
        ]);
        $data['user_id'] = Auth::id();
        $data['bill_status'] = 'draft';

        $bill = new Bill($data);
        $bill->save();

        return redirect(route('bills.edit', $bill));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        if (!Storage::exists($bill->document)) {
            dispatch(new CreateBillPdf($bill, Auth::user()));
        }


        return view('bill.show')->with(['bill' => $bill, 'settings' => $bill->getSettings()]);
    }


    /**
     * Sent the E-Mail notification with bill attachment
     *
     * @param Bill $bill
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Bill $bill)
    {

        if ($bill->sent_at == null) {
            $bill->customer->notify(new SendBill($bill));

            Bill::withoutEvents(function () use ($bill) {

                unset($bill->bill_status_formatted);
                $bill->update([
                    'sent_at' => now(),
                ]);

            });
        }
        return redirect()->route('bills.show', $bill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        if ($bill->sent_at != null || $bill->storno_id != null) {
            return redirect(route('bills.show', $bill));
        }
        return view('bill.edit')->with(['bill' => $bill])->with('settings', $bill->getSettings());
    }


    /**
     * update the bill
     *
     * @param Bill $bill
     */
    public function update(Request $request, Bill $bill)
    {
        $bill->update([
            'generated_at' => now(),
        ]);
        return redirect()->route('bills.show', $bill);
    }


    public function duplicate(Bill $bill)
    {


        $newbill = Bill::create([
            'user_id'      => $bill->user_id,
            'storno_id'    => null,
            'customer_id'  => $bill->customer_id,
            'billing_date' => now(),
            'respite'      => $bill->respite,
            'sent_at'      => null,
            'generated_at' => null,
            'paid_at'      => null,
            'prefix'       => $bill->prefix,
            'bill_number'  => Bill::getNextBillNumber(),
            'bill_status'  => 'draft',
            'document'     => null,
        ]);

        foreach ($bill->positions as $position) {
            $newposition = $position->replicate();
            $newposition->bill_id = $newbill->id;
            $newposition->save();
        }

        return redirect()->route('bills.edit', $newbill)->with('settings', $bill->getSettings());

    }

    public function storno(Bill $bill)
    {
        if ($bill->sent_at == null || $bill->storno_id != null) {
            return redirect()->route('bills.index')->with('bills', Bill::all());
        }

        $newbill = Bill::create([
            'storno_id'    => $bill->id,
            'user_id'      => $bill->user_id,
            'customer_id'  => $bill->customer_id,
            'billing_date' => now(),
            'respite'      => $bill->respite,
            'sent_at'      => null,
            'generated_at' => now(),
            'paid_at'      => now(),
            'prefix'       => $bill->prefix,
            'bill_number'  => Bill::getNextBillNumber(),
            'bill_status'  => 'generated',
            'document'     => null,
        ]);

        foreach ($bill->positions as $position) {
            $newposition = $position->replicate();
            $newposition->bill_id = $newbill->id;
            $newposition->netto = $newposition->netto * -1;
            $newposition->save();
        }

        BillPayment::create([
            'bill_id'      => $bill->id,
            'amount'       => $bill->unformatedBruttoTotal,
            'payment_date' => now(),
        ]);

        BillPayment::create([
            'bill_id'      => $newbill->id,
            'amount'       => $newbill->unformatedBruttoTotal,
            'payment_date' => now(),
        ]);

        Bill::withoutEvents(function () use ($bill) {
            unset($bill->bill_status_formatted);
            $bill->update(['paid_at' => now()]);
        });

        return redirect()->route('bills.edit', $newbill)->with('settings', $bill->getSettings());

    }


    /**
     * delete bill and all relations and pdf
     *
     * @param Bill $bill
     */
    public function destroy(Bill $bill)
    {

        Storage::delete($bill->document);

        foreach ($bill->positions as $position) {
            $position->delete();
        }
        $bill->delete();

        return redirect()->route('bills.index');


    }

}
