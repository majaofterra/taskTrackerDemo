<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Status::factory()->create(['name' => 'done', ]);
        \App\Models\Status::factory()->create(['name' => 'in progress', ]);
        \App\Models\Status::factory()->create(['name' => 'on hold', ]);
        \App\Models\Status::factory()->create(['name' => 'todo', ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Project::factory(8)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Task::factory(30)->create();

    }
}
