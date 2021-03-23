<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;

class CompanySelect extends Component
{
    public $customer;
    public $companies;
    public $company = null;


    public function mount()
    {
        $this->companies = Customer::IsCompany()->get();

        if (!empty($this->customer)) {
            $this->company = $this->customer->company_id;
        }


    }


    public function set($id)
    {
        $this->company = $this->company == $id ? null : $id;
    }


    public function render()
    {
        return view('livewire.customer.company-select');
    }
}
