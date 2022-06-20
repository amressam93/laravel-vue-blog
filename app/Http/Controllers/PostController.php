<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    /**
     * return all posts.
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->with('user')->paginate(1);
        foreach ($posts as $post)
        {
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comments->count());
        }
        return response()->json($posts);
    }

    /**
     * create new post.
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * store new post.
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /** display post by id.
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([
            'id'             => $post->id,
            'slug'           => $post->slug,
            'body'           => $post->body,
            'added_at'       => $post->created_at->diffForHumans(),
            'comments_count' => $post->comments->count(),
            'image'          => $post->image,
            'user'           => $post->user,
            'title'          => $post->title,
            'category'       => $post->category,
            'comments'       => $post->comments->map(function ($comment){
                return[
                    'id'=>$comment->id,
                    'body'=>$comment->body,
                    'user'=>$comment->user,
                    'added_at'=>$comment->created_at->diffForHumans()
                ];
            })
        ]);


    }


    /**
     * custom Comments Formatted.
     * @param $comments
     * @return array
     */
    public function commentsFormatted($comments)
    {
        $new_comments = [];
        foreach ($comments as $comment)
        {
            array_push($new_comments,
            [
               'id' => $comment->id,
               'body' => $comment->body,
               'user' => $comment->user,
               'added_at' => $comment->created_at->diffForHumans()
            ]);
        }

        return $new_comments;

    }


    /**
     *
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * update post by id.
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * delete post by id.
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }


    /**
     * get all posts by Category Slug.
     * @param $slug
     * @return void
     */
    public function categoryPosts($slug)
    {
        $category = Category::whereSlug($slug)->first();
        $posts = Post::whereCategoryId($category->id)->with('user')->get();

        foreach ($posts as $post)
        {
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comments->count());
        }

        return response()->json($posts);
    }


    /**
     * search posts
     * @param $query
     * @return void
     */
    public function searchPosts($query)
    {
        $posts = Post::where('title','like','%'.$query.'%')
            ->orWhere('body', 'like', '%'.$query.'%')
            ->with('user');

        $number_of_posts = count($posts->get());  // get all rows count.

        foreach ($posts->get() as $post)
        {
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comments->count());
        }

        $posts = $posts->paginate(intval($number_of_posts));

        return response()->json($posts);
    }




}
