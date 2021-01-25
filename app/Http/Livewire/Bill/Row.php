<?php

namespace App\Http\Livewire\Bill;

use App\Models\Bill;
use Livewire\Component;
use App\Models\Product;
use App\Models\BillPosition;

class Row extends Component
{

    public Bill $bill;
    public BillPosition $row;

    public $products;

    protected $listeners = ['resetOrderNumber'];

    protected $rules = [
        'products'         => 'nullable',
        'row.order_number' => 'required',
        'row.bill_id'      => 'required',
        'row.name'         => 'required|min:5',
        'row.amount'       => 'required',
        'row.unit'         => 'required',
        'row.netto'        => 'required',
        'row.vat'          => 'required',
        'row.description'  => 'string',
    ];

    public function mount()
    {
        $this->products = [];
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'row.name') {
            if (strlen($this->row->name) <= 2) {
                $this->products = [];
            } else {
                $this->products = Product::where('name', 'like', '%' . $this->row->name . '%')->get()->toArray();
            }
        }

        $this->validateOnly($propertyName);

        $this->row->update();
        $this->emit('resetOrderNumber');
        $this->emit('refreshTotals');


    }

    public function deleteRow()
    {
        $this->row->delete();
        $this->emit('resetOrderNumber');
        $this->emit('refreshTotals');
    }

    public function fillIn($index)
    {
        $this->row->update([
            'name'        => $this->products[$index]['name'],
            'netto'       => $this->products[$index]['netto'],
            'unit'        => $this->products[$index]['unit'],
            'description' => $this->products[$index]['description'],
            'amount'      => 1,
        ]);
        $this->row->refresh();
        $this->products = [];
    }


    public function getNettoTotalProperty()
    {

        if ($this->row->amount == '' || $this->row->netto == '') {
            return 0;
        }
        return number_format($this->row->amount * $this->row->netto, 2, ',', '.');

    }

    public function getBruttoTotalProperty()
    {

        if ($this->row->amount == '' || $this->row->netto == '' || $this->row->vat == '') {
            return 0;
        }
        return number_format(($this->row->netto * $this->row->amount) + ((($this->row->netto * $this->row->amount) * $this->row->vat) / 100), 2, ',', '.');

    }

    public function resetOrderNumber()
    {

        $this->bill->refresh();

        for ($i = 0; $i < count($this->bill->positions); $i++) {
            if ($this->bill->positions[$i]->id == $this->row->id) {
                $this->row->update(['order_number' => $i + 1]);
            }
        }

    }

    public function render()
    {
        return view('livewire.bill.bill-row');
    }
}
