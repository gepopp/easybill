<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BillPayment;

class BillPaymentListItem extends Component
{
    public BillPayment $payment;

    public function deletePayment(){
        $this->payment->delete();
        $this->emit('paymentsChanged');
    }

    public function render()
    {
        return view('livewire.bill-payment-list-item');
    }
}
