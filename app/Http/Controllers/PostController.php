<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user','category','comments')->paginate(10);
        //return $posts;
        return view('posts.index', ['posts' => $posts]);

    }

    public function show($id)
    {

        $post = \App\Models\Post::findOrFail($id);
        return view('posts.show', ['post'=> $post]);

    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories]);
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
                'category_id' => 'required'
            ]
        );

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->user_id = rand(2,10);
        $post->save();

        return redirect()->route('posts.index')->with('success','Post creato con successo!');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $post = \App\Models\Post::findOrFail($id);
        return view('posts.edit', ['categories' => $categories, 'post' => $post]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return true;

    }


}
