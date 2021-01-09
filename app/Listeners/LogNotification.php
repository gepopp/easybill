<?php

namespace App\Listeners;

use App\Traits\Topflash;
use App\Notifications\SendBill;
use App\Models\UserEmailNotification;
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
        if($event->notification instanceof SendBill ){
            $userNotification = new UserEmailNotification([
                'user_id'      => $event->notification->user->id,
                'customer_id'  => $event->notifiable->id,
                'notification' => get_class($event->notification),
                'via'          => 'system',
                'status'       => 'sent',
            ]);
            $userNotification->about()->associate($event->notification->bill);
            $userNotification->save();

            $this->topflash('billSent', $event->notification->bill, $event->notification->user );
        }



    }
}
