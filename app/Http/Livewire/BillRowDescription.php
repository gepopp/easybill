<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;
use App\Models\BillPosition;

class BillRowDescription extends Component
{
    public Bill $bill;
    public BillPosition $row;

    protected $rules = [
      'row.description' => 'string'
    ];

    public function updated(){
        $data = $this->validate();
        $this->row->update($data['row']);
        $this->emit('descriptionUpdated', $this->row->description);
    }

    public function render()
    {
        return view('livewire.bill.bill-row-description');
    }
}
