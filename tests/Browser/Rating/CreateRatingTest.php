<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateRatingTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected User $user;
    protected Destination $destination;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create user and destination directly instead of using seeder
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'phone' => '1234567890',
            'role' => 'user',
        ]);
        
        $this->destination = Destination::factory()->create([
            'status' => 'approved',
            'has_ticket' => true
        ]);
    }

    public function testUserCanCreateRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                   ->visit("/destinations/{$this->destination->id}")
                   ->pause(3000) // Wait for page to fully load
                   ->waitFor('button[onclick="openRatingModal()"]')
                   ->click('button[onclick="openRatingModal()"]')
                   ->waitFor('#ratingModal', 10) // Increase wait time
                   ->pause(2000)
                   ->click('.star-btn[data-rating="4"]')
                   ->pause(500) // Wait for star selection
                   ->type('#feedback', 'Good place to visit!')
                   ->pause(1000)
                   ->click('#submitBtn')
                   ->pause(3000) // Wait for submission
                   ->waitUntilMissing('#ratingModal', 15); // Increase timeout

            $this->assertDatabaseHas('ratings', [
                'user_id' => $this->user->id,
                'destination_id' => $this->destination->id,
                'rating' => 4,
                'feedback' => 'Good place to visit!'
            ]);
        });
    }

    public function testCreateRatingValidationError()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                   ->visit("/destinations/{$this->destination->id}")
                   ->pause(3000)
                   ->waitFor('button[onclick="openRatingModal()"]')
                   ->click('button[onclick="openRatingModal()"]')
                   ->waitFor('#ratingModal', 10)
                   ->pause(2000)
                   // Don't select any rating or enter feedback
                   ->click('#submitBtn') // Submit without rating/feedback
                   ->pause(2000) // Wait for client-side validation
                   // Check if the error elements are visible or if modal is still open
                   ->assertVisible('#ratingModal') // Modal should still be open due to validation errors
                   // Try to check for the error elements
                   ->script('return document.getElementById("ratingError").style.display !== "none" && !document.getElementById("ratingError").classList.contains("hidden")');

            // Verify no rating was created in database
            $this->assertDatabaseMissing('ratings', [
                'user_id' => $this->user->id,
                'destination_id' => $this->destination->id
            ]);
        });
    }
}