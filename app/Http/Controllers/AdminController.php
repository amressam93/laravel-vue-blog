<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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


    /**
     * get all categories from database
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }


    /**
     * add new post to database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPost(Request $request)
    {
        $filename = '';

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->slug  = Str::slug($request->title);
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        $post->image = $filename;
        $post->save();
        return response()->json($post);
    }


    /**
     * update post in database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePost(Request $request)
    {
        $post = Post::find($request->id);
        $filename = $post->image;
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $request->image->move(public_path('img'),$filename);
        }
        $post->title = $request->title;
        $post->slug  = Str::slug($request->title);
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->image = $filename != '' ? $filename : $post->image;
        $post->save();
        return response()->json($post);
    }








}
