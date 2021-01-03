<?php

namespace App\Http\Controllers;

use App\Models\BillSetting;
use Illuminate\Http\Request;

class BillSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillSetting  $billSetting
     * @return \Illuminate\Http\Response
     */
    public function show(BillSetting $billSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillSetting  $billSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(BillSetting $billSetting)
    {
        return view('bill.settings')->with('settings', BillSetting::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillSetting  $billSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillSetting $billSetting)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillSetting  $billSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillSetting $billSetting)
    {
        //
    }
}
