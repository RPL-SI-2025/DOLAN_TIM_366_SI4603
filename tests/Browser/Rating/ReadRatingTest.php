<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Destination;
use App\Models\Rating;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReadRatingTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected User $user;
    protected User $admin;
    protected Destination $destination;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        
        $this->user = User::where('email', 'user1@gmail.com')->first();
        $this->admin = User::where('email', 'admin1@gmail.com')->first();
        $this->destination = Destination::factory()->create(['status' => 'approved']);
    }

    public function testUserCanViewAllRatings()
    {
        // Create test rating
        Rating::create([
            'user_id' => $this->user->id,
            'destination_id' => $this->destination->id,
            'rating' => 5,
            'feedback' => 'Excellent place!'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                   ->visit("/destinations/{$this->destination->id}")
                   ->pause(2000)
                   ->click('button[onclick="showAllRatings()"]')
                   ->waitFor('#allRatingsModal')
                   ->pause(2000)
                   ->assertSee('All Reviews')
                   ->assertSee('Excellent place!');
        });
    }

    public function testAdminCanViewRatingList()
    {
        // Create test rating
        Rating::create([
            'user_id' => $this->user->id,
            'destination_id' => $this->destination->id,
            'rating' => 4,
            'feedback' => 'Nice destination'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/ratings')
                   ->pause(2000)
                   ->assertSee('Ratings & Feedback')
                   ->assertPresent('table')
                   ->assertSee('Nice destination');
        });
    }
}