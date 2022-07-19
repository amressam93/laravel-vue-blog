<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * make middleware to check if user is admin
     */
    public function __construct()
    {
        $this->middleware('IsAdmin');
    }


    /**
     * get all posts from database
     *
     * @return \Illuminate\Http\Response
     */
    public function getPosts()
    {
        $posts = Post::latest()->with('user','category')->paginate(1);
        foreach ($posts as $post) {

            $post->SetAttribute('added_at', $post->created_at->diffForHumans());
            $post->SetAttribute('comments_count', $post->comments->count());

        }
        return response()->json($posts);
    }



}
