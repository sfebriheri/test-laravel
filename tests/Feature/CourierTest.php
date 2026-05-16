<?php

namespace Tests\Feature;

use App\Models\Courier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourierTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_couriers(): void
    {
        Courier::factory()->count(15)->create();

        $response = $this->getJson('/api/couriers');

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'current_page', 'per_page', 'total'])
            ->assertJsonCount(10, 'data'); // Default pagination
    }

    public function test_can_sort_couriers_by_name_default(): void
    {
        Courier::factory()->create(['name' => 'Zebra']);
        Courier::factory()->create(['name' => 'Alpha']);

        $response = $this->getJson('/api/couriers');

        $this->assertEquals('Alpha', $response->json('data.0.name'));
    }

    public function test_can_sort_couriers_by_date(): void
    {
        $old = Courier::factory()->create(['created_at' => now()->subDay()]);
        $new = Courier::factory()->create(['created_at' => now()]);

        $response = $this->getJson('/api/couriers?sort=date&direction=desc');

        $this->assertEquals($new->id, $response->json('data.0.id'));
    }

    public function test_can_search_couriers_by_name(): void
    {
        Courier::factory()->create(['name' => 'Budiono Hadi Agung']);
        Courier::factory()->create(['name' => 'Siti Aminah']);

        $response = $this->getJson('/api/couriers?search=budi+agung');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['name' => 'Budiono Hadi Agung']);
    }

    public function test_can_filter_couriers_by_level(): void
    {
        Courier::factory()->create(['level' => 1]);
        Courier::factory()->create(['level' => 2]);
        Courier::factory()->create(['level' => 3]);
        Courier::factory()->create(['level' => 4]);

        $response = $this->getJson('/api/couriers?level=2,3');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
        
        $levels = collect($response->json('data'))->pluck('level')->toArray();
        $this->assertContains(2, $levels);
        $this->assertContains(3, $levels);
        $this->assertNotContains(1, $levels);
    }

    public function test_can_show_courier(): void
    {
        $courier = Courier::factory()->create();

        $response = $this->getJson("/api/couriers/{$courier->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $courier->name]);
    }

    public function test_can_store_courier(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone_number' => '08123456789',
            'level' => 3,
            'vehicle_type' => 'Motorcycle'
        ];

        $response = $this->postJson('/api/couriers', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('couriers', ['email' => 'john@example.com']);
    }

    public function test_can_update_courier(): void
    {
        $courier = Courier::factory()->create(['name' => 'Old Name']);

        $response = $this->putJson("/api/couriers/{$courier->id}", [
            'name' => 'New Name'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('couriers', ['id' => $courier->id, 'name' => 'New Name']);
    }

    public function test_can_delete_courier(): void
    {
        $courier = Courier::factory()->create();

        $response = $this->deleteJson("/api/couriers/{$courier->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('couriers', ['id' => $courier->id]);
    }
}
