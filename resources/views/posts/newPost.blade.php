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
                                    <li class="breadcrumb-item"><a href="#"> New Post </a></li>
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
                    <div class="card card-profile">
                                    <div class="accordion" id="accordionExample">
                                        {{-- <div class="card"> --}}
                                          <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Collapsible Group Item #1
                                              </button>
                                            </h5>
                                          </div>

                                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            {{-- <div class="card-body"> --}}
                                                Collapsible Group Item #1

                                            {{-- </div> --}}
                                          </div>
                                        {{-- </div> --}}
                                        <div class="card">
                                          <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Collapsible Group Item #2
                                              </button>
                                            </h5>
                                          </div>
                                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                          </div>
                                        </div>
                                        <div class="card">
                                          <div class="card-header" id="headingThree">
                                            <h5 class="mb-0">
                                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Collapsible Group Item #3
                                              </button>
                                            </h5>
                                          </div>
                                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                        </form>
                        {{-- End Form --}}
                    </div>
                </div>

                {{-- Tags List --}}
                <div class="col-xl-9 order-xl-1 scroll h-100">
                    <!-- Table -->
                    <div class="card ">
                        <!-- Card header -->
                        <div class="card-header">
                                <input type="text" class="form-control border-top-0 border-right-0 border-left-0 shadow-none" id="inputTitle"
                                placeholder="Title" required>
                        </div>
                        <div class="table-responsive py-4">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- </div> --}}

    </div>

    <script src="{{ url('/') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ url('/') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ url('/') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="{{ url('/') }}/js/argon.js?v=1.1.0"></script>
    <script src="{{ url('/') }}/js/demo.min.js"></script>
</body>

</html>
