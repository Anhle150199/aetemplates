@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">New User</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Users </a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add new user</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('get-all-user') }}" class="btn btn-sm btn-neutral text-danger">All user</a>
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
                        <h3 class="mb-0">New user</h3>
                        <p class="text-sm mb-0"></p>
                    </div>
                    <div class="card-body">
                        <div id="alert-block">
                        </div>
                        <form action="{{ route('add-user') }}" id="form-add-user">
                            @csrf
                            {{-- name --}}
                            <div class="form-group row">
                                <label for="user-name" class="col-md-2 col-form-label form-control-label">User name</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="name" type="text" placeholder="user name"
                                        id="user-name">
                                    <p class="p-error text-danger" id="error-name"></p>
                                </div>
                            </div>
                            {{-- email --}}
                            <div class="form-group row">
                                <label for="user-email" class="col-md-2 col-form-label form-control-label">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="email" name="email" placeholder="ae@example.com"
                                        id="user-email">
                                    <p class="p-error text-danger" id="error-email"></p>
                                </div>
                            </div>
                            {{-- role --}}
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label form-control-label" for="user-role">Example
                                    select</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="user-role" name="role">
                                        @if (Auth::user()->user_role === 'superAdmin')
                                        <option value="superAdmin">Super Admin</option>
                                        @endif
                                        <option value="admin" selected>Admin</option>
                                    </select>
                                    <p class="p-error text-danger" id="error-role"></p>
                                </div>
                            </div>
                            {{-- password --}}
                            <div class="form-group row">
                                <label for="user-password"
                                    class="col-md-2 col-form-label form-control-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="password" name="password" id="user-password"
                                        autocomplete="new-password">
                                    <p class="p-error text-danger" id="error-password"></p>
                                </div>
                            </div>
                            {{-- password comfirm --}}
                            <div class="form-group row">
                                <label for="user-password-confirmation"
                                    class="col-md-2 col-form-label form-control-label">Password Confirm</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="user-password-confirmation">
                                </div>
                            </div>

                            <button class="btn btn-warning float-right">Add user</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ url('/') }}/js/admin/usersManage.js"></script>
@endpush
