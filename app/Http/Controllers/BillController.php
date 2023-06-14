<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Traits\Topflash;
use App\Models\Customer;
use App\Jobs\SendBillJob;
use App\Models\BillPayment;
use Illuminate\Http\Request;
use App\Jobs\BillReminderJob;
use App\Jobs\CreateBillPdfJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BillController extends Controller
{


    use Topflash;

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return view('bill.index');
    }


    public function create()
    {
        $customers = Customer::billable()->orderBy('company_name')->get();
        return view('bill.create')->with('customers', $customers);
    }


    public function store(Request $request)
    {
        $bill = Bill::create(array_merge(['user_id' => \auth()->id(), 'bill_status' => 'created'],
            $request->validate([
                'customer_id'  => 'required|exists:customers,id',
                'billing_date' => 'required|date',
                'bill_number'  => 'required|integer|min:1',
            ])));

        return redirect(route('bills.edit', $bill));


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Bill $bill
     */
    public function show(Bill $bill)
    {
        return view('bill.show')->with(['bill' => $bill]);
    }

    /**
     * Sent the E-Mail notification with bill attachment
     *
     * @param Bill $bill
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Bill $bill)
    {
        if (!Storage::exists($bill->document)) {
            $this->dispatch(new CreateBillPdfJob($bill, Auth::user()));
            $this->topflash('billSendingError', $bill);
            return redirect()->route('bills.edit', $bill);
        }

        if ($bill->is_storno_of && $bill->paid() < $bill->total('brutto')) {
            $this->makeStornoPayments($bill);
        }

        if ($bill->sent_at == null) {
            $bill->update(['sent_at' => now()]);
            $this->dispatch(new SendBillJob($bill, Auth::user()));
        }

        return redirect()->route('bills.show', $bill);
    }



    public function remind(Bill $bill)
    {
        if (!Storage::exists($bill->document)) {
            $this->dispatch(new CreateBillPdfJob($bill, Auth::user()));
            $this->topflash('billSendingError', $bill);
            return redirect()->route('bills.edit', $bill);
        }

        $this->dispatch(new BillReminderJob($bill, Auth::user()));

        return redirect()->route('bills.show', $bill);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Bill $bill
     */
    public function edit(Bill $bill)
    {
        return view('bill.edit')->with(['bill' => $bill]);
    }


    public function document(Bill $bill)
    {
        Storage::delete($bill->document);

        $bill->update(['document' => 'onqueue']);
        dispatch(new CreateBillPdfJob($bill, Auth::user()));

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

        $this->topflash('billDuplicated');
        return redirect()->route('bills.edit', $newbill);

    }

    public function storno(Bill $bill)
    {
        $newbill = Bill::create([
            'storno_id'    => $bill->id,
            'user_id'      => $bill->user_id,
            'customer_id'  => $bill->customer_id,
            'billing_date' => now(),
            'respite'      => $bill->respite,
            'sent_at'      => null,
            'generated_at' => now(),
            'prefix'       => $bill->prefix,
            'bill_number'  => Bill::getNextBillNumber(),
            'bill_status'  => 'generated',
            'document'     => null,
        ]);

        foreach ($bill->positions as $position) {
            $newposition = $position->replicate();
            $newposition->bill_id = $newbill->id;
            $newposition->amount = $newposition->amount * -1;
            $newposition->save();
        }


        $this->topflash('billStorno', $bill);
        return redirect()->route('bills.edit', $newbill);

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

        $this->topflash('billDeleted', $bill);
        return redirect()->route('bills.index');


    }

    /**
     * @param Bill $bill
     */
    public function makeStornoPayments(Bill $bill): void
    {
        BillPayment::create([
            'bill_id'      => $bill->id,
            'amount'       => $bill->total('brutto') - $bill->paid(),
            'payment_date' => now(),
        ]);

        BillPayment::create([
            'bill_id'      => $bill->storno_id,
            'amount'       => ($bill->total('brutto') - $bill->paid()) * -1,
            'payment_date' => now(),
        ]);
    }


    public function download(Bill $bill)
    {
        if(is_null($bill->sent_at)){
            $bill->forceFill(['sent_at' => now()]);
        }
        return Storage::download($bill->document);
    }

}
