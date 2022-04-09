@extends('layouts.website')
@section('content')
    <div class="about-area2 gray-bg pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="error_page_content text-center">
                        <h1 class="text-danger" style="font-size: 150px;font-weight: 600;">429</h1>
                        <h2>Sorry :(</h2>
                        <h3>There is currently too much traffic.</h3>
                        <p class="wow fadeInLeftBig animated" style="visibility: visible; animation-name: fadeInLeftBig;">
                            Please, continue to our <a href="{{route('home')}}" class="text-danger">Home page</a> in a few minutes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
