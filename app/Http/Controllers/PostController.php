<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::with('user','category','comments')->paginate(10);
        return view('posts.index', ['posts' => $posts]);

    }

    public function show($id)
    {

        $post = \App\Models\Post::findOrFail($id);
        return response()->json($post);

    }

    public function store(Request $request)
    {

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
