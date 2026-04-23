<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase; 

    public function test_user_can_successfully_request_a_booking()
    {
        /** @var User $owner */
        $owner = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $owner->id]);
        
        /** @var User $renter */
        $renter = User::factory()->create();

        $response = $this->actingAs($renter)->post("/items/{$item->id}/bookings", [
            'start_date' => '2026-05-01',
            'end_date' => '2026-05-05',
        ]);

        $response->assertStatus(302); 
        
        $this->assertDatabaseHas('bookings', [
            'item_id' => $item->id,
            'user_id' => $renter->id,
            'status' => 'pending',
        ]);
    }

    public function test_owner_cannot_book_their_own_tool()
    {
        /** @var User $owner */
        $owner = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($owner)->post("/items/{$item->id}/bookings", [
            'start_date' => '2026-05-01',
            'end_date' => '2026-05-05',
        ]);

        $response->assertStatus(403); 
    }

    public function test_system_prevents_overlapping_booking_dates()
    {
        /** @var User $owner */
        $owner = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $owner->id]);
        
        /** @var User $renter1 */
        $renter1 = User::factory()->create();
        
        /** @var User $renter2 */
        $renter2 = User::factory()->create();

        Booking::create([
            'item_id' => $item->id,
            'user_id' => $renter1->id,
            'start_date' => '2026-05-10',
            'end_date' => '2026-05-15',
            'status' => 'pending'
        ]);

        $response = $this->actingAs($renter2)->post("/items/{$item->id}/bookings", [
            'start_date' => '2026-05-12', 
            'end_date' => '2026-05-18',
        ]);

        $response->assertSessionHasErrors();

        $this->assertEquals(1, Booking::where('item_id', $item->id)->count());
    }
}