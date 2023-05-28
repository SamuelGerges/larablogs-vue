<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'body' => 'this is post is important',
            'user_id' => 1,
            'post_id' => 5,
        ]);

        Comment::create([
            'body' => 'this is post is important',
            'user_id' => 1,
            'post_id' => 2,
        ]);

        Comment::create([
            'body' => 'this is post is important',
            'user_id' => 1,
            'post_id' => 3,
        ]);
        Comment::create([
            'body' => 'this is post is bad',
            'user_id' => 1,
            'post_id' => 4,
        ]);
    }
}
