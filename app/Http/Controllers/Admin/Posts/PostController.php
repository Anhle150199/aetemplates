<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function getNewPost()
    {
        return view('posts.detailPost', ['status'=>'New Post']);
    }
}
