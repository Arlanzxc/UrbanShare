<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Notifications\BookingRequested; 

class BookingController extends Controller
{
    public function store(Request $request, Item $item): RedirectResponse
    {
        if ($item->user_id === Auth::id()) {
            abort(403, 'You cannot book your own tool.');
        }
        
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        return DB::transaction(function () use ($request, $item) {
            $overlap = Booking::where('item_id', $item->id)
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

            return redirect()->route('items.index')->with('status', 'Booking request sent to the owner!');
        });
    }

    public function approve(Booking $booking): RedirectResponse
    {
        if ($booking->item->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->update(['status' => 'approved']);

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