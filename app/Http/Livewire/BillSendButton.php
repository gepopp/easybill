<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class BillSendButton extends Component
{
    public $pdf = false;
    public Bill $bill;


    public function checkPdf(){
        $this->pdf = Storage::exists($this->bill->document);
    }


    public function render()
    {
        return view('livewire.bill-send-button');
    }
}
