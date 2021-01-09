<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\UserFlash;
use Illuminate\Support\Facades\Auth;

class TopFlash extends Component
{
    public $messages = [];

    public $show = false;
    public $message = false;
    public $type = false;


    public function pullMessage()
    {

            $message = UserFlash::oldest()->first();


            if ($message) {

                $this->type = $message->type;
                $this->message = $message->message;

                $message->delete();

                $this->show = true;
            }

    }

    public function render()
    {
        return view('livewire.top-flash');
    }
}
