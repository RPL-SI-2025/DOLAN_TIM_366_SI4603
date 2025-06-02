<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Destination;

class WishlistAddNegativeTest extends DuskTestCase
{
    public function test_user_cannot_see_unexpected_text_on_add_wishlist()
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
                // Pastikan pesan error tidak muncul
                ->assertDontSeeIn('.swal2-html-container', 'Gagal')
                ->assertDontSeeIn('.swal2-html-container', 'Error')
                ->assertDontSeeIn('.swal2-html-container', 'Halaman Tidak Ada')
                ->assertDontSeeIn('.swal2-html-container', 'Destinasi gagal ditambahkan ke wishlist.');
        });
    }
}