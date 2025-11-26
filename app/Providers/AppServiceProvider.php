<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\NewOrderRegistered;
use App\Listeners\NotifyAdminListener;
use App\Events\EnquiryCreated;
use App\Listeners\EnquiryListener;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $listen = [
        NewOrderRegistered::class => [
            NotifyAdminListener::class,
        ],

        EnquiryCreated::class => [
            EnquiryListener::class,
        ]
    ];


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
