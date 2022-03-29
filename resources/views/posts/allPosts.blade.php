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
                                <li class="breadcrumb-item active" aria-current="page">All Posts</li>
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
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">All Posts</h3>
                        <p class="text-sm mb-0"></p>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th> Post Title</th>
                                    <th>Post Views</th>
                                    <th>Post Type</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allPosts as $post)
                                    <tr id="{{ $post->id }}" data-id="{{ $post->id }}">
                                        <td><a href="{{ url('/') . $post->post_slug }}" id="title{{$post->id}}">{{ $post->post_title }}</a></td>
                                        <td>{{ $post->post_views }}</td>
                                        <td>
                                            <div class="w-100">
                                                <select name="" class="btn btn-sm"
                                                    onchange="updateTypePost(this,'{{ $post->id }}')"
                                                    style="box-shadow: none;">
                                                    @if ($post->post_type == 'Drafts')
                                                        <option value="Drafts" selected>Drafts</option>
                                                        <option value="Public">Public</option>
                                                    @else
                                                        <option value="Drafts" selected>Drafts</option>
                                                        <option value="Public" selected>Public</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->updated_at }}</td>
                                        <td class="table-actions">
                                            <a href="{{ route('edit-post', ['id' => $post->id]) }}"
                                                class="table-action-edit" data-original-title="Edit Post"><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="#!" class="table-action table-action-delete" data-toggle="modal"
                                                data-original-title="Delete Post" data-target="#deleteModal"
                                                 data-post-id="{{$post->id}}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    <script src="{{ url('/') }}/js/admin/allPosts.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
@endpush
