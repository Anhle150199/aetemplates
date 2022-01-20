@extends('layouts.app1')

@section('content')
    <!-- Header -->
    <!-- Header -->
    <div class="header pb-6 bg-primary" style="min-height: 150px; ">

    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <img src="{{ url('/') }}/img/theme/img-1-1000x600.jpg" alt="Image placeholder"
                        class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ url('/') }}/img/avatar/{{ Auth::user()->profile_photo_path }}"
                                        class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            {{-- <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                            <a href="#" class="btn btn-sm btn-default float-right">Message</a> --}}
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">Posts</span>
                                    </div>
                                    {{-- <div>
                                        <span class="heading">10</span>
                                        <span class="description">Photos</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">Comments</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="h3">
                                {{ Auth::user()->name }}
                            </h5>
                            <div class="h5 font-weight-300">
                                {{ Auth::user()->user_role }}
                            </div>
                            <!-- <div class="h5 mt-4">
                                                                                                    <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                                                                                                </div>
                                                                                                <div>
                                                                                                    <i class="ni education_hat mr-2"></i>University of Computer Science
                                                                                                </div> -->
                        </div>
                    </div>
                </div>
                <!-- Progress track -->
                {{-- <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">Progress track</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- List group -->
                        <ul class="list-group list-group-flush list my--3">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <img alt="Image placeholder" src="../../assets/img/theme/bootstrap.jpg">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Argon Design System</h5>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="60"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <img alt="Image placeholder" src="../../assets/img/theme/angular.jpg">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Angular Now UI Kit PRO</h5>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <img alt="Image placeholder" src="../../assets/img/theme/sketch.jpg">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Black Dashboard</h5>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-red" role="progressbar" aria-valuenow="72"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <img alt="Image placeholder" src="../../assets/img/theme/react.jpg">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>React Material Dashboard</h5>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="90"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <img alt="Image placeholder" src="../../assets/img/theme/vue.jpg">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Vue Paper UI Kit PRO</h5>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>
            <div class="col-xl-8 order-xl-1">
                {{-- Update User Name & Email --}}
                <div class="card">
                    <form id="updateInfo" action="{{ route('update-profile') }}">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Edit profile </h3>
                                </div>
                                <div class="col-4 text-right">
                                    <button type="submit" class="btn btn-sm btn-warning">Save</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="pl-lg-4">
                                <p class="text-success" id="info-success"></p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">Username</label>
                                            <input type="text" id="name" class="form-control" placeholder="Username"
                                                value="{{ Auth::user()->name }}">
                                            <p class="text-danger" id="error-name"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email address</label>
                                            <input type="email" id="email" class="form-control"
                                                value="{{ Auth::user()->email }}" placeholder="email@example.com">
                                            <p class="text-danger" id="error-email"></p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                {{-- Update Password --}}
                <div class="card">
                    <form action="{{ route('update-password') }}" id="updatePassword">
                        @csrf
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Update Password </h3>
                                </div>
                                <div class="col-4 text-right">
                                    <button type="submit" class="btn btn-sm btn-warning">Save</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <p class="text-success" id="password-success"></p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="current_password">Current
                                                Password</label>
                                            <input type="password" id="current_password" class="form-control">
                                            <p class="text-danger" id="error-current-password"></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password">New Password</label>
                                            <input type="password" id="password" name="password" class="form-control">
                                            <p class="text-danger" id="error-password"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password_confirmation">Confirm
                                                Password</label>
                                            <input type="password" id="password_confirmation" class="form-control"
                                                name="password_confirmation">
                                            <x-jet-input-error for="password_confirmation" class="mt-2" />
                                            <p class="text-danger" id="error-password-confirmation"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#updateInfo').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let data = {
                name: $('#name').val(),
                email: $('#email').val(),
            }
            let url = $('#updateInfo').attr('action');

            $.ajax({
                type: 'post',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('#info-success').text(data.msg);
                    $('#error-name').text("");
                    $('#error-email').text("");

                    setTimeout(function() {
                        $('#info-success').text("");
                    }, 5000);
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    if (errors.name) {
                        $('#error-name').text(errors.name);
                    }
                    if (errors.email) {
                        $('#error-email').text(errors.email);
                    }
                    setTimeout(function() {
                        $('#error-name').text("");
                        $('#error-email').text("");
                    }, 5000);
                }
            });

            return false;
        });

        $('#updatePassword').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let data = {
                current_password: $('#current_password').val(),
                password: $('#password').val(),
                password_confirmation: $('#password_confirmation').val(),
                _token: $("input[name=_token]").val()
            }
            let url = $('#updatePassword').attr('action');

            $.ajax({
                type: 'post',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('#password-success').text(data.msg);
                    setTimeout(function() {
                        $('#password-success').text("");
                    }, 5000);
                },
                error: function(data) {
                    console.log(data);
                    let errors = data.responseJSON.errors;
                    // $('#password-success').text("");
                    // if (errors.current_password) {
                    //     $('#error-current-password').text(errors.current - password);
                    // }
                    // if (errors.password) {
                    //     $('#error-password').text(errors.password);
                    // }
                    // if (errors.password_confirmation) {
                    //     $('#error-password-confirmation').text(errors.password - confirmation);
                    // }
                    // setTimeout(function() {
                    //     $('#error-current-password').text("");
                    //     $('#error-password').text("");
                    //     $('#error-password-confirmation').text("");
                    // }, 5000);
                    console.log(errors);
                }
            });
            return false;
        });

        function emptyText(e) {
            e.text("xxx");
        }
    </script>
@endsection