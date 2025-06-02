<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CrowdsorcingUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_create_destination()
    {
        $user = User::factory()->create([
            'role' => 'member',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('user.destinations.index'))
                ->clickLink('+ Request Destinasi')
                ->assertPathIs(route('user.destinations.create', [], false))
                ->type('name', 'Pantai Indah')
                ->type('location', 'Bali')
                ->type('description', 'Pantai dengan pasir putih dan air jernih.')
                ->type('tour_includes', 'Gazebo, Toilet, Parkir')
                ->attach('image', public_path('images/anjay.png'))
                ->press('Tambah Destinasi')
                ->waitForText('Sukses!')
                ->assertSee('Sukses!')
                ->assertSee('Pantai Indah');
        });
    }
}