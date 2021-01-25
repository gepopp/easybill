<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;

class NotificationPreview extends Component
{
    public Bill $bill;
    public $notifyclass;
    protected $notification;


    public function getFrom()
    {
        $from =  (new $this->notifyclass($this->bill, \Auth::user()))->toMail($this->bill->customer)->from;
        return '<' . $from[0] . '> ' . $from[1];
    }

    public function getSubject()
    {
        return (new $this->notifyclass($this->bill, \Auth::user()))->toMail($this->bill->customer)->subject;
    }

    public function getContent()
    {
        return base64_encode((new $this->notifyclass($this->bill, \Auth::user()))->toMail($this->bill->customer)->render());
    }

    public function render()
    {
        return view('livewire.notification-preview');
    }
}
