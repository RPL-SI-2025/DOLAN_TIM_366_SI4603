<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Destination;

class WishlistAddGuestNegativeTest extends DuskTestCase
{
    public function test_guest_cannot_add_destination_to_wishlist()
    {
        $destination = Destination::factory()->create([
            'name' => 'Pantai Indah',
            'description' => 'Pantai indah dengan pasir putih.',
            'location' => 'Bali',
        ]);

        $this->browse(function (Browser $browser) use ($destination) {
            $browser->visit('/destinations/' . $destination->id)
                ->click('@wishlist-btn')
                ->waitFor('.swal2-popup', 5)
                ->assertSeeIn('.swal2-title', 'Oops!')
                ->assertSeeIn('.swal2-html-container', 'Anda belum login.');
        });
    }
}