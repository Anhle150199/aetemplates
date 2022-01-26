@extends('layouts.app1')

@section('content')
    <!-- Header -->
    <!-- Header -->
    <div class="header pb-6 bg-primary">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{ config('app.name') }}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Users</a></li>
                                <li class="breadcrumb-item"><a href="#"> Profile </a></li>
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
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <img src="{{ url('/') }}/img/theme/img-1-1000x600.jpg" alt="Image placeholder"
                        class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ url('/') }}/img/avatar/{{ Auth::user()->profile_photo_path }}"
                                        class="rounded-circle" id="avatar">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            {{-- <a href="#" class="btn btn-sm btn-info mr-4"></a> --}}
                            <button class="btn btn-sm btn-default float-right" style="margin: auto;margin-top: 20px;"
                                id="btn-upload-avatar">Upload avatar</button>
                            <input type="file" hidden id="input-avatar" accept="image/*">
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
                            <h5 class="h3" id="name-user">
                                {{ Auth::user()->name }}
                            </h5>
                            <div class="h5 font-weight-300">
                                {{ Auth::user()->user_role }}
                            </div>
                            {{-- <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>University of Computer Science
                            </div> --}}
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
                                                value="{{ Auth::user()->name }}" required>
                                            <p class="text-danger" id="error-name"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email address</label>
                                            <input type="email" id="email" class="form-control" required
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
                                            <input type="password" id="current_password" class="form-control" required>
                                            <p class="text-danger" id="error-current-password"></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password">New Password</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                required>
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
                                                required name="password_confirmation">
                                            <p class="text-danger" id="error-password-confirmation"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                {{-- Manage Session --}}
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Browser Sessions </h3>
                            </div>
                            {{-- button Logout Sessions --}}
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#logoutSessionModal">
                                    Log Out Other Browser Sessions </button>
                            </div>

                            {{-- Modal Logout Session --}}
                            <div class="modal fade" id="logoutSessionModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <form action="{{ route('logout-other-seesion') }}" id="form-logout-session">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Log Out Other Browser
                                                    Sessions
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="passwordLogoutSession"
                                                        class="col-form-label">Password:</label>
                                                    <input type="password" class="form-control"
                                                        name="passwordLogoutSession" id="passwordLogoutSession" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-warning"
                                                    id="btn-logout-orther-session">Log Out Other Browser Sessions</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- End Modal Logout Session --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="pl-lg-4">
                            <p class="text-success" id="info-success"></p>
                            {{var_dump($sessions)}}
                            @if (count($sessions) > 0)
                                <div class="space-y-6">
                                    <!-- Other Browser Sessions -->
                                    @foreach ($sessions as $session)
                                        <div class="row items-center">
                                            <div>
                                                @if ($session->agent['is_desktop'])
                                                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"
                                                        class="w-8 h-8 text-gray-500" style="width:2rem;">
                                                        <path
                                                            d=" M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2
                                                                                        0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-8 h-8 text-gray-500" style="width:24px;">

                                                        <path d="M0 0h24v24H0z" stroke="none"></path>
                                                        <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                                                        <path d="M11 5h2M12 17v.01"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm text-gray-600">
                                                    {{ $session->agent['platform'] ? $session->agent['platform'] : 'Unknown' }}
                                                    -
                                                    {{ $session->agent['browser'] ? $session->agent['browser'] : 'Unknown' }}
                                                </div>

                                                <div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $session->ip_address }},

                                                        @if ($session->is_current_device)
                                                            <span
                                                                class="text-success font-semibold">{{ __('This device') }}</span>
                                                        @else
                                                            {{ __('Last active') }} {{ $session->last_active }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                {{-- Delete Account --}}
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Delete Account </h3>
                            </div>
                            <div class="col-4 text-right">
                                <button type="submit" class="btn btn-sm btn-danger">Delete Account</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        p {
            font-size: 12px;
            font-weight: 600;
        }

    </style>
    <script>
        // Update info user
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
                    $('#name-user-topnav').text(data.name);
                    $('#name-user').text(data.name);
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

        // Update password
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
                    $('#password-success').text("");
                    if (errors.current_password) {
                        $('#error-current-password').text(errors.current_password);
                    }
                    if (errors.password) {
                        $('#error-password').text(errors.password);
                    }
                    if (errors.password_confirmation) {
                        $('#error-password-confirmation').text(errors.password_confirmation);
                    }
                    setTimeout(function() {
                        $('#error-current-password').text("");
                        $('#error-password').text("");
                        $('#error-password-confirmation').text("");
                    }, 5000);
                    console.log(errors);
                }
            });
            return false;
        });

        // upload avatar
        $('#btn-upload-avatar').click(function() {
            $('#input-avatar').click();
        });
        $('#input-avatar').change(() => {
            let match = ["image/gif", "image/png", "image/jpg", "image/jpeg"];
            let file_data = $('#input-avatar').prop('files')[0];

            if (!match.includes(file_data.type)) {
                $("#photo").val("");
                alert("Error: File isn't image!!!");
                return
            }

            let file = $("#input-avatar")[0].files;
            sentFileMedia(file);
        })
        // sent image with ajax
        const sentFileMedia = (file) => {
            let fd = new FormData();

            if (file.length > 0) {
                fd.append('file', file[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let request = $.ajax({
                    url: '/user/update-avatar',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                });
                request.done(function(msg) {
                    domain = window.location.origin;
                    $('#avatar').attr("src", domain + msg.image)
                    $('#avatar-topvar').attr("src", domain + msg.image)
                    alert(msg.msg);
                });

                request.fail(function(request, status, error) {
                    alert(request.responseText.errors.file);
                });
            } else {
                alert("Please select a file.");
            }
        }

        $('#form-logout-session').on('submit', function(e) {
            e.preventDefault();
            const password = $('#passwordLogoutSession').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let request = $.ajax({
                url: $('#form-logout-session').attr('action'),
                type: 'delete',
                data: {password: password},
                contentType: 'json',
                processData: false,
            });
            request.done(function(msg) {
                console.log(msg);
            });

            request.fail(function(request, status, error) {
                console.log(request.responseText);
            });
        })
    </script>
@endsection
