<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Destination;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminTicketCRUDTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh', ['--env' => 'dusk.local']);
        $this->artisan('db:seed', [
            '--env'   => 'dusk.local',
            '--class' => \Database\Seeders\DatabaseSeeder::class,
        ]);

        $this->createTestData();
    }

    private function createTestData()
    {
        // Buat beberapa destination untuk test yang berbeda
        $destinations = [
            [
                'name' => 'CRUD Create Destination',
                'description' => 'Destination for create testing',
                'location' => 'Create Test Location',
            ],
            [
                'name' => 'CRUD Read Destination 1',
                'description' => 'Destination for read testing 1',
                'location' => 'Read Test Location 1',
            ],
            [
                'name' => 'CRUD Read Destination 2',
                'description' => 'Destination for read testing 2',
                'location' => 'Read Test Location 2',
            ],
            [
                'name' => 'CRUD Update Destination',
                'description' => 'Destination for update testing',
                'location' => 'Update Test Location',
            ],
            [
                'name' => 'CRUD Delete Destination',
                'description' => 'Destination for delete testing',
                'location' => 'Delete Test Location',
            ],
            [
                'name' => 'CRUD Detail Destination',
                'description' => 'Destination for detail testing',
                'location' => 'Detail Test Location',
            ],
            [
                'name' => 'CRUD Workflow Destination',
                'description' => 'Destination for workflow testing',
                'location' => 'Workflow Test Location',
            ],
        ];

        foreach ($destinations as $dest) {
            if (!Destination::where('name', $dest['name'])->exists()) {
                Destination::create([
                    'name' => $dest['name'],
                    'description' => $dest['description'],
                    'location' => $dest['location'],
                    'has_ticket' => true,
                    'status' => 'approved',
                    'image' => 'test-crud.jpg',
                    'tour_includes' => 'Test includes',
                    'tour_payments' => 'Test payments',
                    'user_id' => 1,
                ]);
            }
        }
    }

    public function test_admin_can_create_ticket()
    {
        $destination = Destination::where('name', 'CRUD Create Destination')->first();
        $initialTicketCount = Ticket::count();

        $this->browse(function (Browser $browser) use ($destination) {
            $browser->visit('/login')
                    ->waitForText('Sign in to your account', 10)
                    ->type('email', 'admin1@gmail.com')
                    ->type('password', 'admin123456')
                    ->press('Sign in')
                    ->pause(3000)
                    ->screenshot('admin_login_create');

            $browser->visit(route('dashboard.tickets.create'))
                    ->waitForText('Tambah Tiket Baru', 10)
                    ->type('ticket_name', 'CRUD Test Ticket')
                    ->select('destination_id', $destination->id)
                    ->type('price', 80000)
                    ->type('stock', 30)
                    ->screenshot('before_create_ticket')
                    ->press('Simpan Tiket')
                    ->pause(3000)
                    ->screenshot('after_create_ticket');

            $browser->waitForLocation('/dashboard/tickets', 15)
                    ->assertSee('Ticket created successfully')
                    ->screenshot('ticket_created_success');
        });

        $this->assertEquals($initialTicketCount + 1, Ticket::count());
        $newTicket = Ticket::where('ticket_name', 'CRUD Test Ticket')->first();
        $this->assertNotNull($newTicket);
        $this->assertEquals(80000, $newTicket->price);
        $this->assertEquals(30, $newTicket->stock);
    }

    public function test_admin_can_read_all_tickets()
    {
        // Gunakan destination yang berbeda untuk setiap ticket
        $destination1 = Destination::where('name', 'CRUD Read Destination 1')->first();
        $destination2 = Destination::where('name', 'CRUD Read Destination 2')->first();

        Ticket::create([
            'ticket_name'   => 'Read Test Ticket 1',
            'destination_id'=> $destination1->id,
            'price'         => 50000,
            'stock'         => 15,
        ]);

        Ticket::create([
            'ticket_name'   => 'Read Test Ticket 2',
            'destination_id'=> $destination2->id,
            'price'         => 75000,
            'stock'         => 25,
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->waitForText('Sign in to your account', 10)
                    ->type('email', 'admin1@gmail.com')
                    ->type('password', 'admin123456')
                    ->press('Sign in')
                    ->pause(3000)
                    ->screenshot('admin_login_read');

            $browser->visit(route('dashboard.tickets.index'))
                    ->waitForText('Daftar Tiket', 10)
                    ->assertSee('Read Test Ticket 1')
                    ->assertSee('Read Test Ticket 2')
                    ->assertSee('IDR 50.000') // Format sesuai view dengan IDR prefix dan titik
                    ->assertSee('IDR 75.000')
                    ->assertSee('CRUD Read Destination 1')
                    ->assertSee('CRUD Read Destination 2')
                    ->screenshot('tickets_list_view');
        });
    }

    public function test_admin_can_update_ticket()
    {
        $destination1 = Destination::where('name', 'CRUD Update Destination')->first();
        
        $ticket = Ticket::create([
            'ticket_name'   => 'Update Test Ticket',
            'destination_id'=> $destination1->id,
            'price'         => 60000,
            'stock'         => 20,
        ]);

        $this->browse(function (Browser $browser) use ($ticket, $destination1) {
            $browser->visit('/login')
                    ->waitForText('Sign in to your account', 10)
                    ->type('email', 'admin1@gmail.com')
                    ->type('password', 'admin123456')
                    ->press('Sign in')
                    ->pause(3000)
                    ->screenshot('admin_login_update');

            $browser->visit(route('dashboard.tickets.edit', $ticket->id))
                    ->waitForText('Edit Tiket', 10)
                    ->clear('ticket_name')
                    ->type('ticket_name', 'Updated Test Ticket')
                    ->clear('price')
                    ->type('price', 90000)
                    ->clear('stock')
                    ->type('stock', 35)
                    ->screenshot('before_update_ticket')
                    ->press('Update Tiket')
                    ->pause(3000)
                    ->screenshot('after_update_ticket');

            $browser->waitForLocation('/dashboard/tickets', 15)
                    ->assertSee('Ticket updated successfully')
                    ->screenshot('ticket_updated_success');
        });

        $ticket->refresh();
        $this->assertEquals('Updated Test Ticket', $ticket->ticket_name);
        $this->assertEquals($destination1->id, $ticket->destination_id);
        $this->assertEquals(90000, $ticket->price);
        $this->assertEquals(35, $ticket->stock);
    }

    public function test_admin_can_delete_ticket()
    {
        $destination = Destination::where('name', 'CRUD Delete Destination')->first();
        $ticket = Ticket::create([
            'ticket_name'   => 'Delete Test Ticket',
            'destination_id'=> $destination->id,
            'price'         => 45000,
            'stock'         => 10,
        ]);

        $initialTicketCount = Ticket::count();

        $this->browse(function (Browser $browser) use ($ticket) {
            $browser->visit('/login')
                    ->waitForText('Sign in to your account', 10)
                    ->type('email', 'admin1@gmail.com')
                    ->type('password', 'admin123456')
                    ->press('Sign in')
                    ->pause(3000)
                    ->screenshot('admin_login_delete');

            $browser->visit(route('dashboard.tickets.index'))
                    ->waitForText('Daftar Tiket', 10)
                    ->assertSee('Delete Test Ticket')
                    ->screenshot('before_delete_ticket');

            $browser->script('window.confirm = function() { return true; }');
            $browser->press('Hapus')
                    ->pause(3000)
                    ->screenshot('after_delete_ticket');

            $browser->waitForLocation('/dashboard/tickets', 15)
                    ->assertSee('Ticket deleted successfully')
                    ->assertDontSee('Delete Test Ticket')
                    ->screenshot('ticket_deleted_success');
        });

        $this->assertEquals($initialTicketCount - 1, Ticket::count());
        $this->assertNull(Ticket::find($ticket->id));
    }

    public function test_admin_can_view_ticket_details()
    {
        $destination = Destination::where('name', 'CRUD Detail Destination')->first();
        $ticket = Ticket::create([
            'ticket_name'   => 'Detail View Test Ticket',
            'destination_id'=> $destination->id,
            'price'         => 55000,
            'stock'         => 18,
        ]);

        $this->browse(function (Browser $browser) use ($ticket) {
            $browser->visit('/login')
                    ->waitForText('Sign in to your account', 10)
                    ->type('email', 'admin1@gmail.com')
                    ->type('password', 'admin123456')
                    ->press('Sign in')
                    ->pause(3000)
                    ->screenshot('admin_login_detail');

            $browser->visit(route('dashboard.tickets.show', $ticket->id))
                    ->waitForText('Detail View Test Ticket', 10)
                    ->assertSee('Detail View Test Ticket')
                    ->assertSee('IDR 55.000') // Format sesuai view dengan IDR prefix dan titik
                    ->assertSee('Stock Tersedia')
                    ->assertSee('18')
                    ->assertSee('CRUD Detail Destination')
                    ->assertSee('Detail Test Location')
                    ->screenshot('ticket_detail_view');
        });
    }

    public function test_complete_crud_workflow()
    {
        $destination = Destination::where('name', 'CRUD Workflow Destination')->first();

        $this->browse(function (Browser $browser) use ($destination) {
            $browser->visit('/login')
                    ->waitForText('Sign in to your account', 10)
                    ->type('email', 'admin1@gmail.com')
                    ->type('password', 'admin123456')
                    ->press('Sign in')
                    ->pause(3000);

            // CREATE
            $browser->visit(route('dashboard.tickets.create'))
                    ->waitForText('Tambah Tiket Baru', 10)
                    ->type('ticket_name', 'Workflow Test Ticket')
                    ->select('destination_id', $destination->id)
                    ->type('price', 100000)
                    ->type('stock', 50)
                    ->press('Simpan Tiket')
                    ->pause(3000);

            // READ
            $browser->waitForLocation('/dashboard/tickets', 15)
                    ->assertSee('Workflow Test Ticket')
                    ->assertSee('IDR 100.000'); // Format sesuai view dengan IDR prefix dan titik

            $ticket = Ticket::where('ticket_name', 'Workflow Test Ticket')->first();

            // VIEW DETAILS
            $browser->visit(route('dashboard.tickets.show', $ticket->id))
                    ->waitForText('Workflow Test Ticket', 10)
                    ->assertSee('IDR 100.000')
                    ->assertSee('50');

            // UPDATE
            $browser->visit(route('dashboard.tickets.edit', $ticket->id))
                    ->waitForText('Edit Tiket', 10)
                    ->clear('ticket_name')
                    ->type('ticket_name', 'Updated Workflow Ticket')
                    ->clear('price')
                    ->type('price', 120000)
                    ->press('Update Tiket')
                    ->pause(3000);

            // Verify update
            $browser->waitForLocation('/dashboard/tickets', 15)
                    ->assertSee('Updated Workflow Ticket')
                    ->assertSee('IDR 120.000');

            // DELETE
            $browser->script('window.confirm = function() { return true; }');
            $browser->press('Hapus')
                    ->pause(3000);

            // Verify deletion
            $browser->waitForLocation('/dashboard/tickets', 15)
                    ->assertDontSee('Updated Workflow Ticket')
                    ->screenshot('complete_workflow_finished');
        });
    }

    // Test sederhana yang hanya fokus pada operasi dasar
    public function test_simple_ticket_operations()
    {
        $destination = Destination::where('name', 'CRUD Create Destination')->first();

        $this->browse(function (Browser $browser) use ($destination) {
            // Login admin
            $browser->visit('/login')
                    ->waitForText('Sign in to your account', 10)
                    ->type('email', 'admin1@gmail.com')
                    ->type('password', 'admin123456')
                    ->press('Sign in')
                    ->pause(3000);

            // Test CREATE - buat tiket
            $browser->visit(route('dashboard.tickets.create'))
                    ->waitForText('Tambah Tiket Baru', 10)
                    ->type('ticket_name', 'Simple Test Ticket')
                    ->select('destination_id', $destination->id)
                    ->type('price', 25000)
                    ->type('stock', 100)
                    ->press('Simpan Tiket')
                    ->pause(3000);

            // Test READ - lihat di list
            $browser->waitForLocation('/dashboard/tickets', 15)
                    ->assertSee('Simple Test Ticket')
                    ->screenshot('simple_ticket_created');

            // Ambil ticket yang baru dibuat
            $ticket = Ticket::where('ticket_name', 'Simple Test Ticket')->first();
            $this->assertNotNull($ticket);

            // Test VIEW - lihat detail
            $browser->visit(route('dashboard.tickets.show', $ticket->id))
                    ->waitForText('Simple Test Ticket', 10)
                    ->assertSee('Simple Test Ticket')
                    ->screenshot('simple_ticket_detail');

            // Test UPDATE - edit ticket
            $browser->visit(route('dashboard.tickets.edit', $ticket->id))
                    ->waitForText('Edit Tiket', 10)
                    ->clear('ticket_name')
                    ->type('ticket_name', 'Simple Test Ticket Updated')
                    ->press('Update Tiket')
                    ->pause(3000);

            // Verify update berhasil
            $browser->waitForLocation('/dashboard/tickets', 15)
                    ->assertSee('Simple Test Ticket Updated')
                    ->screenshot('simple_ticket_updated');

            // Test DELETE - hapus ticket
            $browser->script('window.confirm = function() { return true; }');
            $browser->press('Hapus')
                    ->pause(3000);

            // Verify delete berhasil
            $browser->waitForLocation('/dashboard/tickets', 15)
                    ->assertDontSee('Simple Test Ticket Updated')
                    ->screenshot('simple_ticket_deleted');
        });
    }
}