<?php

namespace App\Http\Livewire\Bill;

use App\Models\Bill;
use Livewire\Component;

class ReminderModal extends Component
{
    public $show;
    public $warning = false;
    public Bill $bill;

    public function mount()
    {
        $this->warning = $this->bill->notifications()->where('notification', 'like', '%reminder%')->count();
    }

    public function render()
    {
        return view('livewire.bill.reminder-modal');
    }
}
