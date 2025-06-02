<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Merchandise;

class MerchandiseReadNegativeTest extends DuskTestCase
{
    public function test_user_cannot_see_unexpected_text_on_merchandise_detail()
    {
        // Membuat dummy merchandise
        $merch = Merchandise::factory()->create([
            'name' => 'Kaos Dolan',
            'price' => 99000,
            'location' => 'Jakarta',
            'detail' => 'Kaos eksklusif Dolan.',
            'size' => 'M,L,XL',
            'stock' => 10,
            'image' => 'kaos.jpg',
        ]);

        $this->browse(function (Browser $browser) use ($merch) {
            $browser->visit('/merchandise/' . $merch->id)
                ->assertDontSee('Halaman Tidak Ada')
                ->assertDontSee('404 Not Found')
                ->assertDontSee('Produk Palsu');
        });
    }
}