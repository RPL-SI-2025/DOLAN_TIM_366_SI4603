<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Merchandise;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MerchandiseCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_admin_can_create_merchandise()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $data = [
            'name' => 'Test Merchandise',
            'stock' => 10,
            'price' => 150000,
            'detail' => 'Deskripsi test',
            'size' => 'M,L,XL',
            'location' => 'Jakarta',
            'image' => UploadedFile::fake()->image('merch.jpg'),
        ];

        $response = $this->post(route('dashboard.merchandise.store'), $data);

        $response->assertRedirect(route('dashboard.merchandise.index'));
        $this->assertDatabaseHas('merchandises', ['name' => 'Test Merchandise']);
    }

    public function test_admin_can_update_merchandise()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $merch = Merchandise::factory()->create(['name' => 'Old Name']);

        $response = $this->put(route('dashboard.merchandise.update', $merch->id), [
            'name' => 'New Name',
            'stock' => $merch->stock,
            'price' => $merch->price,
            'detail' => $merch->detail,
            'size' => $merch->size,
            'location' => $merch->location,
        ]);

        $response->assertRedirect(route('dashboard.merchandise.index'));
        $this->assertDatabaseHas('merchandises', ['name' => 'New Name']);
    }

    public function test_admin_can_delete_merchandise()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $merch = Merchandise::factory()->create();

        $response = $this->delete(route('dashboard.merchandise.destroy', $merch->id));
        $response->assertRedirect(route('dashboard.merchandise.index'));
        $this->assertDatabaseMissing('merchandises', ['id' => $merch->id]);
    }

    public function test_merchandise_index_page_can_be_accessed()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get(route('dashboard.merchandise.index'));
        $response->assertStatus(200);
    }
}