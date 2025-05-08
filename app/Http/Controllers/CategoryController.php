<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = \App\Models\Category::all();
        return response()->json($category);
    }

    public function show($id)
    {
        $category = \App\Models\Category::findOrFail($id);

        return response()->json($category);

    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return true;

    }
}
