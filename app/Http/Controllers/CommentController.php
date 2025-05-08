<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = \App\Models\Comment::all();
        return response()->json($comments);
    }

    public function show($id)
    {
        $comment = \App\Models\Comment::findOrFail($id);

        return response()->json($comment);

    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return true;

    }
}
