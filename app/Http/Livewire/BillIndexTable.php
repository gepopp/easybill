<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BillIndexTable extends Component
{
    public $bills;


    public function render()
    {
        return view('livewire.bill.bill-index-table');
    }
}
