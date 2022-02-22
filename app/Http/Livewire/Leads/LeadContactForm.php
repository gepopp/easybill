<?php

namespace App\Http\Livewire\Leads;

use App\Models\Lead;
use Livewire\Component;
use App\Models\LeadContact;
use App\Notifications\LeadFirstContact;



class LeadContactForm extends Component {





    /**
     * @var $lead Lead
     */
    public $lead;


    public $contacts = [];



    public $name;





    public $position;





    public $email;





    public $phone;





    protected $rules = [
        'name'     => 'required|string|max:255',
        'position' => 'nullable|string|max:255',
        'email'    => 'required|email',
        'phone'    => 'nullable|string',
    ];





    public function mount( Lead $lead ) {

        $this->lead = $lead;
        $this->contacts = $lead->contacts->toArray();
    }





    public function submit() {

        $data = $this->validate();

        $this->lead->contacts()->create( $data );

        $this->reset( 'name', 'position', 'email', 'phone' );

        $this->contacts = $this->lead->fresh()->contacts->toArray();

    }





    public function trash( LeadContact $contact ) {

        $contact->delete();
        $this->contacts = $this->lead->fresh()->contacts->toArray();

    }



    public function sendFirstContact(LeadContact $contact){


        $contact->notify(new LeadFirstContact());


    }




    public function render() {

        return view( 'livewire.leads.lead-contact-form' );
    }
}
