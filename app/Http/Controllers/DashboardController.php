<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $month = date('Ym', strtotime('now'));
        $lastMonth = date('Ym', strtotime('last month'));

        $today = date('Ymd', strtotime('now'));
        $yesterday = date('Ymd', strtotime('yesterday'));
        $before30days = date('Ymd', strtotime('-30 days'));
        $before60days = date('Ymd', strtotime('-60 days'));

        $viewToday = View::where('id_current', 0)->where('period', $today)->first();
        if ($viewToday == null) {
            $viewToday = new View();
            $viewToday->views = 0;
        }

        $viewYesterday = View::where('id_current', 0)->where('period', $yesterday)->first();
        if ($viewYesterday == null) {
            $viewYesterday = new View();
            $viewYesterday->views = 0;
        }

        $viewMonth = View::where('id_current', 0)->whereBetween('period', [$before30days, $today])->sum('views');
        $viewlastMonth = View::where('id_current', 0)->whereBetween('period', [$before60days, $before30days])->sum('views');

        $countPost30 = Post::whereBetween('created_at', [now()->subdays(30), now()->subday()])->count();
        $countPost60 = Post::whereBetween('created_at', [now()->subdays(60), now()->subday(30)])->count();

        $topPosts = View::where('id_current', '!=', 0)->whereBetween('period', [$before30days, $today])->join('ae_posts', 'ae_posts.id', 'id_current')->select( DB::raw('ae_posts.post_title, ae_posts.post_slug,SUM(ae_views.views) as view'))->groupBy('ae_posts.id')->get();
        return view('dashboard', ['slidebar' => ['dashboards',], 'viewToday' => $viewToday, 'viewYesterday' => $viewYesterday, 'viewMonth' => $viewMonth, 'viewlastMonth' => $viewlastMonth, 'countPost30' => $countPost30, 'countPost60' => $countPost60, 'topPosts' => $topPosts]);
    }
}
