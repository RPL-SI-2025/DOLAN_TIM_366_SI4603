<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Destination;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateTicketTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected User $admin;
    protected Destination $destination;

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

        $this->destination = Destination::factory()->create([
            'status' => 'approved',
            'has_ticket' => true
        ]);
    }

    public function testAdminCanCreateTicket()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets/create')
                   ->pause(2000)
                   ->waitFor('input[name="ticket_name"]')
                   ->type('ticket_name', 'Tiket Weekend Premium')
                   ->select('destination_id', $this->destination->id)
                   ->type('price', '75000')
                   ->type('stock', '100')
                   ->pause(1000)
                   ->click('button[type="submit"]')
                   ->pause(3000)
                   ->waitForLocation('/dashboard/tickets')
                   ->assertSee('Ticket created successfully');

            $this->assertDatabaseHas('tickets', [
                'ticket_name' => 'Tiket Weekend Premium',
                'destination_id' => $this->destination->id,
                'price' => 75000,
                'stock' => 100
            ]);
        });
    }

    public function testCreateTicketValidationError()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets/create')
                   ->pause(2000)
                   ->waitFor('input[name="ticket_name"]')
                   // Submit without filling required fields
                   ->click('button[type="submit"]')
                   ->pause(2000)
                   ->assertSee('Terjadi kesalahan'); // Error message from validation

            $this->assertDatabaseMissing('tickets', [
                'destination_id' => $this->destination->id
            ]);
        });
    }

    public function testCreateTicketForDestinationWithoutTicketRequirement()
    {
        $destinationWithoutTicket = Destination::factory()->create([
            'status' => 'approved',
            'has_ticket' => false
        ]);

        $this->browse(function (Browser $browser) use ($destinationWithoutTicket) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets/create')
                   ->pause(2000)
                   ->waitFor('input[name="ticket_name"]')
                   ->type('ticket_name', 'Invalid Ticket')
                   ->select('destination_id', $destinationWithoutTicket->id)
                   ->type('price', '50000')
                   ->type('stock', '50')
                   ->click('button[type="submit"]')
                   ->pause(2000)
                   ->assertSee('Destinasi ini tidak memerlukan tiket');

            $this->assertDatabaseMissing('tickets', [
                'destination_id' => $destinationWithoutTicket->id
            ]);
        });
    }
}