<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendProductCreatedNotification
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
    public function handle(ProductCreated $event): void
    {
        // Example: Log the product creation
        Log::info('Product created: ' . $event->product->product_name);
        
        // Here you can also send notifications, emails, etc.
    }
}
