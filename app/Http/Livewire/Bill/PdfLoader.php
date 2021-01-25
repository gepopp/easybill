<?php

namespace App\Http\Livewire\Bill;

use App\Models\Bill;
use Response;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class PdfLoader extends Component
{

    public Bill $bill;
    public $link;
    public $isPdf = false;

    public function pollLink(){

        $this->bill->refresh();
        $this->link = $this->bill->document;

        if(Storage::exists($this->link)){
            $this->isPdf = true;
            $this->link = Storage::temporaryUrl($this->bill->document, now()->add(5, 'seconds'));
            $this->link .= '#toolbar=0&navpanes=0&scrollbar=0';

        }
    }
    public function render()
    {
        return view('livewire.bill.bill-p-d-f-buttons');
    }
}
