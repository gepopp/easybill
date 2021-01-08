<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;
use App\Models\BillPayment;

class AddBillPaymentModal extends Component
{
    public $show = false;
    public Bill $bill;
    public $amount;
    public $payment_date;
    public $to_pay;

    protected $listeners = ['paymentsChanged'];

    protected $rules = [
      'amount' => 'required|numeric|min:0.01',
      'payment_date' => 'required|date|after_or_equal:today'
    ];

    public function paymentsChanged(){
        $this->bill->refresh();
        $this->amount = $this->to_pay = $this->bill->total('brutto') - $this->bill->paid();
    }

    public function mount(){
        $this->payment_date = now()->format('Y-m-d');
        $this->amount = $this->to_pay = $this->bill->total('brutto') - $this->bill->paid();
    }

    public function createPayment(){

        $data = $this->validate();
        $data['bill_id'] = $this->bill->id;

        BillPayment::create($data);

        $this->emit('paymentsChanged');

        $this->show = false;

    }

    public function resetAmount(){
        $this->amount = $this->to_pay;
    }

    public function showModal(){
        $this->show = !$this->show;
    }

    public function render()
    {
        return view('livewire.add-bill-payment-modal');
    }
}
