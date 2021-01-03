<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\BillSetting;
use Illuminate\Http\Request;
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
        return view('bill.index')->with('bills', Bill::all());
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
        if ($bill->generated_at == null) {
            $bill->update(['generated_at' => Carbon::now()]);
        }

        return view('bill.show')->with(['bill' => $bill, 'settings' => $bill->getSettings()]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {

        if ($bill->generated_at != null) {
            return redirect(route('bills.show', $bill));
        }

        return view('bill.edit')->with(['bill' => $bill])->with('settings', $bill->getSettings());
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }




}
