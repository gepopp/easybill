<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;

class BillIndexTable extends Component
{

    use WithPagination;


    public $search = [
        'start' => '1970-01-01',
        'end' => '4000-01-01',
        'customer_id' => false,
        'stati' => [
            'draft',
            'generated',
            'sent',
            'paid',
            'overdue',

        ],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function hydrate(){
        if(empty($this->start)) $this->search['start'] = '1970-01-01';
        if(empty($this->end)) $this->search['end'] = '4000-01-01';
    }

    public function updatedSearch(){
        $this->search['start'] = Carbon::parse($this->search['start'])->addDay()->format('Y-m-d');
        $this->search['end'] = Carbon::parse($this->search['end'])->addDay()->format('Y-m-d');
    }


    protected $listeners = ['customer_selected','customer_search_empty'];

    public function customer_search_empty(){
        $this->search['customer_id'] = false;
    }

    public function customer_selected($id){
        $this->search['customer_id'] = $id;
    }



    public function render()
    {
        return view('livewire.bill.bill-index-table', [
            'bills' => Bill::where(function ($query){
                $query->whereIn('bill_status', $this->search['stati']);
                    if($this->search['customer_id']){
                        $query->where('customer_id', $this->search['customer_id']);
                    }
            })
                ->whereBetween('billing_date', [$this->search['start'], $this->search['end']])
                ->paginate(15),
        ]);
    }


//    public function paginationView()
//    {
//        return 'livewire.pagination-de';
//    }
}
