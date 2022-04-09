<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryRelationship;
use App\Models\Post;
use App\Models\System;
use App\Models\Tag;
use App\Models\TagRelationship;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebsiteController extends Controller
{
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
            $postsPopular = Post::where('post_type', 'Public')->orderBy('post_views', 'desc')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'post_views', 'created_at')->limit('5')->get();
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
        return view('website.index', ['status' => 'Home','posts' => $posts]);
    }

    // get list all post
    public function getAllPost()
    {
        $posts = Post::where('post_type', 'Public')->orderBy('id', 'desc')->paginate(10);
        return view('website.listPost', ['status' => 'Recent Post', 'posts' => $posts,]);
    }

    public function getPostForCategory($slug)
    {
        $category = Category::where('cate_slug', '/' . $slug)->first();
        if ($category == null) return view('errors.404');
        $posts = CategoryRelationship::where('cate_id', $category->id)->join('ae_posts', 'post_id', 'ae_posts.id')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'ae_posts.created_at')->orderBy('ae_posts.id', 'desc')->paginate(10);
        return view('website.listPost', ['status' => 'Category: ' . $category->cate_name, 'posts' => $posts,]);
    }

    public function getPostForTag($slug)
    {
        $tag = Tag::where('tag_slug', $slug)->first();
        if ($tag == null) return view('errors.404');
        $posts = TagRelationship::where('tag_id', $tag->id)->join('ae_posts', 'post_id', 'ae_posts.id')->select('post_title', 'post_excerpt', 'post_slug', 'post_thumbnail', 'ae_posts.created_at')->orderBy('ae_posts.id', 'desc')->paginate(10);
        return view('website.listPost', ['status' => 'Tag: ' . $tag->tag_name, 'posts' => $posts,]);
    }
    //get detail post
    public function getPost($slug)
    {
        $post = Post::where('post_type', 'Public')->where('post_slug', '/' . $slug)->first();
        if ($post == null) return view('errors.404');
        $tags = TagRelationship::where('post_id', $post->id)->join('ae_tags', 'tag_id', 'ae_tags.id')->get();
        $categories = CategoryRelationship::where('post_id', $post->id)->join('ae_categories', 'cate_id', 'ae_categories.id')->orderBy('ae_categories_relationship.id', 'desc')->get();
        if (sizeof($categories) == 0) {
            $relatedPost = Cache::get('postsLast');
        } else
            $relatedPost = CategoryRelationship::where('cate_id', $categories[0]->id)->join('ae_posts', 'post_id', 'ae_posts.id')->orderBy('ae_posts.id', 'desc')->limit(6)->get();
        $previous = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->select('post_slug', 'post_title', 'post_thumbnail')->first();
        $next = Post::where('id', '>', $post->id)->orderBy('id', 'asc')->select('post_slug', 'post_title', 'post_thumbnail')->first();
        return view('website.post', ['post' => $post, 'postId' => $post->id, 'tags' => $tags, 'categories' => $categories, 'relatedPost' => $relatedPost, 'next' => $next, 'previous' => $previous,]);
    }

    public function getSearch(Request $request)
    {

        if ($request->has('search')) {
            $posts = Post::where('post_type', 'Public')->where('post_title', 'like', '%' . $request->search . '%')->paginate(10);
            return view('website.listPost', ['status' => 'Search Results for: ' . $request->search, 'posts' => $posts,]);
        };
    }

    public function updateView(Request $request)
    {
        if ($request->has('param')) {
            $post = Post::where('post_slug', $request->param)->first();
            $post->post_views = $post->post_views + 1;
            $post->save();

            $year = date('Y', strtotime('now'));
            $month = date('Ym', strtotime('now'));
            $day = date('Ymd', strtotime('now'));
            try {
                $viewDay = View::where('type', 0)->where('period', $day)->first();
                if ($viewDay == null) {
                    $viewDay = new View();
                    $viewDay->period = $day;
                    $viewDay->views = 0;
                    $viewDay->type = 0;
                }
                $viewDay->views = $viewDay->views + 1;
                $viewDay->save();
            } catch (\Throwable $th) {
                return response()->json([' day', $viewDay], 200);
            }

            $viewMonth = View::where('type', 0)->where('period', $month)->first();
            if ($viewMonth == null) {
                $viewMonth = new View();
                $viewMonth->views = 0;
                $viewMonth->type = 0;
                $viewMonth->period = $month;
            }
            $viewMonth->views = $viewMonth->views + 1;
            $viewMonth->save();

            $viewYear = View::where('type', 0)->where('period', $year)->first();
            if ($viewYear == null) {
                $viewYear = new View();
                $viewYear->views = 0;
                $viewMonth->type = 0;
                $viewYear->period = $year;
            }
            $viewYear->views = $viewYear->views + 1;
            $viewYear->save();

            try {
                $viewDayPost = View::where('type', 1)->where('period', $day . '-' . $post->id)->first();
                if ($viewDayPost == null) {
                    $viewDayPost = new View();
                    $viewDayPost->period = $day . '-' . $post->id;
                    $viewDayPost->views = 0;
                    $viewDayPost->type = 1;
                }
                $viewDayPost->views = $viewDayPost->views + 1;
                $viewDayPost->save();
            } catch (\Throwable $th) {
                return response()->json([' day', $viewDayPost], 200);
            }

            $viewMonthPost = View::where('type', 1)->where('period', $month . '-' . $post->id)->first();
            if ($viewMonthPost == null) {
                $viewMonthPost = new View();
                $viewMonthPost->views = 0;
                $viewMonthPost->type = 1;
                $viewMonthPost->period = $month . '-' . $post->id;
            }
            $viewMonthPost->views = $viewMonthPost->views + 1;
            $viewMonthPost->save();
        }
    }
}
