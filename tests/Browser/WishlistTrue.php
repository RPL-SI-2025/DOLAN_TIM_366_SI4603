<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Destination;

class WishlistAddPositiveTest extends DuskTestCase
{
    public function test_user_can_add_destination_to_wishlist()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);
        $destination = Destination::factory()->create([
            'name' => 'Pantai Indah',
            'description' => 'Pantai indah dengan pasir putih.',
            'location' => 'Bali',
        ]);

$this->browse(function (Browser $browser) use ($user, $destination) {
    $browser->loginAs($user)
        ->visit('/destinations/' . $destination->id)
        ->click('@wishlist-btn')
        ->waitFor('.swal2-popup', 5)
        ->assertSeeIn('.swal2-title', 'Berhasil!')
        ->screenshot('wishlist-swal')
        ->assertSeeIn('.swal2-html-container', 'Destinasi ditambahkan ke wishlist.');
});
    }
    }
