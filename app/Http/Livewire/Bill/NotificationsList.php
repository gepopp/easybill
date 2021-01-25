<?php

namespace App\Http\Livewire\Bill;

use App\Models\Bill;
use Livewire\Component;

class NotificationsList extends Component
{
    public Bill $bill;
    public $notifications;

    public function render()
    {
        return view('livewire.bill.bill-notifactions-list');
    }
}
