<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Notifications\Messages\MailMessage; 
use Illuminate\Notifications\Notification;

class BookingRequested extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Booking $booking) {}

    public function via(object $notifiable): array
    {
        return ['database', 'mail']; 
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Rental Request for: ' . $this->booking->item->title)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line($this->booking->user->name . ' wants to rent your tool: ' . $this->booking->item->title)
            ->line('Dates: ' . $this->booking->start_date . ' to ' . $this->booking->end_date)
            ->action('Review Request', url('/dashboard'))
            ->line('Please visit your dashboard to approve or decline this request.');
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