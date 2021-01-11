<?php

namespace App\Observers;

use PDF;
use Carbon\Carbon;
use App\Models\Bill;
use App\Jobs\CreateBillPdfJob;
use App\Models\BillSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ThankYouForPayingNotification;

class BillObserver
{

    public function retrieved(Bill $bill)
    {
        $bill->bill_status = 'draft';

        if ($bill->generated_at != null) {
            $bill->bill_status = 'generated';
        }

        if ($bill->sent_at != null) {

            $bill->bill_status = 'sent';

            if (abs($bill->paid()) >= abs($bill->total('brutto'))) {
                $bill->bill_status = 'paid';
            }else{
                if (Carbon::parse($bill->billing_date)->addDays($bill->respite + 2)->isPast()){
                    $bill->bill_status = 'overdue';
                }
            }
        }

        $bill->update(['bill_status' => $bill->bill_status]);
    }
}
