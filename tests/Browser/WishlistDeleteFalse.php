<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WishlistDeleteGuestNegativeTest extends DuskTestCase
{
    public function test_guest_cannot_access_wishlist_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/wishlist')
                ->assertPathIs('/login');
        });
    }
}