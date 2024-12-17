<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Post::factory(20)->create();

        Category::insert([
            ['name' => 'java'], ['name' => 'php'], ['name' => 'perl'],
        ]);

        DB::table('category_post')->insert([
            ['category_id' => 1, 'post_id' => 1, 'created_at' => now()],
            ['category_id' => 1, 'post_id' => 3, 'created_at' => now(),],
            ['category_id' => 2, 'post_id' => 2, 'created_at' => now(),],
            ['category_id' => 2, 'post_id' => 3, 'created_at' => now(),],
            ['category_id' => 3, 'post_id' => 2, 'created_at' => now(),],
            ['category_id' => 3, 'post_id' => 1, 'created_at' => now(),],
            ['category_id' => 2, 'post_id' => 2, 'created_at' => now(),],
        ]);

    }
}
