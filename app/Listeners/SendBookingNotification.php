<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Notifications\BookingRequested;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBookingNotification implements ShouldQueue
{
    public function handle(BookingCreated $event): void
    {
        $booking = $event->booking;
        $owner = $booking->item->user;
        
        $owner->notify(new BookingRequested($booking));
    }
}