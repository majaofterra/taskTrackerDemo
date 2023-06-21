<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SearchesTest extends TestCase
{
    use RefreshDatabase;

    public function test_status(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->putJson('/api/filter', ['status' => '1'])->assertStatus(200);
    }

    public function test_category(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->putJson('/api/filter', ['category' => '1'])->assertStatus(200);
    }

    public function test_category_and_status(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->putJson('/api/filter', ['category' => '1','status' => '1'])->assertStatus(200);
    }

    public function test_search_term(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->putJson('/api/search', ['term' => 'a'])->assertStatus(200);
    }
}
