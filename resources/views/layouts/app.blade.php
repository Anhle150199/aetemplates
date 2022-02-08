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
    @stack('css')
</head>

<body>
    @include('layouts.navbars.sidebar')

    <div class="main-content" id="panel">
        @include('layouts.navbars.topnav')
        @yield('content')
    </div>

    <script src="{{ url('/') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ url('/') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ url('/') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    @stack('js')
    <script src="{{ url('/') }}/js/argon.js?v=1.1.0"></script>
    <script src="{{ url('/') }}/js/demo.min.js"></script>
    <script>
        for (let index = 0; index < 4; index++) {
            let idElement = $('#slidebar-' + index).val();
            if (idElement == "") break;
            $(`#${idElement}`).addClass("active");
            if (index == 0) {
                $(`#${idElement}`).click();
                $(`#${idElement}`).attr("aria-expanded", "true");
            }
        }
    </script>

</body>

</html>
