<?php
// filepath: tests/Browser/ExampleTest.php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->pause(3000) // Wait longer for JavaScript to load
                    // Check for the page title which should contain "Dolan"
                    ->assertTitleContains('Dolan')
                    // Or check for content that's definitely there
                    ->assertPresent('body')
                    ->assertPresent('.container'); // Check for basic page structure
        });
    }
}
