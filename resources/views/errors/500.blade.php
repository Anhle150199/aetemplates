@extends('errors::minimal')

@section('title', __('Server Maintenance'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="error_page_content text-center">
                    <h1 class="text-danger" style="font-size: 150px;font-weight: 600;">500</h1>
                    <h2>Sorry :(</h2>
                    <h3>The system is having problems. We will be back as soon as possible.</h3>
                    <p class="wow fadeInLeftBig animated" style="visibility: visible; animation-name: fadeInLeftBig;">
                        We will come back as soon as possible.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
