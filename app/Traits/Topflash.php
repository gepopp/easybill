<?php


namespace App\Traits;


use App\Models\UserFlash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait Topflash
{

    private $index = 'topflash';
    private $flashing_user;

    public function topflash($index, $object = false, $user = false)
    {

        $this->flashing_user = $user == false ? Auth::user() : $user;
        $message = $this->getMessage($index, $object);


        UserFlash::create([
            'user_id' => $this->flashing_user->id,
            'type'    => $message['type'],
            'message' => $message['message'],
        ]);
    }


    private function getMessage($index, $object = false)
    {

        $messages = [
            'billSendingError'     => [
                'type'    => 'error',
                'message' => "Deine Rechnung [prefix] [bill_number] konnte nicht gesendet werden. Speichere die Rechnung nochmals und warte bis das Pdf geladen ist.",
            ],
            'billSent'             => [
                'type'    => 'success',
                'message' => "Deine Rechnung [prefix] [bill_number] wurde versendet.",
            ],
            'billEmailQueued'      => [
                'type'    => 'success',
                'message' => "Deine Rechnung [prefix] [bill_number] wurde für den Versand vorbereitet.",
            ],
            'billDuplicated'       => [
                'type'    => 'success',
                'message' => 'Die Rechnung wurde erfolgreich dupliziert.',
            ],
            'billNotEidtable'      => [
                'type'    => 'error',
                'message' => 'Diese Rechnung kann nicht mehr bearbeitet werden.',
            ],
            'billNotDuplicateable' => [
                'type'    => 'error',
                'message' => 'Stornos können nicht dupliziert werden.',
            ],
            'billNotStornoable'    => [
                'type'    => 'error',
                'message' => 'Diese Rechnung kann nicht Storniert werden. Wenn du sie noch nicht gesendet hast lösche die Rechnung einfach.',
            ],
            'billNotDeletable'    => [
                'type'    => 'error',
                'message' => 'Diese Rechnung kann nicht gelöscht werden.',
            ],
            'billNotRemindable'    => [
                'type'    => 'error',
                'message' => 'Zahlungserinnerungen können erst einen Tag nach Ablauf der Zahlungsfrist gesendet werden.',
            ],
            'billStorno'           => [
                'type'    => 'error',
                'message' => "Deine Rechnung [prefix] [bill_number] wurde storniert. Du kannst die Stornorechnung jetzt an den Kunden senden.",
            ],
            'billDeleted'          => [
                'type'    => 'error',
                'message' => "Deine Rechnung [prefix] [bill_number] wurde gelöscht.",
            ],
            'billsettings'         => [
                'type'    => 'error',
                'message' => 'Bitte fülle zuerst deine Rechnungsdaten aus.',
            ],
            'emailSent'            => [
                'type'    => 'success',
                'message' => 'E-Mail wurde gesendet.',
            ],

        ];

        if ($object) {

            return $this->replaceObjectVariables($messages[$index], $object);
        }

        return $messages[$index];
    }

    /**
     * @param $messages
     * @param $object
     * @return array
     */
    private function replaceObjectVariables($messages, $object): array
    {
        preg_match_all('/\[(.*?)\]/', $messages['message'], $matches);


        $message = $messages['message'];

        foreach ($matches[0] as $match) {

            $trimmed = trim($match, "[] \t\n\r");

            $return = [];

            $message = str_replace($match, $object->{$trimmed}, $message);

        }
        return [
            'type'    => $messages['type'],
            'message' => $message,
        ];
    }


}
