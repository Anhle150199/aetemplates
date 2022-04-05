<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $system['app_name'] }} </title>
    <link href="{{ url('/') }}/img/logo/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Barlow:300,600,700,900|Roboto:100,300,500,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ url('/') }}/css/website/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        type="text/css">

    <link rel="stylesheet" href="{{ url('/') }}/css/website/slicknav.css">

    <link rel="stylesheet" href="{{ url('/') }}/css/website/slick.css">
    @stack('css')
    <link rel="stylesheet" href="{{ url('/') }}/css/website/style.css">

    <style>
        .string-2 {
            overflow: hidden;
            line-height: 25px;
            -webkit-line-clamp: 2;
            height: 55px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }

        .btn {
            padding: 21px;
        }

        input::-webkit-input-placeholder {
            font-size: 12px;
            line-height: 3;
        }

    </style>
</head>

<body>

    <main>
        @include('layouts.navbars.header')
        @yield('content')

    </main>
    <footer>
        <div class="footer-main footer-bg">
            <div class="footer-bottom-area footer-bg">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    <p>
                                        Copyright &copy;
                                        <script>
                                            document.write(new Date().getFullYear());
                                        </script> All rights reserved | This template is customized by
                                        {{ $system['app_name'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ url('/') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ url('/') }}/js/website/jquery.slicknav.min.js"></script>
    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ url('/') }}/js/website/slick.min.js"></script>
    <!-- Scrollup, nice-select, sticky -->
    <script src="{{ url('/') }}/js/website/jquery.scrollUp.min.js"></script>
    <script src="{{ url('/') }}/js/website/jquery.ajaxchimp.min.js"></script>
    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ url('/') }}/js/website/main.js"></script>

</body>

</html>
