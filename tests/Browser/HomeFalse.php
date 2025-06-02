<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeReadNegativeTest extends DuskTestCase
{
    /** @test */
    public function user_cannot_see_unexpected_text_on_homepage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Pastikan teks berikut tidak ada di halaman home
                ->assertDontSee('Halaman Tidak Ada')
                ->assertDontSee('404 Not Found')
                ->assertDontSee('Error Saja');
        });
    }
}