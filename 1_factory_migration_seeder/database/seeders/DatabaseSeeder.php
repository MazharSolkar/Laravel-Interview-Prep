<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
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
            ['id' => 1,'name' => 'java'],
            ['id' => 2,'name' => 'python'],
            ['id' => 3,'name' => 'perl'],
            ['id' => 4,'name' => 'ruby'],
    ]);

        User::factory(10)->create();
        Post::factory(20)->create();

        // for populating category_post table (many to many relation between post and category)
        $posts = Post::get();
        foreach($posts as $post) {
            $post->categories()->attach(Category::get()->random()->id);
        }
    }
}
