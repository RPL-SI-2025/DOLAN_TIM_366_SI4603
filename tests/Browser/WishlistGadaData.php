<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WishlistDestinationNotFoundNegativeTest extends DuskTestCase
{
    public function test_user_cannot_access_nonexistent_destination_detail()
    {
        $invalidId = 999999; // pastikan ID ini tidak ada di database

        $this->browse(function (Browser $browser) use ($invalidId) {
            $browser->visit('/destinations/' . $invalidId)
                ->assertSee('404'); // atau sesuaikan dengan pesan error di halaman Anda
        });
    }
}