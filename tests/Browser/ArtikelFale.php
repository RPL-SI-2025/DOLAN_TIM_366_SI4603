<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ArtikelIndexReadNegativeTest extends DuskTestCase
{
    public function test_user_cannot_see_unexpected_text_on_article_index()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/articles')
                ->assertDontSee('Halaman Tidak Ada')
                ->assertDontSee('404 Not Found')
                ->assertDontSee('Error Saja');
        });
    }
}