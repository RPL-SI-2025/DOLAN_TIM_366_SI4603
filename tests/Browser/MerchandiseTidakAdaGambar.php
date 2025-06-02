<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Merchandise;

class MerchandiseShowImageMissingNegativeTest extends DuskTestCase
{
    public function test_merchandise_detail_with_missing_image()
    {
        $merchandise = Merchandise::factory()->create([
            'image' => 'tidak-ada-di-storage.jpg', // file ini tidak ada di storage
        ]);

        $this->browse(function (Browser $browser) use ($merchandise) {
            $browser->visit('/merchandise/' . $merchandise->id)
                // Pastikan alt text muncul (atau gambar default, atau class img-broken, dsb)
                ->assertSee($merchandise->name); // alt text tetap tampil
                // Anda juga bisa cek apakah gambar default muncul jika ada
        });
    }
}