@extends('layouts.website')
@push('css')
    <style>
        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #ff2143;
            border-color: #ff2143;
        }

        .page-link {
            color: #ff2143;
        }

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
                <div class="col-lg-8">
                    <div class="whats-news-wrapper">
                        <!-- Heading & Nav Button -->
                        <div class="row justify-content-between align-items-end mb-15">
                            <div class="section-tittle mb-30 ml-5">
                                <h4 style="font-weight: 700;">{{ $status }}</h4>
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
                                                <div class="col-xxl-12 col-lg-12 col-md-12">
                                                    <div class="whats-news-single mb-40 mb-40">
                                                        <div class="whates-img">
                                                            <a style="font-size:21px;"
                                                                href="{{ url('/') . '/post' . $post->post_slug }}">
                                                                <img
                                                                    src="{{ url('/') . '/storage/images/' . $post->post_thumbnail }}">
                                                            </a>
                                                        </div>
                                                        <div class="whates-caption whates-caption2">
                                                            <h4 class="string-2"><a style="font-size:21px;"
                                                                    href="{{ url('/') . '/post' . $post->post_slug }}">{{ $post->post_title }}</a>
                                                            </h4>
                                                            <span>
                                                                <?php $categoryArr = explode('/', $post->post_slug); ?>
                                                                @if (sizeof($categoryArr) > 2)
                                                                    <?php for ($i=1; $i < sizeof($categoryArr)-1; $i++) {
                                                                    ?>{{ str_replace('-', ' ', $categoryArr[$i]) . ' | ' }}
                                                                    <?php } ?>
                                                                @else
                                                                    None |
                                                                @endif
                                                                {{ timePost($post->created_at) }}
                                                            </span>
                                                            <p class="string-2" style="font-size:12px;">
                                                                {{ $post->post_excerpt }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{ $posts->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.navbars.slidebarWebsite')
            </div>
        </div>
    </div>
@endsection
