<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NewBillModal extends Component
{

    public $show = false;

    function showModal(){
        $this->show = !$this->show;
    }

    public function render()
    {
        return view('livewire.bill.new-bill-modal');
    }
}
