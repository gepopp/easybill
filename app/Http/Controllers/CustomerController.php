<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.index')->with('customers', Customer::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'company_name'     => 'string|nullable',
            'is_female'        => 'required|boolean',
            'academic_degree'  => 'string|max:50|nullable',
            'first_name'       => 'string|max:50',
            'last_name'        => 'string|max:50',
            'address'          => 'string|',
            'address_addition' => 'string|nullable',
            'zip'              => 'string|max:50',
            'city'             => 'string|max:50',
            'email'            => 'email|required',
        ]);

        $data['user_id'] = \Auth::id();

        $customer = new Customer($data);
        $customer->save();

        return redirect(route('customers.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer     $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {

        $customer->update($request->validate([
            'company_name'     => 'string|max:50|nullable',
            'is_female'        => 'required|boolean',
            'academic_degree'  => 'string|max:50|nullable',
            'first_name'       => 'string|max:50',
            'last_name'        => 'string|max:50',
            'address'          => 'string|max:50',
            'address_addition' => 'string|max:50|nullable',
            'zip'              => 'string|max:50',
            'city'             => 'string|max:50',
            'email'            => 'email|required',
        ]));

        return redirect(route('customers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back();
    }
}
