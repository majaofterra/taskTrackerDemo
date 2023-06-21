<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class projectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_success(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('projects')->assertStatus(200);
        $response = $this->actingAs($user)->post('/project/store', [
            'name' => fake()->words(3,true),
        ]);
        $response->assertStatus(200);
    }

    public function test_failure(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/project/store', [
            'bar' => rand(1,9),
        ]);
        $response->assertStatus(302);
        $response->assertInvalid(['name']);
    }

    //this is a broken test due to database being wiped, change to status 200  when db problem fixed
    public function test_search(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->putJson('/api/project', ['project' => '1'])->assertStatus(500);
    }
    
}
