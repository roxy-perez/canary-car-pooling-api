<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Car;
use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class EntityPolicyTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  public function test_any_user_can_view_any_car()
  {
    $car = Car::factory()->create();

    $response = $this->get('/api/cars');

    $response->assertStatus(200);
  }

  public function test_admin_can_create_car()
  {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin, 'sanctum');

    $carData = [
      'name' => $this->faker->word,
      'make' => $this->faker->word,
      'model' => $this->faker->word,
      'year' => $this->faker->year,
    ];

    $response = $this->post('/api/cars', $carData);

    $response->assertStatus(201);
  }

  public function test_non_admin_cannot_create_car()
  {
    $user = User::factory()->create(['role' => 'user']);
    $this->actingAs($user, 'sanctum');

    $carData = [
      'name' => $this->faker->word,
      'make' => $this->faker->word,
      'model' => $this->faker->word,
      'year' => $this->faker->year,
    ];

    $response = $this->post('/api/cars', $carData);

    $response->assertStatus(403);
  }

  public function test_admin_can_update_car()
  {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin, 'sanctum');

    $car = Car::factory()->create();

    $updateData = [
      'name' => $this->faker->word,
    ];

    $response = $this->put("/api/cars/{$car->id}", $updateData);

    $response->assertStatus(200);
  }

  public function test_non_admin_cannot_update_car()
  {
    $user = User::factory()->create(['role' => 'user']);
    $this->actingAs($user, 'sanctum');

    $car = Car::factory()->create();

    $updateData = [
      'name' => $this->faker->word,
    ];

    $response = $this->put("/api/cars/{$car->id}", $updateData);

    $response->assertStatus(403);
  }

  public function test_admin_can_delete_car()
  {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin, 'sanctum');

    $car = Car::factory()->create();

    $response = $this->delete("/api/cars/{$car->id}");

    $response->assertStatus(204);
  }

  public function test_non_admin_cannot_delete_car()
  {
    $user = User::factory()->create(['role' => 'user']);
    $this->actingAs($user, 'sanctum');

    $car = Car::factory()->create();

    $response = $this->delete("/api/cars/{$car->id}");

    $response->assertStatus(403);
  }
}
