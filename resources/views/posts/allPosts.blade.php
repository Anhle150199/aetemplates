@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ url('/') }}/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="{{ url('/') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="{{ url('/') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css"> --}}
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
                                <li class="breadcrumb-item"><a href="#">Posts </a></li>
                                <li class="breadcrumb-item active" aria-current="page">All</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('new-post') }}" class="btn btn-sm btn-neutral text-danger">New post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">All Posts</h3>
                        <p class="text-sm mb-0"></p>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th>Post Title</th>
                                    <th>Post Views</th>
                                    <th>Post Type</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $indexPost = 1; ?>
                                @foreach ($allPosts as $post)
                                    <tr id="{{ $indexPost }}" data-id="{{ $post->id }}">
                                        <td>{{ $post->post_title }}</td>
                                        <td>{{ $post->post_views }}</td>
                                        <td>{{ $post->post_type }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->updated_at }}</td>
                                        <td class="table-actions"></td>
                                    </tr>
                                    <?php $indexPost += 1; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ url('/') }}/js/admin/usersManage.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
@endpush
