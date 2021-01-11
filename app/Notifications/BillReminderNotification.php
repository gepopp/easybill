<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\User;
use App\Models\BillSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BillReminderNotification extends Notification
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
        Storage::disk('local')->put($this->bill->document, Storage::disk('s3')->get($this->bill->document));

        return (new MailMessage)
            ->from('dont-reply@mybilling.at', BillSetting::getSetting('contactperson', $this->user) . ' via mybilling')
            ->replyTo($notifiable->email)
            ->bcc('gerhard@poppgerhard.at')
            ->subject('Erinnerung von ' . BillSetting::getSetting('company_name', $this->user))
            ->greeting($notifiable->is_female ? 'Sehr geehrte Frau ' : 'Sehr geehrter Herr ' .
                $notifiable->academic_degree . ' ' . $notifiable->firstname . ' ' . $notifiable->last_name . ',')

            ->line(BillSetting::getSetting('contactperson', $this->user) . ' von ' .
                BillSetting::getSetting('company_name', $this->user) . ' hat Ihnen am ' . Carbon::parse($this->bill->sent_at)->format('d.m.Y') .
                ' die Rechnung ' .$this->bill->prefix . $this->bill->bill_number . ' gesendet. Sie finden diese Rechnung im Anhang.')

            ->line('Der Rechnungsbetrag von ' . $this->bill->total('brutto', 'euro') . ' € war bis zum ' .
                Carbon::parse($this->bill->billing_date)->addDays($this->bill->respite)->format('d.m.Y') .
                ' fällig. Bis dato wurde noch kein Zahlungseingang verbucht, deshalb erlauben wir uns Sie, an diese noch offene Rechnung zu erinnern.')

            ->salutation(new HtmlString('Mit freundlichen Grüßen,<br>' . BillSetting::getSetting('contactperson', $this->user) .
                ' via <a href="https://mybilling.at">mybilling.at</a>'))
            ->attach(Storage::disk('local')->path($this->bill->document));
    }
}
