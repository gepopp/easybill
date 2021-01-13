<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CustomerTypeSelector extends Component
{
    public $is_company = false;


    public function render()
    {
        return view('livewire.customer-type-selector');
    }
}
