<?php

namespace App\Http\Livewire\Bill;

use Carbon\Carbon;
use App\Models\Bill;
use Livewire\Component;

class DateField extends Component
{

    public Bill $bill;

    public $date;
    public $respite;

    public $edit = false;

    protected $rules = [
        'date' => 'required|date|after_or_equal:today',
        'respite' => 'required|numeric|integer|min:1'
    ];

    public function updated($propertyName)
    {
        if($propertyName != 'edit'){
            $data = $this->validate();

            $this->bill->update([
                'billing_date' => $data['date'],
                'respite'      => $data['respite'],
            ]);
            $this->edit = false;
        }
    }


    public function mount()
    {
        $this->date = Carbon::parse($this->bill->billing_date)->format('Y-m-d');
        $this->respite = $this->bill->respite;
    }

    public function getFormatedProperty()
    {
        return Carbon::parse($this->bill->billing_date)->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.bill.bill-date-field');
    }
}
