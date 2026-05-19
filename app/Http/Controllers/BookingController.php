<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Notifications\BookingRequested; 
use App\Events\BookingCreated;

class BookingController extends Controller
{
    public function store(Request $request, Item $item): RedirectResponse
    {
        if ($item->user_id === Auth::id()) {
            abort(403, 'You cannot book your own tool.');
        }
        
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $overlap = Booking::query()->where('item_id', $item->id)
            ->where('status', '!=', 'rejected')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })->exists();

        if ($overlap) {
            return back()->withErrors(['dates' => 'This item is already booked for the selected dates.']);
        }

        $booking = Auth::user()->bookings()->create([
            'item_id' => $item->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        $item->user->notify(new BookingRequested($booking));
        
        BookingCreated::dispatch($booking);

        return redirect()->route('dashboard')->with('status', 'Booking request sent successfully!');
    }

    public function approve(Booking $booking): \Illuminate\Http\RedirectResponse
    {
        if ($booking->item->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $booking->update(['status' => 'approved']);

        $booking->user->notify(new \App\Notifications\BookingApproved($booking));

        return back()->with('status', 'Booking approved!');
    }

    public function reject(Booking $booking): RedirectResponse
    {
        if ($booking->item->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->update(['status' => 'rejected']);

        return back()->with('status', 'Booking rejected.');
    }
}