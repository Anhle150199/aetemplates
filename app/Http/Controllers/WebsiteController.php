<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function getHome()
    {
        $posts = Post::where('post_type', 'Public')->orderBy('id', 'desc')->get();
        $categories = Category::all();
        return view('website.index', ['posts'=> $posts, 'categories'=> $categories]);

    }
}
