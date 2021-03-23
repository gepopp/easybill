<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\BillSetting;

class CustomerObserver
{


    public function saving($customer)
    {

        if (empty($customer->customer_number)) {
            $max = Customer::max('customer_number');
            if (empty($max)) {
                $customer->customer_number = BillSetting::getSetting('customer_number') ?? 1000;
            } else {
                $customer->customer_number = $max + 1;
            }
        }
    }

    public function deleting($customer)
    {
        $customer->contactperson->each(function ($item) {
            $item->update(['company_id' => null]);
        });
    }

}
