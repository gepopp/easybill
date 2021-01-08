<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;

class BillPaymentsList extends Component
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
