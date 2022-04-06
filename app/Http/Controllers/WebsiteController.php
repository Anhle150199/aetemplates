<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryRelationship;
use App\Models\Post;
use App\Models\System;
use App\Models\Tag;
use App\Models\TagRelationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebsiteController extends Controller
{
    protected $postsPopular;
    protected $postsLast;
    protected $system;
    protected $allTags;

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
        if (Cache::has('postsPopular') == false || Cache::has('postsLast') == false) {
            $postsPopular = Post::where('post_type', 'Public')->orderBy('post_views', 'desc')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'created_at')->limit('5')->get();
            $postsLast = Post::where('post_type', 'Public')->orderBy('id', 'desc')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'created_at')->limit('5')->get();

            Cache::put('postsLast', $postsLast, 600);
            Cache::put('postsPopular', $postsPopular, 600);
        }
        if (Cache::has('allTags') == false) {
            $this->allTags = Tag::all();
            Cache::put('allTags', $this->allTags, 600);
        }
    }

    // home page
    public function getHome()
    {
        $posts = Post::where('post_type', 'Public')->orderBy('id', 'desc')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'created_at')->limit('10')->get();
        return view('website.index', ['posts' => $posts]);
    }

    // get list all post
    public function getAllPost()
    {
        $posts = Post::where('post_type', 'Public')->orderBy('id','desc')->paginate(10);
        return view('website.listPost', ['status'=>'Recent Post', 'posts' => $posts, 'system' => $this->system, 'postsPopular' => $this->postsPopular, 'postLast' => $this->postsLast, 'allTags' => $this->allTags]);
    }

    public function getPostForCategory($slug)
    {
        $category =Category::where('cate_slug','/'.$slug)->first();
        if ($category ==null) return view('errors.404');
        $posts = CategoryRelationship::where( 'cate_id', $category->id)->join('ae_posts', 'post_id', 'ae_posts.id')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'ae_posts.created_at')->orderBy('ae_posts.id','desc')->paginate(10);
        return view('website.listPost', ['status'=>'Category: '.$category->cate_name, 'posts' => $posts, 'system' => $this->system, 'postsPopular' => $this->postsPopular, 'postLast' => $this->postsLast, 'allTags' => $this->allTags]);

    }

    public function getPostForTag($slug)
    {
        $tag = Tag::where('tag_slug', $slug)->first();
        if ($tag ==null) return view('errors.404');
        $posts = TagRelationship::where('tag_id', $tag->id)->join('ae_posts', 'post_id', 'ae_posts.id')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'ae_posts.created_at')->orderBy('ae_posts.id','desc')->paginate(10);
        return view('website.listPost', ['status'=>'Tag: '.$tag->tag_name, 'posts' => $posts, 'system' => $this->system, 'postsPopular' => $this->postsPopular, 'postLast' => $this->postsLast, 'allTags' => $this->allTags]);

    }
    //get detail post
    public function getPost($slug)
    {
        $post = Post::where('post_type', 'Public')->where('post_slug', '/' . $slug)->first();
        if ($post ==null) return view('errors.404');
        $tags = TagRelationship::where('post_id', $post->id)->join('ae_tags', 'tag_id', 'ae_tags.id')->get();
        $categories = CategoryRelationship::where('post_id', $post->id)->join('ae_categories', 'cate_id', 'ae_categories.id')->orderBy('ae_categories_relationship.id','desc')->get();
        $relatedPost = CategoryRelationship::where('cate_id', $categories[0]->id)->join('ae_posts', 'post_id','ae_posts.id')->orderBy('ae_posts.id','desc')->limit(6)->get();
        $previous = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->select('post_slug', 'post_title', 'post_thumbnail')->first();
        $next = Post::where('id', '>', $post->id)->orderBy('id', 'asc')->select('post_slug', 'post_title', 'post_thumbnail')->first();
        return view('website.post', ['post' => $post, 'postId' => $post->id, 'tags' => $tags, 'categories' => $categories,'relatedPost' =>$relatedPost, 'next' => $next, 'previous' => $previous, 'system' => $this->system, 'postsPopular' => $this->postsPopular, 'postLast' => $this->postsLast, 'allTags' => $this->allTags]);
    }

    public function getSearch(Request $request)
    {

        if($request->has('search')){
            $posts = Post::where('post_type', 'Public')->where('post_title','like', '%'.$request->search.'%')->paginate(10);
            return view('website.listPost', ['status'=>'Search Results for: '.$request->search, 'posts' => $posts, 'system' => $this->system, 'postsPopular' => $this->postsPopular, 'postLast' => $this->postsLast, 'allTags' => $this->allTags]);
        };
    }

}
