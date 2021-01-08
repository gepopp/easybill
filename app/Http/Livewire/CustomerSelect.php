<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;

class CustomerSelect extends Component
{
    public $search = '';

    public $search_result = null;
    public $search_result_json = '[]';

    protected $rules = [
      'search'  => 'required|string|min:3'
    ];




    public function updatedSearch(){

        if(strlen( $this->search ) <= 2) {
            $this->search_result_json = '[]';
            $this->emit('customer_search_empty');
        }else{
            $search = $this->search;
            $this->search_result = Customer::where('company_name', 'like', '%'.$search.'%')
                ->orWhere('first_name', 'like', '%'.$search.'%')
                ->orWhere('last_name', 'like', '%'.$search.'%')->get();

            if($this->search_result == null){
                $this->search_result_json = '[]';
            }
            $this->search_result_json = $this->search_result->toJson(JSON_PRETTY_PRINT);
        }
    }

    public function fillIn($index){

        $this->search = $this->search_result[$index]->company_name;
        $this->emit('customer_selected', $this->search_result[$index]->id);
        $this->search_result_json = '[]';

    }

    public function render()
    {
        return view('livewire.customer-select');
    }
}
