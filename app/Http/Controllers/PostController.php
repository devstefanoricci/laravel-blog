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

        return redirect()->route('posts.index')->with('success','Post cancellato con successo!');

    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(10);
        return view('posts.trashed', ['posts' => $posts]);

    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore($id);

        //return $posts;
        return redirect()->route('posts.show', $post->id)->with('success','Post ripristinato con successo!');

    }


    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:30',
        ]);

        $posts = Post::where('title','like','%' . $request->input('search') . '%')->paginate();

        if ($posts->count() > 0) {
            return view('posts.index', ['posts' => $posts])->with('success', 'Risultati trovati');
        }

        return redirect()->back()->with('danger', 'Nessun risultato');
    }

}
