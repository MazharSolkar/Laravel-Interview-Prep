<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();
        category::factory(5)->create();
        Post::factory(30)->create();

        $posts = Post::get();
        foreach($posts as $post) {
            $post->categories()->attach(Category::get()->random()->id);
        }
    }
}
