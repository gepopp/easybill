<?php

namespace App\Jobs;

use App\Models\Bill;
use App\Models\User;
use App\Models\Customer;
use App\Traits\Topflash;
use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use App\Models\UserEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\RateLimited;

class SendBill implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Topflash;

    public Bill $bill;
    public User $user;
    public Customer $customer;
    public UserEmailNotification $notification;
    /**
     * Create a new job instance.
     *
     * @return void
     */
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
        $this->customer->notify(new \App\Notifications\SendBill($this->bill, $this->user));
    }




    public function failed()
    {
        $this->bill->update(['sent_at' => null]);
        $this->topflash('billSendingError', $this->bill, $this->user);
    }
}
