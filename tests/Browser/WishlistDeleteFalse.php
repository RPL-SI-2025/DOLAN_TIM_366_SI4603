<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Destination;
use App\Models\Wishlist;

class WishlistRemoveNegativeTest extends DuskTestCase
{
    public function test_user_cannot_see_unexpected_text_on_remove_wishlist()
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
                // Pastikan pesan error tidak muncul
                ->assertDontSeeIn('.swal2-html-container', 'Gagal')
                ->assertDontSeeIn('.swal2-html-container', 'Error')
                ->assertDontSeeIn('.swal2-html-container', 'Halaman Tidak Ada')
                ->assertDontSeeIn('.swal2-html-container', 'Destinasi gagal dihapus dari wishlist.');
        });
    }
}