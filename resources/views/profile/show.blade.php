@extends('layouts.app')

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
                                        <span class="heading">{{Auth::user()->count_post}}</span>
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
                                My Role: {{ Auth::user()->user_role }}
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
                                            <p class="p-error text-danger" id="error-name"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email address</label>
                                            <input type="email" id="email" class="form-control" required
                                                value="{{ Auth::user()->email }}" placeholder="email@example.com">
                                            <p class="p-error text-danger" id="error-email"></p>

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
                                            <p class="p-error text-danger" id="error-current-password"></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password">New Password</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                required>
                                            <p class="p-error text-danger" id="error-password"></p>
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
                                            <p class="p-error text-danger" id="error-password-confirmation"></p>
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
                            <div class="modal fade" id="logoutSessionModal" role="dialog">
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
                                                    <p id="error-logout-session" class="p-error text-danger"></p>
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
                            <!-- {{ var_dump($sessions) }} -->
                            @if (count($sessions) > 0)
                                <div class="space-y-6">
                                    <!-- Other Browser Sessions -->
                                    @foreach ($sessions as $session)
                                        @if ($session->is_current_device)
                                            <div class="row items-center">
                                            @else
                                                <div class="row items-center not-current-device">
                                        @endif
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
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" class="w-8 h-8 text-gray-500"
                                                    style="width:24px;">

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
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#deleteAccount">Delete Account</button>

                            {{-- Modal Delete Account --}}
                            <div id="deleteAccount" class="modal fade" role="dialog" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('delete-account') }}" id="form-delete-account">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Account</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="passwordDeleteAccount" class="col-form-label"
                                                        style="float: left;">Password:</label>
                                                    <input type="password" class="form-control"
                                                        name="passwordDeleteAccount" id="passwordDeleteAccount" required>
                                                    <p id="error-delete-account" class="p-error text-danger"
                                                        style="float: left;"></p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- End Modal Delete Account --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
@push('js')
    <script src="{{ url('/') }}/js/admin/profile.js"></script>
@endpush
