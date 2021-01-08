<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;

class BillIndexTable extends Component
{

    use WithPagination;

    public $search = [
        'customer_id' => false,
        'stati' => [
            'draft',
            'generated',
            'sent',
            'paid',
            'overdue',

        ],
    ];

    protected $listeners = ['customer_selected','customer_search_empty'];

    public function customer_search_empty(){
        $this->search['customer_id'] = false;
    }

    public function customer_selected($id){
        $this->search['customer_id'] = $id;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.bill.bill-index-table', [
            'bills' => Bill::where(function ($query){
                $query->whereIn('bill_status', $this->search['stati']);
                    if($this->search['customer_id']){
                        $query->where('customer_id', $this->search['customer_id']);
                    }
            })->paginate(20),
        ]);
    }


    public function paginationView()
    {
        return 'livewire.pagination-de';
    }
}
