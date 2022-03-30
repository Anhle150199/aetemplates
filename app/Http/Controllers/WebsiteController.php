<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\System;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function getHome()
    {
        $posts = Post::where('post_type', 'Public')->orderBy('id', 'desc')->get();
        $menu = System::where('system_key', "menu_html")->first();
        return view('website.index', ['posts'=> $posts, 'menu'=> $menu->system_value]);

    }
}
