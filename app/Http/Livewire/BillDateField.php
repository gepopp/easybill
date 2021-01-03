<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Bill;
use Livewire\Component;

class BillDateField extends Component
{

    public Bill $bill;

    public $date;

    public $edit = false;

    protected $rules = [
      'date' => 'required|date|after_or_equal:today'
    ];

    public function updated(){

        $data = $this->validate();
        $this->bill->update([
           'billing_date' => $data['date']
        ]);
//        $this->edit = false;
    }


    public function mount(){
        $this->date = Carbon::parse($this->bill->billing_date)->format('Y-m-d');
    }

    public function getFormatedProperty(){
        return Carbon::parse($this->bill->billing_date)->format('Y-m-d');
    }

    public function updateDate(){

    }

    public function render()
    {
        return view('livewire.bill-date-field');
    }
}
