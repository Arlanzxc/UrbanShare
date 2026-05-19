<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController; 
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
        $user = $request->user();

        $myItems = \App\Models\Item::where('user_id', $user->id)->latest()->get();

        $incomingRequests = \App\Models\Booking::with('item')
            ->whereHas('item', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->get();

        $myBookings = \App\Models\Booking::with('item')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard', compact('myItems', 'incomingRequests', 'myBookings'));
    })->name('dashboard');

    Route::resource('items', ItemController::class)->except(['index', 'show']);
    
    Route::post('/items/{item}/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::patch('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');

    Route::post('/bookings/{booking}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::post('/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead(); 
        return back();
    })->name('notifications.markAllRead');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('items', ItemController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';