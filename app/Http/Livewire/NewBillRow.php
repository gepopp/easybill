<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BillPosition;

class NewBillRow extends Component
{

    public $data;
    public $index;

    public BillPosition $row;

    protected $rules = [
        'row.order_number' => 'required',
        'row.bill_id'      => 'required',
        'row.name'         => 'required|min:5',
        'row.amount'       => 'required',
        'row.unit'         => 'required',
        'row.netto'        => 'required',
        'row.vat'          => 'required',
        'row.description'  => 'string',
    ];

    public function updated(){

        $data = $this->validate();
        BillPosition::create($data['row']);
        $this->emit('unsetNewRow');
        $this->emit('refreshTotals');


    }

    public function mount()
    {
        $this->row = new BillPosition($this->data);
    }



    public function render()
    {
        return view('livewire.new-bill-row');
    }
}
