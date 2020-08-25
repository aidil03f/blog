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

    public function store()
    {
    //    $post = new Post;
    //    $post->title = $request->title;
    //    $post->slug = \Str::slug($request->title);
    //    $post->body = $request->body;
    //    $post->save();
        $attr = request()->validate([
            'title' => 'required|min:3',
            'body'  => 'required',
        ]);
        $attr['slug'] = \Str::slug(request('title'));
        Post::create($attr);
        session()->flash('success','The post was created');
        return redirect('posts');
    }

    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    public function update(Post $post)
    {
        $attr = request()->validate([
            'title' => 'required|min:3',
            'body'  => 'required',
        ]);
        $post->update($attr);
        session()->flash('success','The post was updated');
        return redirect('posts');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('success','The post was destroyed');
        return redirect('posts');
    }
}
