<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NewsletterSubscriber;

class NewsletterForm extends Component
{

    public $name;
    public $email;
    public $agb;
    public $betatester;

    protected $rules = [
        'name'       => 'required|string',
        'email'      => 'email|required|unique:newsletter_subscribers,email',
        'agb'        => 'boolean|required',
        'betatester' => 'boolean|nullable',
    ];

    public function subscribe()
    {

        $data = $this->validate();
        $data['betatester'] = $data['betatester'] == null ? false : true;

        NewsletterSubscriber::create($data);
        session()->flash('message', 'Vielen Dank. Wir haben deine Anmeldung erhalten und melden uns in Kürze bei dir.');

    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
