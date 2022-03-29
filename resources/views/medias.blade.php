@extends('layouts.app')

@push('css')
    <style>
        div.gallery {
            border: 1px solid #ccc;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }

        * {
            box-sizing: border-box;
        }

        .responsive {
            padding: 0 6px;
            float: left;
            width: 24.99999%;
        }

        @media only screen and (max-width: 700px) {
            .responsive {
                width: 49.99999%;
                margin: 6px 0;
            }
        }

        @media only screen and (max-width: 500px) {
            .responsive {
                width: 100%;
            }
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

    </style>
@endpush

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
                                <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Media </a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">All Media</h3>
                        <p class="text-sm mb-0"></p>
                    </div>
                    <div class="card-body" id="body-images">
                        @foreach ($images as $image)
                            {{-- <div class="responsive">
                                <div class="gallery">
                                    <a target="_blank" href="#">
                                        <img src="{{ url('/') . '/storage/images/' . $image->img_name }}" width="600"
                                            height="400">
                                    </a>
                                    <div class="desc">{{ $image->img_name }}</div>
                                </div>
                            </div> --}}
                            <div class="card float-left mr-2 card-image" style="width: 15%;">
                                {{-- <div class="card-img-top"> --}}
                                    {{-- <img src="{{ url('/') . '/storage/images/' . $image->img_name }}"
                                        class="" alt="..."> --}}
                                {{-- </div> --}}
                                <div class="p-3 card-img-name" data-id="{{$image->id}}">
                                    <span class="">{{ $image->img_name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Success Modal --}}
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 65%;margin: auto;">
                <div class="modal-body row text-success" style="font-style: oblique;font-weight: 900;">
                    <div class="col-4 text-right">
                        <i class="fas fa-check-circle" style="font-size: 4rem;"></i>
                    </div>
                    <div class="col-7 d-flex align-items-center text-success" name="successModal"
                        style='font-size: 1.5rem;'>
                        Success !
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Error Modal --}}
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-danger d-flex justify-content-around"
                    style="font-style: oblique;font-weight: 700;">
                    <div class="col-4 d-flex align-items-center justify-content-around text-right">
                        <i class="fas fa-exclamation-triangle" style="font-size: 4rem;"></i>
                    </div>
                    <div class="col-7  " name="errorModal">
                        <h1 class="text-danger">Error!!</h1>
                        <div id="statusError">
                            <ul></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" id="btnYesDeletePost">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ url('/') }}/js/admin/media.js"></script>
@endpush
