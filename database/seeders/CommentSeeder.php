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
           'body' => 'Some comment here from a simple user',
           'user_id' => 1,
           'post_id' => 1
        ]);



        Comment::create([
            'body' => 'its good post from user one',
            'user_id' => 1,
            'post_id' => 2
        ]);



        Comment::create([
            'body' => 'can you help me for this question',
            'user_id' => 1,
            'post_id' => 3
        ]);

    }
}
