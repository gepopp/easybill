<?php

namespace App\Observers;

use PDF;
use Carbon\Carbon;
use App\Models\Bill;
use App\Jobs\CreateBillPdf;
use App\Models\BillSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BillObserver
{


    public function retrieved(Bill $bill){

        if($bill->generated_at != null){
            $bill->bill_status = 'generated';
        }else{
            $bill->bill_status = 'draft';
        }

        if($bill->sent_at != null){
            $bill->bill_status = 'sent';
        }

        if($bill->bill_status == 'sent'){
            if($bill->unformatedPaid >= $bill->unformatedBruttoTotal){
                $bill->bill_status = 'paid';
            }

            $desired_respite = BillSetting::where('setting_name', 'desired_respite')->first('setting_value')->setting_value ?? 7;
            if(Carbon::parse($bill->billing_date)->addDays($desired_respite)->isPast() && $bill->unformatedPaid < $bill->unformatedBruttoTotal){
                $bill->bill_status = 'overdue';
            }
        }
        $bill->update(['bill_status' => $bill->bill_status]);


        if(!Storage::exists($bill->document)){
            dispatch(new CreateBillPdf($bill, Auth::user()));
        }


    }

    /**
     * Handle the bill "updated" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function updated(Bill $bill)
    {
        Bill::withoutEvents(function () use ($bill) {

            unset($bill->bill_status_formatted);
            $bill->update([
                'document' => 'onqueue',
            ]);

        });
        dispatch(new CreateBillPdf($bill, Auth::user()));
    }


    public function updating(Bill $bill){
        unset($bill->bill_status_formatted);
    }
}
