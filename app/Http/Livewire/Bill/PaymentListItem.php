<?php

namespace App\Http\Livewire\Bill;

use Livewire\Component;
use App\Models\BillPayment;

class PaymentListItem extends Component
{
    public BillPayment $payment;

    public function deletePayment(){
        $this->payment->delete();
        $this->emit('paymentsChanged');
    }

    public function render()
    {
        return view('livewire.bill.bill-payment-list-item');
    }
}
