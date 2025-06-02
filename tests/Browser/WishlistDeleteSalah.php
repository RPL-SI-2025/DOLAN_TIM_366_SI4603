<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Destination;

class WishlistDeleteNotExistNegativeTest extends DuskTestCase
{
    public function test_wishlist_button_is_add_when_not_in_wishlist()
    {
        $user = User::factory()->create();
        $destination = Destination::factory()->create([
            'name' => 'Pantai Belum Ada',
            'description' => 'Belum pernah di-add ke wishlist.',
            'location' => 'Bali',
        ]);

        // Pastikan wishlist belum pernah dibuat

        $this->browse(function (Browser $browser) use ($user, $destination) {
            $browser->loginAs($user)
                ->visit('/destinations/' . $destination->id)
                // Pastikan tombol dalam mode add (ikon kosong)
                ->assertAttributeContains('#bookmarkIcon-' . $destination->id, 'class', 'bi-bookmark')
                ->assertDontSee('bi-bookmark-fill')
                // Klik tombol, pastikan yang muncul adalah pesan tambah
                ->click('@wishlist-btn')
                ->waitFor('.swal2-popup', 5)
                ->assertSeeIn('.swal2-title', 'Berhasil!')
                ->assertSeeIn('.swal2-html-container', 'Destinasi ditambahkan ke wishlist.');
        });
    }
}