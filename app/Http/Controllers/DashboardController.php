<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $month = date('Ym', strtotime('now'));
        $today = date('Ymd', strtotime('now'));
        $yesterday = date('Ymd', strtotime('yesterday'));
        $lastMonth = date('Ym', strtotime('last month'));
        $viewToday = View::where('type', 0)->where('period', $today)->first();
        if ($viewToday == null) {
            $viewToday = new View();
            $viewToday->views = 0;
        }

        $viewYesterday = View::where('type', 0)->where('period', $yesterday)->first();
        if ($viewYesterday == null) {
            $viewYesterday = new View();
            $viewYesterday->views = 0;
        }

        $viewMonth = View::where('type', 0)->where('period', $month)->first();
        if ($viewMonth == null) {
            $viewMonth = new View();
            $viewMonth->views = 0;
        }
 
        $viewlastMonth = View::where('type', 0)->where('period', $lastMonth)->first();
        if ($viewlastMonth == null) {
            $viewlastMonth = new View();
            $viewlastMonth->views = 0;
        }
        return view('dashboard', ['slidebar' => ['dashboards',], 'viewToday' => $viewToday, 'viewYesterday' => $viewYesterday, 'viewMonth' => $viewMonth, 'viewlastMonth' => $viewlastMonth]);
    }
}
