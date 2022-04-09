@extends('layouts.app')
<?php
function fomatPercent($percent)
{
    return number_format((float) $percent, 2, '.', '');
}
?>
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{ config('app.name') }}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    {{-- Views Today --}}
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0"> Views Today</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $viewToday->views }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    @if ($viewToday->views > $viewYesterday->views)
                                        <span class="text-success mr-2">
                                            <i class="fa fa-arrow-up"></i>
                                            @if ($viewYesterday->views > 0)
                                                {{ fomatPercent(($viewToday->views * 100) / $viewYesterday->views) }}
                                            @else
                                                {{ $viewToday->views }}00
                                            @endif
                                            %
                                        </span>
                                    @else
                                        <span class="text-danger mr-2">
                                            <i class="fa fa-arrow-down"></i>
                                            @if ($viewYesterday->views > 0)
                                                {{ fomatPercent(($viewToday->views * 100) / $viewYesterday->views) }}
                                            @else
                                                {{ $viewYesterday->views }}00
                                            @endif
                                            %
                                        </span>
                                    @endif
                                    <span class="text-nowrap">compared to yesterday</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- Views Month --}}
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Views 30 days</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $viewMonth }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    @if ($viewMonth > $viewlastMonth)
                                        <span class="text-success mr-2">
                                            <i class="fa fa-arrow-up"></i>
                                            @if ($viewlastMonth > 0)
                                                {{ fomatPercent(($viewMonth * 100) / $viewlastMonth) }}
                                            @else
                                                {{ $viewMonth }}00
                                            @endif
                                            %
                                        </span>
                                    @else
                                        <span class="text-danger mr-2">
                                            <i class="fa fa-arrow-down"></i>
                                            @if ($viewlastMonth > 0)
                                                {{ fomatPercent(100 - ($viewMonth * 100) / $viewlastMonth) }}
                                            @else
                                                {{ $viewlastMonth }}00
                                            @endif %
                                        </span>
                                    @endif
                                    <span class="text-nowrap">compared 30 days ago</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- New Posts --}}
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">New Posts</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $countPost30 }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="fas fa-folder-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    @if ($countPost30 > $countPost60)
                                        <span class="text-success mr-2">
                                            <i class="fa fa-arrow-up"></i>
                                            @if ($countPost60 > 0)
                                                {{ fomatPercent(($countPost30 * 100) / $countPost60) }}
                                            @else
                                                {{ $countPost30 }}00
                                            @endif
                                            %
                                        </span>
                                    @else
                                        <span class="text-danger mr-2">
                                            <i class="fa fa-arrow-down"></i>
                                            @if ($countPost60 > 0)
                                                {{ fomatPercent(100 - ($countPost30 * 100) / $countPost60) }}
                                            @else
                                                {{ $countPost30 }}00
                                            @endif %
                                        </span>
                                    @endif
                                    <span class="text-nowrap">compared 30 days ago</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-default">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                                <h5 class="h3 text-white mb-0">Sales value</h5>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark"
                                        data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}'
                                        data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span class="d-none d-md-block">Month</span>
                                            <span class="d-md-none">M</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark"
                                        data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}'
                                        data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Week</span>
                                            <span class="d-md-none">W</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Top post for 30 days</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Post Title</th>
                                    <th scope="col">Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topPosts as $post)

                                @endforeach
                                <tr>
                                    <th scope="row">
                                        <a href="{{url('/').'/post'.$post->post_slug}}">
                                            {{$post->post_title}}
                                        </a>
                                    </th>
                                    <td>
                                        {{$post->view}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
@endsection
@push('js')
    <script src="vendor/chart.js/dist/Chart.min.js"></script>
    <script src="vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
