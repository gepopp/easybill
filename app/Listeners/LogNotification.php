<?php

namespace App\Listeners;

use App\Traits\Topflash;
use App\Jobs\BillReminderJob;
use App\Notifications\SendBillNotification;
use App\Notifications\BillReminderNotification;
use App\Models\UserEmailNotification;
use App\Notifications\ThankYouForPayingNotification;
use Illuminate\Notifications\Events\NotificationSent;

class LogNotification
{

    use Topflash;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        if( $event->notification instanceof SendBillNotification || $event->notification instanceof ThankYouForPayingNotification || $event->notification instanceof BillReminderNotification){

            $userNotification = new UserEmailNotification([
                'user_id'      => $event->notification->user->id,
                'customer_id'  => $event->notifiable->id,
                'notification' => get_class($event->notification),
                'via'          => 'system',
                'status'       => 'sent',
            ]);
            $userNotification->about()->associate($event->notification->bill);
            $userNotification->save();

            $this->topflash('emailSent', $event->notification->bill, $event->notification->user );
        }



    }
}
