<?php

namespace App\Jobs;

use App\Models\Bill;
use App\Models\User;
use App\Traits\Topflash;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use App\Notifications\BillReminderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BillReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Topflash;


    public Bill $bill;
    public User $user;
    public Customer $customer;
    public BillReminderJob $notification;




    public function __construct($bill, $user)
    {
        $this->bill = $bill->withoutRelations();
        $this->user = $user->withoutRelations();
        $this->customer = Customer::withoutGlobalScopes()->find($this->bill->customer_id)->withoutRelations();;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->topflash('billEmailQueued', $this->bill, $this->user);
        $this->customer->notify(new BillReminderNotification($this->bill, $this->user));
    }




    public function failed()
    {
        $this->topflash('billSendingError', $this->bill, $this->user);
    }
}
