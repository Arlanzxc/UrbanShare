<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'approved' || $booking->review()->exists()) {
            return back()->with('error', 'You cannot review this booking.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'booking_id' => $booking->id,
            'item_id' => $booking->item_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('status', 'Thank you for your review!');
    }
}