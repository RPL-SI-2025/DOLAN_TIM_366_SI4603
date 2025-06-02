<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Destination;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateTicketTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected User $admin;
    protected Destination $destination;
    protected Ticket $ticket;

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

        $this->ticket = Ticket::create([
            'ticket_name' => 'Tiket Original',
            'destination_id' => $this->destination->id,
            'price' => 45000,
            'stock' => 50
        ]);
    }

    public function testAdminCanUpdateTicket()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets/' . $this->ticket->id . '/edit')
                   ->pause(2000)
                   ->waitFor('input[name="ticket_name"]')
                   ->clear('ticket_name')
                   ->type('ticket_name', 'Tiket Updated Premium')
                   ->clear('price')
                   ->type('price', '85000')
                   ->clear('stock')
                   ->type('stock', '120')
                   ->pause(1000)
                   ->click('button[type="submit"]')
                   ->pause(3000)
                   ->waitForLocation('/dashboard/tickets')
                   ->assertSee('Ticket updated successfully');

            $this->assertDatabaseHas('tickets', [
                'id' => $this->ticket->id,
                'ticket_name' => 'Tiket Updated Premium',
                'price' => 85000,
                'stock' => 120
            ]);
        });
    }

    public function testUpdateTicketValidationError()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets/' . $this->ticket->id . '/edit')
                   ->pause(2000)
                   ->waitFor('input[name="ticket_name"]')
                   ->clear('ticket_name')
                   ->clear('price')
                   // Submit with empty required fields
                   ->click('button[type="submit"]')
                   ->pause(2000)
                   ->assertSee('Terjadi kesalahan'); // Validation error message

            // Verify original data is unchanged
            $this->assertDatabaseHas('tickets', [
                'id' => $this->ticket->id,
                'ticket_name' => 'Tiket Original',
                'price' => 45000
            ]);
        });
    }

    public function testUpdateTicketNavigationFromShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets/' . $this->ticket->id)
                   ->pause(2000)
                   ->waitFor('a[href*="' . $this->ticket->id . '/edit"]')
                   ->click('a[href*="' . $this->ticket->id . '/edit"]')
                   ->pause(2000)
                   ->waitForLocation('/dashboard/tickets/' . $this->ticket->id . '/edit')
                   ->assertSee('Edit Tiket')
                   ->assertInputValue('ticket_name', $this->ticket->ticket_name)
                   ->assertInputValue('price', $this->ticket->price)
                   ->assertInputValue('stock', $this->ticket->stock);
        });
    }
}