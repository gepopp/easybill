<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class BillPresendModal extends Component
{
    public $show = false;
    public $pdf = false;
    public Bill $bill;
    public $content;
    protected $notification;
    public $notifyclass;
    public $route;
    public $btntext;



    public function getFrom()
    {
        return implode(', ',  (new $this->notifyclass($this->bill, \Auth::user()))->toMail($this->bill->customer)->from );
    }

    public function getSubject()
    {
        return (new $this->notifyclass($this->bill, \Auth::user()))->toMail($this->bill->customer)->subject;
    }

    public function getContent()
    {
        return (new $this->notifyclass($this->bill, \Auth::user()))->toMail($this->bill->customer)->render();
    }

    public function checkPdf()
    {
        $this->pdf = Storage::exists($this->bill->document);
    }


    public function render()
    {
        return view('livewire.bill-presend-modal');
    }
}
