<?php

namespace App\Notifications;

use App\Mail\ColdLead;
use App\Models\MailTrack;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;



class LeadFirstContact extends Notification {





    use Queueable;



    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via( $notifiable ) {

        return [ 'mail' ];
    }





    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail( $notifiable ) {

        return new ColdLead( $notifiable, $this->track( $notifiable ) );
    }





    public function track( $notifiable ) {

        $tracker = MailTrack::create( [
            'recipient_id'   => $notifiable->id,
            'recipient_type' => get_class( $notifiable ),
            'mail_name'      => 'Cold Lead Erstmail'
        ] );
        $tracker->save();

        return route( 'beacon', $tracker );

    }





    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray( $notifiable ) {

        return [
            //
        ];
    }
}
