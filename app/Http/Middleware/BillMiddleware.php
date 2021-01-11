<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Bill;
use App\Traits\Topflash;
use App\Models\BillSetting;
use App\Jobs\CreateBillPdfJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BillMiddleware
{

    use Topflash;


    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        //to show any bill route the user must enter his billing data
        $billSetting = BillSetting::pluck('setting_value', 'setting_name');
        $billSetting = $billSetting->filter(function ( $value, $key){
            return !empty($value);
        });

        if (!$billSetting->has('address', 'contactperson', 'contactphone', 'contactemail', 'prefix', 'bill_number', 'company_name', 'desired_respite')) {

            $this->topflash('billsettings');
            return redirect()->route('billsettings');

        }

        $bill = $request->bill;

        // create pdf if not exists on show
        if($request->routeIs('bills.show')){
            if (!Storage::exists($bill->document)) {
                dispatch(new CreateBillPdfJob($bill, Auth::user()));
            }
        }


        if($request->routeIs('bills.edit')){
            // Only not sent bill and no storno bills can be edited
            if ($bill->sent_at != null || $bill->is_storno_of || $bill->has_storno) {
                $this->topflash('billNotEidtable', $bill);
                return redirect(route('bills.show', $bill));
            }
        }


        if($request->routeIs('bills.duplicate')){
            // stronos cant be duplicated
            if ($bill->is_storno_of) {
                $this->topflash('billNotDuplicateable', $bill);
                return redirect()->route('bills.index');
            }
        }

        if($request->routeIs('bills.storno')){
            if ($bill->sent_at == null || $bill->is_storno_of || $bill->has_storno || $bill->paid() != 0.00) {
                $this->topflash('billNotStornoable', $bill);
                return redirect()->route('bills.index');
            }
        }

        if($request->routeIs('bills.destroy')){
            if($bill->sent_at != null){
                $this->topflash('billNotDeletable', $bill);
                return redirect()->route('bills.index');
            }
        }

        if($request->routeIs('bills.remind')){
            if(!Carbon::parse($bill->billing_date)->addDays($bill->respite + 1 )->isPast() && $bill->sent_at != null){
                $this->topflash('billNotRemindable', $bill);
                return redirect()->route('bills.show', $bill);
            }
        }

        return $next($request);
    }
}
