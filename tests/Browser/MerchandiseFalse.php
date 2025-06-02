<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MerchandiseReadNotFoundNegativeTest extends DuskTestCase
{
    public function test_user_cannot_access_nonexistent_merchandise_detail()
    {
        $invalidId = 999999; // pastikan ID ini tidak ada di database

        $this->browse(function (Browser $browser) use ($invalidId) {
            $browser->visit('/merchandise/' . $invalidId)
                // Ubah sesuai pesan error yang muncul di aplikasi Anda
                ->assertSee('404'); // atau 'Halaman Tidak Ada'
        });
    }
}