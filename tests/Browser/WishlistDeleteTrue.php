<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Destination;
use App\Models\Wishlist;

class WishlistRemovePositiveTest extends DuskTestCase
{
    public function test_user_can_remove_destination_from_wishlist()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);
        $destination = Destination::factory()->create([
            'name' => 'Pantai Indah',
            'description' => 'Pantai indah dengan pasir putih.',
            'location' => 'Bali',
        ]);
        // Tambahkan ke wishlist terlebih dahulu
        Wishlist::create([
            'user_id' => $user->id,
            'destination_id' => $destination->id,
            'destination_name' => $destination->name,
        ]);

        $this->browse(function (Browser $browser) use ($user, $destination) {
            $browser->loginAs($user)
                ->visit('/destinations/' . $destination->id)
                ->click('@wishlist-btn') // klik tombol untuk hapus (toggle)
                ->waitFor('.swal2-popup', 5)
                ->assertSeeIn('.swal2-title', 'Berhasil!')
                ->screenshot('wishlist-remove-swal')
                ->assertSeeIn('.swal2-html-container', 'Destinasi dihapus dari wishlist.');
        });
    }
}