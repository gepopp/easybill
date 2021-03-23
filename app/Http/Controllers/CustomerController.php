<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Traits\Topflash;
use Illuminate\Http\Request;
use App\Http\Livewire\CustomerIndexPage;

class CustomerController extends Controller
{

    use Topflash;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.index', ['customers' => Customer::IsParent()->get()]);
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

        $data = $this->validated($request);
        $customer = new Customer($data);
        $customer->save();

        return redirect(route('customers.index', $customer));

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

        $customer->update($this->validated($request));
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



        if(!empty($customer->bills) || !empty($customer->company->bills)){
            $this->topflash('customerNotDeletable');
            return back();
        }

        $customer->delete();
        return back();
    }


    function validated($request)
    {

        $data = $request->validate([
            'is_company'       => 'required|boolean',
            'company_name'     => 'exclude_if:is_company,0|required|string',
            'company_id'       => 'nullable|exists:customers,id',
            'is_female'        => 'exclude_if:is_company,1|required|boolean',
            'academic_degree'  => 'string|max:50|nullable',
            'first_name'       => 'string|max:50|nullable',
            'last_name'        => 'exclude_if:is_company,1|string|max:50|required',
            'address'          => 'string|nullable',
            'address_addition' => 'string|nullable',
            'zip'              => 'string|max:50|nullable',
            'city'             => 'string|max:50|nullable',
            'email'            => 'nullable|email:dns,rfc',
            'phone'            => 'string|nullable',
        ]);

        if ($data['is_company']) {
            unset($data['academic_degree']);
            unset($data['first_name']);
            unset($data['last_name']);
        }

        $data['user_id'] = \Auth::id();

        return $data;
    }


}
