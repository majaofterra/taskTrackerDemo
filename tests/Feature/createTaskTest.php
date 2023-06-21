<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class createTaskTest extends TestCase
{
    use RefreshDatabase;
    public function test_succes(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/task/create')->assertStatus(200);

        $response = $this->actingAs($user)->post('/task/store', [
            'name' => fake()->words(3,true),
            'description' => fake()->paragraph,
            'project' => rand(1,8),
            'category' => rand(1,9),
            'status' => rand(1,4),
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }

    public function test_failure(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/task/store', [
            'name' => fake()->words(3,true),
            'description' => fake()->paragraph,
            'foo' => rand(1,8),
            'bar' => rand(1,9),
        ]);
        $response->assertStatus(302);
        $response->assertInvalid(['status','project','category']);

    }
}
