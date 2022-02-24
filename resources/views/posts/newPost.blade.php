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

<body>
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
                            <div class="card">
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
                                {{-- URL Link --}}
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
                            </div>
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

    </style>
    <script src="{{ url('/') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ url('/') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ url('/') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    {{-- <script src="{{ url('/') }}/js/argon.js?v=1.1.0"></script> --}}
    {{-- <script src="{{ url('/') }}/js/demo.min.js"></script> --}}
    <script src="{{ url('/') }}/js/admin/categoriesManage.js"></script>
    <script src="{{ url('/') }}/js/admin/detailPost.js"></script>

    <script>

    </script>
</body>

</html>
