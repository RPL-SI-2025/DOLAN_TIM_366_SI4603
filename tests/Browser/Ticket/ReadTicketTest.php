<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Destination;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReadTicketTest extends DuskTestCase
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
            'ticket_name' => 'Tiket Reguler Weekday',
            'destination_id' => $this->destination->id,
            'price' => 50000,
            'stock' => 75
        ]);
    }

    public function testAdminCanViewTicketList()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets')
                   ->pause(2000)
                   ->assertSee('Daftar Tiket')
                   ->assertSee($this->ticket->ticket_name)
                   ->assertSee($this->destination->name)
                   ->assertSee('IDR ' . number_format($this->ticket->price, 0, ',', '.'))
                   ->assertSee($this->ticket->stock);
        });
    }

    public function testAdminCanViewTicketDetails()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets')
                   ->pause(2000)
                   ->waitFor('a[href*="/dashboard/tickets/' . $this->ticket->id . '"]')
                   ->click('a[href*="/dashboard/tickets/' . $this->ticket->id . '"]')
                   ->pause(2000)
                   ->waitForLocation('/dashboard/tickets/' . $this->ticket->id)
                   ->assertSee($this->ticket->ticket_name)
                   ->assertSee('IDR ' . number_format($this->ticket->price, 0, ',', '.'))
                   ->assertSee($this->ticket->stock)
                   ->assertSee($this->destination->name)
                   ->assertSee($this->destination->location);
        });
    }

    public function testTicketListPagination()
    {
        // Create more tickets for pagination test
        Ticket::factory()->count(15)->create([
            'destination_id' => function() {
                return Destination::factory()->create(['has_ticket' => true])->id;
            }
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                   ->visit('/dashboard/tickets')
                   ->pause(2000)
                   ->assertSee('Daftar Tiket')
                   // Check if pagination exists when there are more than 10 tickets
                   ->assertPresent('.pagination, nav[role="navigation"]');
        });
    }
}