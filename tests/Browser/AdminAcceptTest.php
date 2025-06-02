<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminAcceptTest extends DuskTestCase
{
    use DatabaseMigrations;

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_approve_user_destination()
    {
        $user = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);
        $destination = Destination::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'name' => 'Pantai Indah',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $destination) {
            $browser->loginAs($admin)
                ->visit(route('dashboard.destination.pending'))
                ->assertSee($destination->name)
                ->press('Approve');
        });
    }
}