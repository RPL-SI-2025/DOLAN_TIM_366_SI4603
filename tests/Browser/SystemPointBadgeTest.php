<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Badge;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginAndViewBadgeTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_login_and_view_point_and_badge_on_profile()
    {
        // Buat user
        $user = User::factory()->create([
            'email' => 'user1@gmail.com',
            'password' => bcrypt('user123456'), // password asli
            'points' => 0,
        ]);

        // Buat badge & kaitkan ke user
        $badge = Badge::factory()->create([
            'name' => 'Belum memiliki badge',
        ]);
        $user->badges()->attach($badge->id);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                    ->clickLink('Register')
                    ->assertPathIs('/register')
                    ->clickLink('Sign in')
                    ->assertPathIs('/login')
                    ->type('email', $user->email)
                    ->type('password', 'user123456') // gunakan password asli
                    ->press('Sign in')
                    ->assertPathIs('/') // sesuaikan jika redirect ke halaman lain
                    ->clickLink('Profile')       // atau .visit('/user/profile') jika tidak ada link
                    ->assertPathIs('/user/profile')
                    ->assertSee($user->name)
                    ->assertSee($user->email)
                    ->assertSee('0 poin') // pastikan poin awal 0
                    ->assertSee('Belum memiliki badge'); // nama badge
        });
    }
}
