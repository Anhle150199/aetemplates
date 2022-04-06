@extends('layouts.website')
@section('content')
    <!-- Trending Area Start -->
    <div class="trending-area fix pt-25 gray-bg">
        <div class="container">
            <div class="trending-main">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="slider-active">
                            <!-- Single -->
                            <div class="single-slider">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <a href="{{ url('/') . '/post' . $posts[0]->post_slug }}">
                                            <img src="{{ url('/') . '/storage/images/' . $posts[0]->post_thumbnail }}"
                                                alt="">
                                        </a>
                                        <div class="trend-top-cap trend-top-cap2">
                                            <?php $categoryArr = explode('/', $posts[0]->post_slug); ?>
                                            @if (sizeof($categoryArr) > 2)
                                                <?php for ($i=1; $i < sizeof($categoryArr)-1; $i++) {
                                                    ?>
                                                <span
                                                    class="bgr">{{ str_replace('-', ' ', $categoryArr[$i]) }}</span>
                                                <?php } ?>
                                            @endif
                                            <h2 class="text-white string-2" style="height: 57px;"><a
                                                    href="{{ url('/') . '/post' . $posts[0]->post_slug }}"
                                                    data-animation="fadeInUp" data-delay=".4s"
                                                    data-duration="1000ms">{{ $posts[0]->post_title }}</a></h2>
                                            <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms">
                                                <i class="fas fa-calendar-check ml-2"></i>
                                                {{ date('F d, Y', strtotime($posts[0]->created_at)) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right content -->
                    <div class="col-lg-4">
                        <!-- Trending Top -->
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <div class="trending-top mb-15">
                                    <div class="trend-top-img">
                                        <a href="{{ url('/') . '/post' . $posts[1]->post_slug }}">
                                            <img src="{{ url('/') . '/storage/images/' . $posts[1]->post_thumbnail }}"
                                                alt="">
                                        </a>
                                        <div class="trend-top-cap trend-top-cap2">
                                            <?php $categoryArr = explode('/', $posts[1]->post_slug); ?>
                                            @if (sizeof($categoryArr) > 2)
                                                <?php for ($i=1; $i < sizeof($categoryArr)-1; $i++) {
                                                ?>
                                                <span
                                                    class="bgr">{{ str_replace('-', ' ', $categoryArr[$i]) }}</span>
                                                <?php } ?>
                                            @endif
                                            <h2 class="text-white string-2" style="font-size: 17px;height: 50px;"><a
                                                    href="{{ url('/') . '/post' . $posts[1]->post_slug }}"
                                                    data-animation="fadeInUp" data-delay=".4s"
                                                    data-duration="1000ms">{{ $posts[1]->post_title }}</a></h2>
                                            <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms">
                                                <i class="fas fa-calendar-check ml-2"></i>
                                                {{ date('F d, Y', strtotime($posts[1]->created_at)) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <a href="{{ url('/') . '/post' . $posts[2]->post_slug }}">
                                            <img src="{{ url('/') . '/storage/images/' . $posts[2]->post_thumbnail }}"
                                                alt="">
                                        </a>
                                        <div class="trend-top-cap trend-top-cap2">
                                            <?php $categoryArr = explode('/', $posts[2]->post_slug); ?>
                                            @if (sizeof($categoryArr) > 2)
                                                <?php for ($i=1; $i < sizeof($categoryArr)-1; $i++) {
                                                ?>
                                                <span
                                                    class="bgr">{{ str_replace('-', ' ', $categoryArr[$i]) }}</span>
                                                <?php } ?>
                                            @endif
                                            <h2 class="text-white string-2" style="font-size: 17px;height: 50px;"><a
                                                    href="{{ url('/') . '/post' . $posts[2]->post_slug }}"
                                                    data-animation="fadeInUp" data-delay=".4s"
                                                    data-duration="1000ms">{{ $posts[2]->post_title }}</a></h2>
                                            <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms">
                                                <i class="fas fa-calendar-check ml-2"></i>
                                                {{ date('F d, Y', strtotime($posts[2]->created_at)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                @foreach ($postsPopular as $post)
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

    <section class="whats-news-area pt-50 pb-20 gray-bg">
        <div class="container">
            <div class="row">

                <div class="whats-news-wrapper">
                    <!-- Heading & Nav Button -->
                    <div class="row justify-content-between align-items-end mb-15">
                        <div class="col-xl-4">
                            <div class="section-tittle mb-30">
                                <h3>Last Templates</h3>
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-9">
                            <div class="properties__button">
                                <!--Nav Button  -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" href="{{ route('get-all-posts') }}">More
                                            Templates <i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </nav>
                                <!--End Nav Button  -->
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
                                        @foreach ($posts as $post)
                                            <div class="col-xxl-6 col-lg-6 col-md-6">
                                                <div class="whats-news-single mb-40 mb-40">
                                                    <div class="whates-img">
                                                        <a style="font-size:21px;"
                                                            href="{{ url('/') . '/post' . $post->post_slug }}">
                                                            <img src="{{ url('/') . '/storage/images/' . $post->post_thumbnail }}"
                                                                alt="">
                                                        </a>
                                                    </div>
                                                    <div class="whates-caption whates-caption2">
                                                        <h4 class="string-2"><a
                                                                href="{{ url('/') . '/post' . $post->post_slug }}">{{ $post->post_title }}</a>
                                                        </h4>
                                                        <span style="text-transform: capitalize;">
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
                                                        </span>

                                                        <p class="string-2">{{ $post->post_excerpt }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('get-all-posts') }}" class="btn btn-danger btn-sm"> <span>More
                                                <i class="fas fa-angle-double-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->
@endsection
