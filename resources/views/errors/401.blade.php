@extends('layouts.website')
@push('css')
    <style>

    </style>
@endpush
<?php function timePost($time)
{
    return date('F d, Y', strtotime($time));
} ?>
@section('content')
    <div class="about-area2 gray-bg pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="error_page_content text-center">
                        <h1 class="text-danger" style="font-size: 150px;font-weight: 600;">401</h1>
                        <h2>Sorry :(</h2>
                        <h3>You are not authorized to access this page.</h3>
                        <p class="wow fadeInLeftBig animated" style="visibility: visible; animation-name: fadeInLeftBig;">
                            Please, continue to our <a href="{{route('home')}}" class="text-danger">Home page</a></p>
                            <form action="{{route('search-post')}}" method="get" class="d-flex justify-content-center">
                                <div class="input-group w-50 ">
                                    <input type="text" class="form-control" placeholder="Search Keyword" name="search" style="margin-left: 15px;border-radius: 0;box-shadow: none;outline: none;border: 0;">
                                    <button class="btn" type="submit" style="margin-right: 10px;margin-left: 10px;padding: 0px 10px 0px 10px;"><i class="fa fa-search text-white" style="font-size: 20px; "></i></button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            <div class="weekly2-news-area pt-50 pb-30 gray-bg">
                <div class="container">
                    <div class="weekly2-wrapper">
                        <div class="slider-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="small-tittle mb-30">
                                        <h4>Most Popular</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="weekly2-news-active d-flex">
                                        @foreach (Cache::get('postsPopular') as $post)
                                            <div class="weekly2-single">
                                                <div class="weekly2-img">
                                                    <a style="font-size:21px;"
                                                        href="{{ url('/') . '/post' . $post->post_slug }}">
                                                        <img src="{{ url('/') . '/storage/images/' . $post->post_thumbnail }}"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="weekly2-caption">
                                                    <h4 class="string-2" style="height: 45px;"><a
                                                            href="{{ url('/') . '/post' . $post->post_slug }}">{{ $post->post_title }}</a>
                                                    </h4>
                                                    <p style="text-transform: capitalize;">
                                                        <i class="fas fa-folder"></i>
                                                        <?php $categoryArr = explode('/', $post->post_slug); ?>
                                                        @if (sizeof($categoryArr) > 2)
                                                            <?php for ($i=1; $i < sizeof($categoryArr)-1; $i++) {
                                                            ?>{{ str_replace('-', ' ', $categoryArr[$i]) }}
                                                            @if ($i < sizeof($categoryArr) - 2)
                                                                <i class="fas fa-angle-double-right"></i>
                                                            @endif
                                                            <?php } ?>
                                                        @else
                                                            None
                                                        @endif
                                                        <i class="fas fa-calendar-check ml-2"></i>
                                                        {{ date('F d, Y', strtotime($post->created_at)) }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
