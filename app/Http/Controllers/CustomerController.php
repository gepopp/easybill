<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Livewire\CustomerIndexPage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.index');
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
            'is_company'       => 'required|boolean',
            'company_name'     => 'exclude_if:is_company,0|required|string',
            'is_female'        => 'exclude_if:is_company,1|required|boolean',
            'academic_degree'  => 'string|max:50|nullable',
            'first_name'       => 'string|max:50|nullable',
            'last_name'        => 'exclude_if:is_company,1|string|max:50|required',
            'address'          => 'string|nullable',
            'address_addition' => 'string|nullable',
            'zip'              => 'string|max:50|nullable',
            'city'             => 'string|max:50|nullable',
            'email'            => 'email|required',
            'phone'            => 'string|nullable',
        ]);

        if($data['is_company']){
            unset($data['academic_degree']);
            unset($data['first_name']);
            unset($data['last_name']);
        }else{
            unset($data['company_name']);
        }

        $data['user_id'] = \Auth::id();

        $customer = new Customer($data);
        $customer->save();

        return redirect(route('customers.edit', $customer));

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
