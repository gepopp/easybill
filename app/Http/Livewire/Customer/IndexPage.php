<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;

class IndexPage extends Component
{

    public $customers = [];

    public function mount(){

        $this->customers = Customer::orderBy('company_name')->get();

    }

    public function render()
    {
        return view('livewire.customer.index-page');
    }
}
