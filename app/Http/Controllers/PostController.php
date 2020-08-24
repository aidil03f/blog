<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        return view('posts.index',[
            'posts' => Post::latest()->paginate(6),
        ]);
    }
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
       $post = new Post;
       $post->title = $request->title;
       $post->slug = \Str::slug($request->title);
       $post->body = $request->body;
       $post->save();
       return redirect('posts');
    }
}
