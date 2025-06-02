<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeReadPositiveTest extends DuskTestCase
{
    /** @test */
    public function user_can_see_homepage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Cek judul halaman
                ->assertTitleContains('Dolan')
                // Cek teks utama di halaman (ganti sesuai yang pasti ada di home)
                ->assertSee('Destinasi Wisata Nusantara');
        });
    }
}