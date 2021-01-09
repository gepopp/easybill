<?php

namespace App\Providers;

use App\Models\Bill;
use App\Models\BillPosition;
use App\Observers\BillObserver;
use Illuminate\Auth\Events\Registered;
use App\Observers\BillPostionObserver;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NotificationSent::class => [
            'App\Listeners\LogNotification',
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Bill::observe(BillObserver::class);
    }
}
