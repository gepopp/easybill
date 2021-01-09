<?php

namespace App\Notifications;

use App\Models\Bill;
use App\Models\User;
use App\Models\BillSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ThankYouForPaying extends Notification
{
    use Queueable;

    public Bill $bill;
    public User $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bill, $user)
    {
        $this->bill = $bill;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('dont-reply@mybilling.at', BillSetting::getSetting('contactperson') . ' via mybilling')
            ->replyTo($notifiable->email)
            ->bcc('gerhard@poppgerhard.at')
            ->subject('Danke für Ihre Zahlung.')
            ->greeting($notifiable->is_female ? 'Sehr geehrte Frau ' : 'Sehr geehrter Herr ' .
                $notifiable->academic_degree . ' ' . $notifiable->firstname . ' ' . $notifiable->last_name . ',')

            ->line(BillSetting::getSetting('contactperson') . ' von ' .
                BillSetting::getSetting('company_name') . ' hat Ihre Zahlung zur ' .
                $this->bill->prefix . $this->bill->bill_number . ' verbucht.')

            ->line(new HtmlString('<strong>Danke.</strong><br> Die Rechnung ist nun beglichen.'))


            ->salutation( new HtmlString('Mit freundlichen Grüßen,<br>' . BillSetting::getSetting('contactperson') .
                ' via <a href="https://mybilling.at">mybilling.at</a>'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
