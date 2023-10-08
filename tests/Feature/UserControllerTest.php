<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_user()
    {
        $user = User::factory(3)->create();

        $response = $this->getJson('/api/user/all');

        $this->assertDatabaseMissing('users', [
            "name" => 'aldi'
        ]);
        $this->assertDatabaseCount('users', 3);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => $user->toArray()
        ]);
    }

    public function test_create_user()
    {
        $data = [
            'name' => 'aldi',
            'email' => 'aldi2@gmail.com',
            'password' => bcrypt(12345678)
        ];

        $response = $this->postJson('/api/user/create', $data);


        $this->assertDatabaseCount('users', 1);
        $response->assertStatus(200);
        $response->assertExactJson([
            'code' => 200,
            'status' => 'Success'
        ]);
    }

    public function test_getById_user()
    {
        $record = User::factory()->create();

        $response = $this->get("/api/user/{$record->id}");

        $this->assertDatabaseMissing('users', [
            "name" => 'aldi'
        ]);
        $this->assertDatabaseCount('users', 1);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => "$record->email"
        ]);
    }

}
