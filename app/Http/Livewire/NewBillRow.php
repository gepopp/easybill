<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\BillPosition;

class NewBillRow extends Component
{

    public $data;
    public $index;
    public $products = '[]';


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



    public function searchProducts()
    {
        if (strlen($this->row->name) <= 2) {
            return '[]';
        }
        $products = $this->products = Product::where('name', 'like', '%' . $this->row->name . '%')->get();
        if (count($products) == 0) {
            return '[]';
        } else {
            return $products->toJson(JSON_PRETTY_PRINT);
        }
    }


    public function fillIn($index)
    {
        $this->row->name = $this->products[$index]->name;
        $this->row->netto = $this->products[$index]->netto;
        $this->row->unit = $this->products[$index]->unit;
        $this->row->description = $this->products[$index]->description;


        $this->products = false;
        $this->updated();
        $this->emit('focus', 'amount');
    }


    public function updated()
    {

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
