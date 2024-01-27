<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_register_new_user()
    {
        $response = $this->post(route('api.register'), [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => 'password',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'status' => true,
            'alert' => [
                'title' => 'Registration',
                'message' => 'Registration successful',
            ],
        ]);
    }
}
