<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;

class BillNotifactionsList extends Component
{
    public Bill $bill;
    public $notifications;


    public function render()
    {
        return view('livewire.bill.bill-notifactions-list');
    }
}
