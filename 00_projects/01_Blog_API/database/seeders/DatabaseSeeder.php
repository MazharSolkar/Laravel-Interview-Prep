<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::insert([
            ['name'=> 'java'],
            ['name' => 'python'],
            ['name' => 'sql'],
            ['name' => 'alpha'],
            ['name' => 'beta'],
        ]);

        User::factory(10)->create();
        Post::factory(20)->create();

        $posts = Post::get();
        foreach($posts as $post) {
            $post->categories()->attach(Category::get()->random()->id);
        }

    }
}
