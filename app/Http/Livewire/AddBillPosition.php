<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bill;
use App\Models\BillPosition;
use http\Exception\UnexpectedValueException;

class AddBillPosition extends Component
{

    public Bill $bill;

    public $new_rows = false;

    protected $listeners = ['unsetNewRow', 'deleteBillRow'];

    public function deleteBillRow($id){

        BillPosition::find($id)->delete();
        $this->bill->refresh();
        $this->emit('refreshTotals');

    }

    public function addRow()
    {
       $this->new_rows = [
            'order_number' => $this->bill->positions()->count() + 1,
            'bill_id'      => $this->bill->id,
            'name'         => '',
            'amount'       => 1,
            'unit'         => '',
            'netto'        => '',
            'vat'          => 20,
            'description'  => '',
        ];
        $this->emit('new_row', true );
    }

    public function unsetNewRow(){
       $this->new_rows = false;
       $this->emit('new_row', false );
    }

    public function render()
    {
        return view('livewire.add-bill-position');
    }
}
