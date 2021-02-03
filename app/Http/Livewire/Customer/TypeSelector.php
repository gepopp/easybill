<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class TypeSelector extends Component
{
    public $is_company = 0;

    function mount(){
        $this->is_company = old('is_company') ?? 0;
    }

    public function render()
    {
        return view('livewire.customer.type-selector');
    }
}
