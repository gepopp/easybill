<?php

namespace App\Mail;

use App\Models\LeadContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ColdLead extends Mailable
{
    use Queueable, SerializesModels;



    public $beacon;



    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LeadContact $contact, $beacon)
    {
        $this->contact = $contact;
        $this->beacon = $beacon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Wer betreut Ihre Webseite?')
                    ->to($this->contact)
                    ->view('newsletter.raw', ['beacon' => $this->beacon]);
    }
}
