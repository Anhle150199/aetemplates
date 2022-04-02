<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryRelationship;
use App\Models\Post;
use App\Models\System;
use App\Models\TagRelationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebsiteController extends Controller
{
    protected $postsPopular;
    protected $postsLast;
    protected $system;

    public function __construct()
    {
        if (Cache::has('systemDetail') == false) {
            $system = System::all();
            $systemArr = array();
            foreach ($system as $item) {
                $systemArr[$item->system_key] = $item->system_value;
            }
            Cache::put('systemDetail', $systemArr, 600);
        }
        if (Cache::has('postsPopular') == false || Cache::has('postsLast') == false ) {
            $postsPopular = Post::where('post_type', 'Public')->orderBy('post_views', 'desc')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'created_at')->limit('5')->get();
            $postsLast = Post::where('post_type', 'Public')->orderBy('id', 'desc')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'created_at')->limit('5')->get();

            Cache::put('postsLast', $postsLast, 600);
            Cache::put('postsPopular', $postsPopular, 600);
        }
        $this->postsPopular = Cache::get('postsPopular');
        $this->postsLast = Cache::get('postsLast');
        $this->system = Cache::get('systemDetail');
    }

    public function getHome()
    {
        $posts = Post::where('post_type', 'Public')->orderBy('id', 'desc')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'created_at')->limit('10')->get();
        // var_dump($this->postsPopular);
        return view('website.index', ['posts' => $posts, 'system' => $this->system, 'postsPopular' => $this->postsPopular]);
    }

    public function getPost($slug)
    {
        $post = Post::where('post_slug', '/'.$slug)->first();
        $tags = TagRelationship::where('post_id',$post->id)->join('ae_tags', 'tag_id', 'ae_tags.id')->get();
        $categories = CategoryRelationship::where('post_id',$post->id)->join('ae_categories', 'cate_id', 'ae_categories.id')->get();
        return view('website.post', ['post' => $post,'postId'=> $post->id, 'tags' =>$tags,'categories'=>$categories, 'system' => $this->system, 'postsPopular' => $this->postsPopular, 'postLast' => $this->postsLast]);
        // var_dump($slug);
    }
}
