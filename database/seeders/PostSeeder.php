<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => 'Simple title',
            'slug' => Str::slug('simple title'),
            'body' => 'a simple Title',
            'image' => 'p1.png',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Post::create([
            'title' => 'Human Post',
            'slug' => Str::slug('human post'),
            'body' => 'human post',
            'image' => 'p1.png',
            'user_id' => 1,
            'category_id' => 2,
        ]);

        Post::create([
            'title' => 'MYSQl',
            'slug' => Str::slug('mysql-post'),
            'body' => 'MYSQl',
            'image' => 'p1.png',
            'user_id' => 1,
            'category_id' => 5,
        ]);


        Post::create([
            'title' => 'Body Of Html',
            'slug' => Str::slug('html title'),
            'body' => 'a Body of Html',
            'image' => 'p1.png',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Post::create([
            'title' => 'Route of Laravel',
            'slug' => Str::slug('route laravel'),
            'body' => 'Route of Laravel',
            'image' => 'p1.png',
            'user_id' => 1,
            'category_id' => 4,
        ]);
    }
}
