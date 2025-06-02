<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminDenyTest extends DuskTestCase
{
    use DatabaseMigrations;

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_deny_user_destination()
    {
        $user = User::factory()->create(['role' => 'member']);
        $admin = User::factory()->create(['role' => 'admin']);
        $destination = Destination::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'name' => 'Pantai Ditolak',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $destination) {
            $browser->loginAs($admin)
                ->visit(route('dashboard.destination.pending'))
                ->assertSee($destination->name)
                // Pastikan tombol Deny ada dan unik pada halaman
                ->press('Deny')
                // Tunggu status berubah atau pesan sukses muncul
                ->waitForText('denied')
                ->assertSee('denied');
        });
    }
}