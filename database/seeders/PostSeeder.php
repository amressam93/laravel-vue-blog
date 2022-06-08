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
            'title' => 'a simple title',
            'slug' => Str::slug('a simple title'),
            'body' => 'Harum voluptas perferendis ut quasi aut. Sint sapiente sequi est possimus.',
            'image' => 'p1.jpg',
            'user_id' => 1,
            'category_id' => 1
        ]);



        Post::create([
            'title' => 'a simple title for javascript',
            'slug' => Str::slug('a simple title for javascript'),
            'body' => 'Harum voluptas perferendis ut quasi aut. Sint sapiente sequi est possimus a simple title for javascript.',
            'image' => 'p2.jpg',
            'user_id' => 1,
            'category_id' => 1
        ]);





        Post::create([
            'title' => 'a simple title for php',
            'slug' => Str::slug('a simple title for php'),
            'body' => 'Harum voluptas perferendis ut quasi aut. Sint sapiente sequi est possimus a simple title for php.',
            'image' => 'p3.jpg',
            'user_id' => 1,
            'category_id' => 1
        ]);

    }
}
