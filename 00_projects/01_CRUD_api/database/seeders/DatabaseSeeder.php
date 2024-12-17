<?php

namespace Database\Seeders;

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

        User::insert([
            ['name' => 'mazhar', 'email' => 'm@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'naved', 'email' => 'n@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'rahul', 'email' => 'r@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'javed', 'email' => 'j@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'kashaf', 'email' => 'k@gmail.com', 'password' => bcrypt('password')],
        ]);

        Post::factory(10)->create();
    }
}
