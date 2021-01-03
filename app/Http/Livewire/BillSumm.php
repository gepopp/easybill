<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;

class BillSumm extends Component
{

    public Bill $bill;

    public $netto;
    public $vat;
    public $brutto;

    protected $listeners = ['refreshTotals'];


    public function mount(){
        $this->calculate();
    }

    public function refreshTotals(){

        $this->netto = 0;
        $this->vat = 0;
        $this->brutto = 0;

        $this->bill->refresh();
        $this->calculate();
    }


    public function calculate(){
        foreach($this->bill->positions as $position){
            $this->netto += $position->netto * $position->amount;
            $this->vat += ( ($position->netto * $position->amount) * $position->vat) / 100;
            $this->brutto += ( ($position->netto * $position->amount ) + ( ( ( $position->netto * $position->amount) * $position->vat) / 100));
        }
    }

    public function render()
    {
        return view('livewire.bill-summ');
    }
}
