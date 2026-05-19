<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingApproved extends Notification
{
    use Queueable;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via(object $notifiable): array
    {
        return ['database']; 
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your request for "' . $this->booking->item->title . '" was APPROVED!',
            'type' => 'success',
            'url' => route('dashboard')
        ];
    }
}