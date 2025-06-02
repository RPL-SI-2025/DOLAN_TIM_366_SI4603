<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Destination;
use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteTicketTest extends DuskTestCase
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
            'ticket_name' => 'Tiket To Delete',
            'destination_id' => $this->destination->id,
            'price' => 40000,
            'stock' => 30
        ]);
    }

    public function testAdminCanDeleteTicketFromIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets')
                   ->pause(2000)
                   ->waitFor('form[action*="tickets/' . $this->ticket->id . '"] button[type="submit"]')
                   ->click('form[action*="tickets/' . $this->ticket->id . '"] button[type="submit"]')
                   ->acceptDialog()
                   ->pause(3000)
                   ->waitForLocation('/dashboard/tickets')
                   ->assertSee('Ticket deleted successfully');

            $this->assertDatabaseMissing('tickets', [
                'id' => $this->ticket->id
            ]);
        });
    }

    public function testAdminCanDeleteTicketFromShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets/' . $this->ticket->id)
                   ->pause(2000)
                   ->waitFor('form[action*="tickets/' . $this->ticket->id . '"] button[type="submit"]')
                   ->click('form[action*="tickets/' . $this->ticket->id . '"] button[type="submit"]')
                   ->acceptDialog()
                   ->pause(3000)
                   ->waitForLocation('/dashboard/tickets')
                   ->assertSee('Ticket deleted successfully');

            $this->assertDatabaseMissing('tickets', [
                'id' => $this->ticket->id
            ]);
        });
    }

    public function testCannotDeleteTicketWithPendingOrders()
    {
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => 'password123',
            'phone' => '0987654321',
            'role' => 'user',
        ]);

        // Create a pending order for this ticket
        Order::create([
            'user_id' => $user->id,
            'product_id' => $this->ticket->id,
            'product_type' => Ticket::class,
            'quantity' => 2,
            'total_amount' => $this->ticket->price * 2,
            'status' => 'pending'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets')
                   ->pause(2000)
                   ->waitFor('form[action*="tickets/' . $this->ticket->id . '"] button[type="submit"]')
                   ->click('form[action*="tickets/' . $this->ticket->id . '"] button[type="submit"]')
                   ->acceptDialog()
                   ->pause(3000)
                   ->assertSee('Cannot delete ticket. There are pending orders for this ticket.');

            // Verify ticket still exists
            $this->assertDatabaseHas('tickets', [
                'id' => $this->ticket->id
            ]);
        });
    }

    public function testDeleteTicketCancellation()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets')
                   ->pause(2000)
                   ->waitFor('form[action*="tickets/' . $this->ticket->id . '"] button[type="submit"]')
                   ->click('form[action*="tickets/' . $this->ticket->id . '"] button[type="submit"]')
                   ->dismissDialog() // Cancel the deletion
                   ->pause(2000)
                   ->assertSee($this->ticket->ticket_name); // Should still see the ticket

            // Verify ticket still exists
            $this->assertDatabaseHas('tickets', [
                'id' => $this->ticket->id
            ]);
        });
    }
}