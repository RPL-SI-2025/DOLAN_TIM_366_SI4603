<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Merchandise;

class MerchandiseReadPositiveTest extends DuskTestCase
{
    public function test_user_can_see_merchandise_detail()
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
                ->assertSee('Kaos Dolan')
                ->assertSee('Rp 99.000')
                ->assertSee('Jakarta')
                ->assertSee('Kaos eksklusif Dolan.')
                ->assertSee('M')
                ->assertSee('Stok tersedia: 10');
        });
    }
}