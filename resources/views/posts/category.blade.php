@extends('layouts.app')
@push('css')
@endpush

@section('content')
    <!-- Header -->
    <div class="header pb-6 bg-primary">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{ config('app.name') }}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fa fa-paper-plane"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Posts</a></li>
                                <li class="breadcrumb-item"><a href="#"> Categories </a></li>
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
            {{-- Add New Category --}}
            <div class="col-xl-3 order-xl-2">
                <div class="card card-profile">

                    {{-- Start form add category --}}
                    <form id="formAddCategory" action="{{ route('add-category') }}">
                        @csrf
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">New Category </h3>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group ">
                                            <label for="new-category" class=" col-form-label form-control-label">Category
                                                Name</label>
                                            <input type="text" id="new-category" name="new-category" class="form-control"
                                                placeholder="Category Name" required>
                                            <p class="p-error text-danger" id="error-new-category"></p>
                                        </div>
                                        <div class="form-group ">
                                            <label class=" col-form-label form-control-label" for="selectCateParent">Parent
                                                Category</label>
                                            <select class="form-control selectCateParent" id="selectCateParent"
                                                name="selectCateParent">
                                                <option value="0">None</option>
                                            </select>
                                            <p class="p-error text-danger" id="error-parent-select"></p>
                                        </div>

                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-sm btn-warning">Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                    {{-- End Form --}}
                    {{-- Success Modal --}}
                    <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="width: 65%;margin: auto;">
                                <div class="modal-body row text-success" style="font-style: oblique;font-weight: 900;">
                                    <div class="col-4 text-right">
                                        <i class="fas fa-check-circle" style="font-size: 4rem;"></i>
                                    </div>
                                    <div class="col-7 d-flex align-items-center text-success" style='font-size: 1.5rem;'>
                                        Success !
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Success Modal --}}
                    {{-- Error Modal --}}
                    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="width: 65%;margin: auto;">
                                <div class="modal-body row text-danger" style="font-style: oblique;font-weight: 900;">
                                    <div class="col-4 text-right">
                                        <i class="fas fa-exclamation-triangle" style="font-size: 4rem;"></i>
                                    </div>
                                    <div class="col-7 d-flex align-items-center text-danger" style='font-size: 1.5rem;'>
                                        Error !
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Error Modal --}}
                </div>
            </div>

            {{-- Categories List --}}
            <div class="col-xl-9 order-xl-1">
                <!-- Table -->
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header">
                                <h3 class="mb-0">Categories</h3>
                            </div>

                            <div class="card-body">
                                <div class="container">
                                    <div class=" border pb-2 pt-2">
                                        <div class="row " id="heading">
                                            <div class="no"></div>
                                            <div class="col-4"><span class="title">Name</span></div>
                                            <div class="col-4"><span class="title">Slug</span> </div>
                                            <div class="col-2"><span class="title">Posts</span></div>
                                            <div class="col "></div>
                                        </div>
                                        {{-- <hr> --}}
                                    </div>
                                    <div id="child-0" class="pt-2">
                                        <div class="d-flex justify-content-center align-items-center pt-4 ">
                                            <span id="status-table">Loading...</span>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>

                            {{-- Edit Categories --}}
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Categories </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('edit-category')}}" id="form-edit-category" >
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" id="edit-id" name="edit-id" hidden>
                                                    <label for="edit-category"
                                                        class=" col-form-label form-control-label">Category Name</label>
                                                    <input type="text" id="edit-category" name="edit-category"
                                                        class="form-control" required>
                                                    <p id="error-edit-category" class="p-error text-danger"></p>
                                                </div>
                                                <label class=" col-form-label form-control-label">Category Name: </label>
                                                <span id="slugEdit"></span>
                                                <div class="form-group ">
                                                    <label class=" col-form-label form-control-label"
                                                        for="selectCateParentEdit">Parent
                                                        Category</label>
                                                    <select class="form-control selectCateParent"
                                                        name="selectCateParentEdit" id="selectCateParentEdit">
                                                        <option value="0">None</option>
                                                    </select>
                                                    <p class="p-error text-danger" id="error-parent-edit"></p>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-warning">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Edit Categories --}}

                            {{-- Delete category --}}
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel"> </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('delete-category') }}" id="form-delete-category">
                                            <div class="modal-body">
                                                Slug: <span id="slug-delete-modal"></span>
                                                <p class="text-danger font-italic font-weight-bold">When you do a delete,
                                                    you will also delete its subcategories !!!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            {{-- End Delete Categories --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <style>
        .no {
            padding-left: 15px;
        }

        hr.hr-child {
            width: 10%;
            margin: 15px;
        }

        .title {
            /* margin-left: 10px; */
            font-weight: 700;
        }

    </style>
@endsection
@push('js')
    <script src="{{ url('/') }}/js/admin/categoriesManage.js"></script>
@endpush
