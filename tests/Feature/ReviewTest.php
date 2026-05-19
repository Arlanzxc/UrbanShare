<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Item;
use App\Models\User;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_leave_review_for_approved_booking()
    {
        /** @var User $owner */
        $owner = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $owner->id]);

        /** @var User $renter */
        $renter = User::factory()->create();

        $booking = Booking::create([
            'item_id' => $item->id,
            'user_id' => $renter->id,
            'start_date' => '2026-06-01',
            'end_date' => '2026-06-05',
            'status' => 'approved',
        ]);

        $response = $this->actingAs($renter)->post("/bookings/{$booking->id}/reviews", [
            'rating' => 5,
            'comment' => 'Great tool, highly recommended!',
        ]);

        $response->assertStatus(302); 
        
        $this->assertDatabaseHas('reviews', [
            'booking_id' => $booking->id,
            'user_id' => $renter->id,
            'rating' => 5,
        ]);
    }

    public function test_user_cannot_review_unapproved_booking()
    {
        /** @var User $owner */
        $owner = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $owner->id]);

        /** @var User $renter */
        $renter = User::factory()->create();

        $booking = Booking::create([
            'item_id' => $item->id,
            'user_id' => $renter->id,
            'start_date' => '2026-06-01',
            'end_date' => '2026-06-05',
            'status' => 'pending', 
        ]);

        $response = $this->actingAs($renter)->post("/bookings/{$booking->id}/reviews", [
            'rating' => 4,
            'comment' => 'Trying to review early.',
        ]);

        $response->assertSessionHas('error', 'You cannot review this booking.');
        
        $this->assertDatabaseMissing('reviews', [
            'booking_id' => $booking->id,
        ]);
    }

    public function test_user_cannot_leave_multiple_reviews_for_same_booking()
    {
        /** @var User $owner */
        $owner = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $owner->id]);

        /** @var User $renter */
        $renter = User::factory()->create();

        $booking = Booking::create([
            'item_id' => $item->id,
            'user_id' => $renter->id,
            'start_date' => '2026-06-01',
            'end_date' => '2026-06-05',
            'status' => 'approved',
        ]);

        $this->actingAs($renter)->post("/bookings/{$booking->id}/reviews", [
            'rating' => 5,
        ]);

        $response = $this->actingAs($renter)->post("/bookings/{$booking->id}/reviews", [
            'rating' => 1,
        ]);

        $response->assertSessionHas('error', 'You cannot review this booking.');
        
        $this->assertEquals(1, Review::query()->where('booking_id', $booking->id)->count());
    }
}