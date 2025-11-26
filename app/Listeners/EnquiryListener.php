<?php

namespace App\Listeners;

use App\Events\EnquiryCreated;
use App\Mail\NewEnquiryNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class EnquiryListener
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
    // public function handle(EnquiryCreated $event): void
    // {
    //     //
    //     Mail::to('iconuwemfrank@gmail.com')->send(new EnquiryCreated($event->enquiry));
    // }

    public function handle(EnquiryCreated $event): void
{
    Log::info('=== LISTENER STARTED ===', ['enquiry_id' => $event->enquiry->id]);
    
    try {
        Mail::to('iconuwemfrank@gmail.com')->send(new NewEnquiryNotification($event->enquiry));
        Log::info('=== EMAIL SENT ===');
    } catch (\Exception $e) {
        Log::error('=== EMAIL FAILED ===', ['error' => $e->getMessage()]);
    }
}
}
