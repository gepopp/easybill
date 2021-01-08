<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;
use App\Models\Product;
use App\Models\BillPosition;

class BillRow extends Component
{

    public Bill $bill;
    public BillPosition $row;

    public $products = [];
    public $products_json = '[]';

    protected $listeners = ['resetOrderNumber'];

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


    public function fillIn($index)
    {
        $this->row->name = $this->products[$index]->name;
        $this->row->netto = $this->products[$index]->netto;
        $this->row->unit = $this->products[$index]->unit;
        $this->row->description = $this->products[$index]->description;
        $this->products_json = '[]';
        $this->update();
    }


    public function updated($propertyName)
    {
        if($propertyName == 'row.name'){
            if (strlen($this->row->name) <= 2) {
                $this->products_json = '[]';
            }

            $this->products_json = $this->products = Product::where('name', 'like', '%' . $this->row->name . '%')->get();
            if (count($this->products_json) == 0) {
                $this->products_json = '[]';
            } else {
                $this->products_json->toJson(JSON_PRETTY_PRINT);
            }
        }
    }


    public function update()
    {
       $data = $this->validate();

       $this->row->update($data['row']);
       $this->emit('resetOrderNumber');
       $this->emit('refreshTotals');

    }

    public function deleteRow(){

        $this->row->delete();
        $this->emit('resetOrderNumber');
        $this->emit('refreshTotals');

    }

    public function getNettoTotalProperty(){

        if($this->row->amount == '' || $this->row->netto == ''){
            return 0;
        }
        return number_format($this->row->amount * $this->row->netto, 2, ',', '.');

    }

    public function getBruttoTotalProperty(){

        if($this->row->amount == '' || $this->row->netto == '' || $this->row->vat == ''){
            return 0;
        }
        return number_format(($this->row->netto * $this->row->amount ) + ((( $this->row->netto * $this->row->amount ) * $this->row->vat)/100), 2, ',', '.');

    }

    public function resetOrderNumber(){

        $this->bill->refresh();

        for($i = 0; $i < count($this->bill->positions); $i++){
            if($this->bill->positions[$i]->id == $this->row->id){
                $this->row->update(['order_number' => $i + 1 ]);
            }
        }

    }

    public function render()
    {
        return view('livewire.bill.bill-row');
    }
}
