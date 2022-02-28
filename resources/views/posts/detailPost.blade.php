<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Admin</title>
    <link href="{{ url('/') }}/img/logo/TF.png" rel="icon" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/css/admin.css" type="text/css">
    <script src="{{ url('/') }}/js/app.js" defer></script>
</head>

<body>{{-- Sidenav --}}
    <nav class="sidenav navbar navbar-vertical fixed-right navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scroll-wrapper scrollbar-inner" style="position: relative;"><div class="scrollbar-inner scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 317.642px;">

            <div class=" d-flex justify-content-center">
                <div>
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block active" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
                <div class="navbar-brand" style="padding: none;">
                    <button class="btn btn-success">Pushlist</button>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <!-- Dashboards -->
                        <li class="nav-item">
                            <a class="nav-link active" href="http://127.0.0.1:8000/dashboard" id="dashboards" aria-expanded="true">
                                <i class="fa fa-home text-primary"></i>
                                <span class="nav-link-text">Dashboards</span>
                            </a>
                        </li>

                        <!-- Posts -->
                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-posts" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-posts" id="posts">
                                <i class="fa fa-paper-plane text-orange"></i>
                                <span class="nav-link-text">Posts</span>
                            </a>
                            <div class="collapse" id="navbar-posts">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item" id="all-post">
                                        <a href="#" class="nav-link">All Posts</a>
                                    </li>
                                    <li class="nav-item" id="all-new-post">
                                        <a href="http://127.0.0.1:8000/posts/new-post" class="nav-link">Add New Posts</a>
                                    </li>
                                    <li class="nav-item" id="categories">
                                        <a href="http://127.0.0.1:8000/posts/categories" class="nav-link">Categories</a>
                                    </li>
                                    <li class="nav-item" id="tags">
                                        <a href="http://127.0.0.1:8000/posts/tags" class="nav-link">Tags</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-users" data-toggle="collapse" role="button" id="users" aria-expanded="false" aria-controls="navbar-users">
                                <i class="fa fa-users text-info"></i>
                                <span class="nav-link-text">Users</span>
                            </a>
                            <div class="collapse" id="navbar-users">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item" id="all-user">
                                        <a href="http://127.0.0.1:8000/user/all" class="nav-link">All User</a>
                                    </li>
                                    <li class="nav-item" id="add-new-user">
                                        <a href="http://127.0.0.1:8000/user/new-user" class="nav-link">Add New User</a>
                                    </li>
                                    <li class="nav-item" id="request">
                                        <a href="http://127.0.0.1:8000/user/request" class="nav-link">Request</a>
                                    </li>
                                    <li class="nav-item" id="profile">
                                        <a href="http://127.0.0.1:8000/user/profile" class="nav-link">Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="media">
                                <i class="fa fa-cube text-green"></i>
                                <span class="nav-link-text">Media</span>
                            </a>
                        </li>
                    </ul>
                    <hr class="my-3">
                                                                                <input type="text" id="slidebar-0" value="dashboards" hidden="">
                                                                            </div>
            </div>
        </div><div class="scroll-element scroll-x scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="width: 0px;"></div></div></div><div class="scroll-element scroll-y scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="height: 281px; top: 0px;"></div></div></div></div>
    </nav>
    <div class="main-content overflow-hiden" id="panel">
        <div class="header pb-6 bg-primary">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0"><a
                                    href="{{ route('dashboard') }}">{{ config('app.name') }}</a></h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-paper-plane"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Posts</a></li>
                                    <li class="breadcrumb-item"><a href="#"> {{ $status }} </a></li>
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
                {{-- Custom Detail Post --}}
                <div class="col-xl-3 order-xl-2">
                    <div class="card">
                        <div class="card-header" style="padding: 1.2rem">
                            <h3 class="mb-0">Post Detail </h3>
                        </div>

                        <div class="card-body" style="padding: 0;">
                            {{-- <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <button class="btn btn-link w-100 text-left">
                                            Status & Visibility
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body" style="padding: 0.5rem 1.5rem;">
                                        <div class="text-sm ">
                                            <div class="w-100">
                                                <label for="visibility" class="col-form-label">Visibility: </label>
                                                <select name="" id="" class="btn btn-sm" style="box-shadow: none;">
                                                    <option value="">Drafts</option>
                                                    <option value="">Public</option>
                                                </select>
                                            </div>
                                            <div class="w-100">
                                                <label for="" class="col-form-label">Create Time: </label>
                                                <span>22-2-2222 15:15:15</span>
                                            </div>
                                            <button class="btn btn-danger btn-sm"> Move to trash</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="accordion">

                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0 collapsed " data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <button class="btn btn-link w-100 text-left">
                                                URL Link
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordion">
                                        <div class="card-body text-sm">
                                            <label for="slugPost">Slug Post</label>
                                            <input type="text" class="form-control form-control-sm" id="slugPost"
                                                aria-describedby="slug Post" placeholder="Enter slug" required>
                                            <small id="urlPost" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            <button class="btn btn-link ">
                                                Categories
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <select class="form-control selectCateParent" id="selectCateParent"
                                                name="selectCateParent">
                                                <option value="0">None</option>
                                            </select>
                                            <input type="text" id="slugCategory" value="" hidden>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="heading4">
                                        <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse4"
                                            aria-expanded="false" aria-controls="collapse4">
                                            <button class="btn btn-link ">
                                                Tag
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapse4" class="collapse" aria-labelledby="heading4"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>

                {{-- Tags List --}}
                <div class="col-xl-9 order-xl-1 scroll h-100">
                    <!-- Table -->
                    <div class="card ">
                        <!-- Card header -->
                        <div class="card-header">
                            <textarea name="" id="inputTitlePost" cols="30" rows="1"
                                class="form-control border-0 shadow-none font-weight-bold "
                                placeholder="Title"></textarea>
                        </div>
                        <div class="table-responsive py-4">
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <style>
        .card {
            margin: 0;
        }

        .card-header {
            padding: 0;
        }

        #inputTitlePost {
            font-size: 20px;
        }
        textarea{
            resize: none;
        }

    </style>
    <script src="{{ url('/') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ url('/') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ url('/') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="{{ url('/') }}/js/argon.js?v=1.1.0"></script>
    <script src="{{ url('/') }}/js/demo.min.js"></script>
    <script src="{{ url('/') }}/js/admin/categoriesManage.js"></script>
    <script src="{{ url('/') }}/js/admin/detailPost.js"></script>

    <script>

    </script>
</body>

</html>
