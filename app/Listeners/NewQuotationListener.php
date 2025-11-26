<?php

namespace App\Listeners;

use App\Events\QuotationCreated;
use App\Mail\NewQuotationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewQuotationListener
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
    public function handle(QuotationCreated $event): void
    {
        //
        Mail::to('iconuwemfrank@gmail.com')->send(new NewQuotationNotification($event->quotation));
    }
}
