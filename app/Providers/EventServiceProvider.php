<?php

namespace App\Providers;

use App\Events\InvoiceCreated;
use App\Listeners\NotifyAdminOfNewInvoice;
use App\Listeners\NotifyCustomerOfNewInvoice;
use App\Models\Invoice;
use App\Observers\InvoiceObserver;
use Illuminate\Auth\Events\Registered;
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
        InvoiceCreated::class => [
            NotifyCustomerOfNewInvoice::class,
            NotifyAdminOfNewInvoice::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Invoice::observe(InvoiceObserver::class);
    }
}
