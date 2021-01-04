<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\BillSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendBill extends Notification
{
    use Queueable;

    public $settings;
    public Bill $bill;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bill)
    {
        $this->settings = BillSetting::all()->pluck('setting_value', 'setting_name');
        $this->bill = $bill;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('dont-reply@mybilling.at', $this->settings['contactperson'] . ' via mybilling')
            ->subject('Neue Rechnung von ' . $this->settings['company_name'])
            ->greeting($notifiable->is_female ? 'Sehr geehrte Frau ' : 'Sehr geehrter Herr ' .
                $notifiable->academic_degree . ' ' . $notifiable->firstname . ' ' . $notifiable->last_name . ',')

            ->line($this->settings['contactperson'] . ' von ' .
                $this->settings['company_name'] . ' hat Ihnen die Rechnung ' .
                $this->settings['prefix'] . $this->bill->bill_number . ' gesendet. Sie finden diese Rechnung im Anhang.')

            ->line('Bitte überweisen Sie den Rechnungsbetrag über ' . $this->bill->bruttoTotal . ' € bis zum ' .
                Carbon::parse($this->bill->billing_date)->addDays($this->settings['desired_respite'])->format('d.m.Y') .
                ' auf eines der in der Rechnung angegebenen Konten.')

            ->salutation( new HtmlString('Mit freundlichen Grüßen,<br>' . $this->settings['contactperson'] .
                ' via <a href="https://mybilling.at">mybilling.at</a>'))

            ->attachData(file_get_contents(Storage::temporaryUrl($this->bill->document, now()->add(3, 'minutes'))),
                $this->settings['prefix'] . $this->bill->bill_number . '.pdf',
                [
                    'mime' => 'application/pdf',
                ]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
