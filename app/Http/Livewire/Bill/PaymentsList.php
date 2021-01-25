<?php

namespace App\Http\Livewire\Bill;

use App\Models\Bill;
use Livewire\Component;

class PaymentsList extends Component
{
    public Bill $bill;

    protected $listeners = ['paymentsChanged'];

    public function paymentsChanged(){
        $this->bill->refresh();
    }

    public function render()
    {
        return view('livewire.bill.bill-payments-list');
    }
}
