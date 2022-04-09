@extends('layouts.website')
@push('meta')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $post->post_title }} | {{ Cache::get('systemDetail')['app_name'] }}" />
    <meta property="og:description" content="{{ $post->post_excerpt }}" />
    <meta property="og:image" content="{{ url('/') . '/storage/images/' . $post->post_thumbnail }}" />
@endpush
@section('title', $post->post_title)
<?php function timePost($time)
{
    return date('F d, Y', strtotime($time));
} ?>
@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0&appId=654995545568149&autoLogAppEvents=1"
        nonce="uQFpFuX6"></script>
    <section class="blog_area single-post-area section-padding" style="padding-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="">
                        <h2 style="font-weight: 700;">{{ $post->post_title }}</h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><i class="fas fa-folder"></i>
                                @foreach ($categories as $category)
                                    <i class="fas fa-angle-double-right"></i>
                                    <a href="{{ url('/') . '/category' . $category->cate_slug }}">
                                        {{ $category->cate_name }}
                                    </a>
                                @endforeach
                            </li>
                            <li><i class="fas fa-calendar-check"></i> {{ timePost($post->created_at) }}</li>
                            <li><i class="fas fa-eye"></i> {{ $post->post_views }} views</li>
                        </ul>
                        <div class="feature-img mb-5">
                            <img src="{{ url('/') . '/storage/images/' . $post->post_thumbnail }}"
                                alt="{{ $post->post_title }}">
                        </div>
                        <div class="blog-detail">
                            <style>
                                .btn::before {
                                    content: none;
                                }

                            </style>
                            <?php echo $post->post_content; ?>
                        </div>
                    </div>
                    <div class="fb-share-button"
                        data-href="{{url()->current()}}"
                        data-layout="button" data-size="large"><a target="_blank"
                            href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fblog.hubspot.com%2Fblog%2Ftabid%2F6307%2Fbid%2F29544%2Fthe-ultimate-cheat-sheet-for-creating-social-media-buttons.aspx&amp;src=sdkpreparse"
                            class="fb-xfbml-parse-ignore"></a></div>
                    <div class="blog_right_sidebar">

                        <aside class="single_sidebar_widget tag_cloud_widget bg-white m-0">
                            <div style="width: max-content;float: left;margin: auto;margin-right: 30px;">
                                <h4 class="widget_title">Tag Post: </h4>
                            </div>
                            <div>
                                <ul class="list">
                                    @foreach ($tags as $tag)
                                        <li>
                                            <a
                                                href="{{ url('/') . '/tag/' . $tag->tag_slug }}">{{ $tag->tag_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </aside>
                    </div>

                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <ul class="social-icons">
                                <li><span>Share: </span></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                        <div class="navigation-area">
                            <div class="row">
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    @isset($previous)
                                        <div class="thumb" style="width: 60%;">
                                            <a href="{{ url('/') . '/post' . $previous->post_slug }}">
                                                <img class="img-fluid"
                                                    src="{{ url('/') . '/storage/images/' . $previous->post_thumbnail }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="#">
                                                <span class="lnr text-white fas fa-angle-double-left"></span>
                                            </a>
                                        </div>
                                        <div class="detials">
                                            <p>Prev Post</p>
                                            <a href="{{ url('/') . '/post' . $previous->post_slug }}">
                                                <h4 class="string-2">{{ $previous->post_title }}</h4>
                                            </a>
                                        </div>
                                    @endisset
                                </div>
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    @isset($next)
                                        <div class="detials">
                                            <p>Next Post</p>
                                            <a href="{{ url('/') . '/post' . $next->post_slug }}">
                                                <h4 class="string-2">{{ $next->post_title }}</h4>
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="#">
                                                <span class="lnr text-white fas fa-angle-double-right"></span>
                                            </a>
                                        </div>
                                        <div class="thumb" style="width: 60%;">
                                            <a href="{{ url('/') . '/post' . $next->post_slug }}">
                                                <img class="img-fluid"
                                                    src="{{ url('/') . '/storage/images/' . $next->post_thumbnail }}" alt="">
                                            </a>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="whats-news-wrapper mt-3">
                            <!-- Heading & Nav Button -->
                            <div class="row justify-content-between align-items-end mb-15">
                                <div class="col-xl-4">
                                    <div class="section-tittle mb-30">
                                        <h4>Related</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab content -->
                            <div class="row">
                                <div class="col-12">
                                    <!-- Nav Card -->
                                    <div class="tab-content" id="nav-tabContent">
                                        <!-- card one -->
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                            aria-labelledby="nav-home-tab">
                                            <div class="row">
                                                @foreach ($relatedPost as $post)
                                                    <div class="col-xxl-4 col-lg-4 col-md-4">
                                                        <div class="whats-news-single mb-40 mb-40">
                                                            <div class="whates-img">
                                                                <a href="{{ url('/') . '/post' . $post->post_slug }}">
                                                                    <img style="width: 100%;"
                                                                        src="{{ url('/') . '/storage/images/' . $post->post_thumbnail }}"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                            <div class="whates-caption whates-caption2">
                                                                <h6 class="string-2">
                                                                    <a
                                                                        href="{{ url('/') . '/post' . $post->post_slug }}">
                                                                        {{ $post->post_title }}
                                                                    </a>
                                                                </h6>
                                                                <span style="font-size: 12px;"><i
                                                                        class="fas fa-calendar-check"></i>
                                                                    {{ timePost($post->created_at) }}
                                                                </span>
                                                            </div>
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
                @include('layouts.navbars.slidebarWebsite')
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ url('/') }}/js/website/post.js"></script>
@endpush
