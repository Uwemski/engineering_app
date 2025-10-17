<?php

namespace App\Listeners;

use App\Mail\NewUserNotification;
use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAdminNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
        Mail::to('iconuwemfrank@gmail.com')->send(New NewUserNotification ($event -> user) );
    }
}
