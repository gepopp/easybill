<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;

class Flash extends Component
{
    public $type;

    public $message = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->type = session()->get('topflash.type');
        $this->message = session()->get('topflash.message');
        session()->forget('topflash');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.flash');
    }
}
