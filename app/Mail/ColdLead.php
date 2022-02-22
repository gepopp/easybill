<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ColdLead extends Mailable
{
    use Queueable, SerializesModels;



    public $beacon;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($beacon)
    {
        $this->beacon = $beacon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Wer betreut Ihre Webseite?')->view('newsletter.raw', ['beacon' => $this->beacon]);
    }
}
