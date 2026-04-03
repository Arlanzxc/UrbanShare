<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingRequested extends Notification
{
    use Queueable;

    public function __construct(public Booking $booking) {}

    public function via(object $notifiable): array
    {
        return ['database']; 
    }

    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'item_title' => $this->booking->item->title,
            'borrower_name' => $this->booking->user->name,
            'start_date' => $this->booking->start_date,
            'end_date' => $this->booking->end_date,
        ];
    }
}