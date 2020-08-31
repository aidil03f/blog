<?php

namespace App\Http\Controllers;
use App\{Category, Post, Tag};
use Illuminate\Http\Request;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     //except itu pengecualian
    //     $this->middleware('auth')->except(['index','show']);
    // }

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
        return view('posts.create',[
            'post'          => new Post(),
            'categories'    => Category::get(),
            'tags'          => Tag::get(),
        ]);
    }

    public function store()
    {
    //    $post = new Post;
    //    $post->title = $request->title;
    //    $post->slug = \Str::slug($request->title);
    //    $post->body = $request->body;
    //    $post->save();
        $attr = request()->validate([
            'title'    => 'required|min:3',
            'body'     => 'required',
            'category' => 'required',
            'tags'     => 'array|required'
        ]);
        $attr['slug'] = \Str::slug(request('title'));
        $attr['category_id'] = request('category');
        //$attr['user_id'] = auth()->id();
        
        //$post = Post::create($attr);
        $post = auth()->user()->posts()->create($attr);
        $post->tags()->attach(request('tags'));
        session()->flash('success','The post was created');
        return redirect('posts');
    }

    public function edit(Post $post)
    {
        return view('posts.edit',[
            'post'       => $post,
            'categories' => Category::get(),
            'tags'       => Tag::get(),
        ]);
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post);
        $attr = request()->validate([
            'title' => 'required|min:3',
            'body'  => 'required',
            'category' => 'required',
            'tags'     => 'array|required'
        ]);
        $attr['category_id'] = request('category');
        $post->update($attr);

        $post->tags()->sync(request('tags'));
        session()->flash('success','The post was updated');
        return redirect('posts');
    }

    public function destroy(Post $post)
    {
        // $post->tags()->detach();
        // $post->delete();
        // session()->flash('success','The post was destroyed');
        // return redirect('posts');

        // if(auth()->user()->is($post->author)){
        //     $post->tags()->detach();
        //     $post->delete();
        //     session()->flash('success','The post was destroyed');
        //     return redirect('posts');
        // } else {
        //     session()->flash("error","It wasn't your post");
        //     return redirect('posts');
        // }
        $this->authorize('update', $post);
        session()->flash('success','The post was destroyed');
        return redirect('posts');
    }
}
