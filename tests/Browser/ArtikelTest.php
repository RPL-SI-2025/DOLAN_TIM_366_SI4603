<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Article;

class ArtikelIndexReadPositiveTest extends DuskTestCase
{
    public function test_user_can_see_article_index()
    {
        $article = Article::factory()->create([
            'title' => 'Judul Artikel Test',
            'text' => 'Ini isi artikel untuk pengujian.',
        ]);

        $this->browse(function (Browser $browser) use ($article) {
            $browser->visit('/articles')
                ->assertSee('Artikel')
                ->assertSee('Temukan Artikel Wisata yang Menginspirasi')
                ->assertSee('Judul Artikel Test')
                ->assertSee('Ini isi artikel untuk pengujian.');
        });
    }
}