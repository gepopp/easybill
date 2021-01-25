<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class TypeSelector extends Component
{
    public $is_company = false;


    public function render()
    {
        return view('livewire.customer.type-selector');
    }
}
