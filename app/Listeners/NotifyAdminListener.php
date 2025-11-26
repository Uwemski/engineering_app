<?php

namespace App\Listeners;

use App\Mail\NewOrderNotification;
use App\Events\NewOrderRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotifyAdminListener
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
    // public function handle(object $event): void
    // {
    //     //
    //     //Mail::to('iconuwemfrank@gmail.com')->send(new NewOrderNotification($event -> order));
        
    // }

    public function handle(NewOrderRegistered $event): void
{
    Log::info('=== LISTENER STARTED ===', ['order_id' => $event->order->id]);
    
    try {
        Mail::to('iconuwemfrank@gmail.com')->send(new NewOrderNotification($event->order));
        Log::info('=== EMAIL SENT ===');
    } catch (\Exception $e) {
        Log::error('=== EMAIL FAILED ===', ['error' => $e->getMessage()]);
    }
}
}
