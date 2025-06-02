<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Rating;
use App\Models\Destination;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteRatingTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected User $admin;
    protected Rating $rating;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'phone' => '1234567890',
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => 'password123',
            'phone' => '0987654321',
            'role' => 'user',
        ]);

        $destination = Destination::factory()->create([
            'status' => 'approved'
        ]);

        $this->rating = Rating::create([
            'user_id' => $user->id,
            'destination_id' => $destination->id,
            'rating' => 5,
            'feedback' => 'Excellent destination!'
        ]);
    }

    public function testAdminCanDeleteRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/ratings')
                   ->pause(2000)
                   ->waitFor('form[action*="ratings/' . $this->rating->id . '"]')
                   ->click('form[action*="ratings/' . $this->rating->id . '"] button[type="submit"]')    
                   ->acceptDialog()
                   ->pause(3000) // Wait longer for redirect and flash message
                   ->waitForLocation('/dashboard/ratings')
                   ->pause(2000) // Wait for page to fully load
                   // Check that we're on the right page and the rating is gone
                   ->assertPathIs('/dashboard/ratings')
                   // Instead of looking for flash message, just verify the rating is deleted
                   ->assertDontSee($this->rating->feedback);

            // Verify in database
            $this->assertDatabaseMissing('ratings', [
                'id' => $this->rating->id
            ]);
        });
    }
}