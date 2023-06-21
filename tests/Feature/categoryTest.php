<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class categoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_success(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('categories')->assertStatus(200);
        $response = $this->actingAs($user)->post('/category/store', [
            'name' => fake()->words(3,true),
        ]);
        $response->assertStatus(200);
    }

    public function test_failure(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/category/store', [
            'bar' => rand(1,9),
        ]);
        $response->assertStatus(302);
        $response->assertInvalid(['name']);
    }
}
