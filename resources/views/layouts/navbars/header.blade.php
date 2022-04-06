<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            @if (Auth::check())
                <div class="header-top black-bg d-none d-sm-block">
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li class="title">
                                            <a href="{{ route('dashboard') }}">
                                                <i class="fa fa-home text-danger"></i> Dashboard
                                            </a>
                                        </li>
                                        <li><a href="{{ route('new-post') }}">New Post</a></li>
                                        @isset($postId)
                                            <li><a href="{{ route('edit-post', ['id' => $postId]) }}">Edit Post</a>
                                            </li>
                                        @endisset

                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-date">
                                        <li class="border-right mr-1 pr-2"><i class="fa fa-user text-danger"></i><a
                                                href="{{ route('profile.show') }}"> {{ Auth::user()->name }}</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="" style="background: none;outline: none;box-shadow: none;border: 0;cursor: pointer;"><i class="fas fa-sign-out-alt"></i>
                                                    Logout</button>
                                                </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="header-mid gray-bg">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-3 col-lg-3 col-md-3 d-none d-md-block">
                            <div class="logo">
                                <a href="{{ route('home') }}"><img src="{{ url('/') . Cache::get('systemDetail')['logo'] }}"
                                        alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <div class="header-banner f-right ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-8 col-lg-8 col-md-12 header-flex">
                            <div class="sticky-logo info-open">
                                <a href="{{ route('home') }}"><img src="{{ url('/') . Cache::get('systemDetail')['logo'] }}"
                                        alt=""></a>
                            </div>
                            <?php echo Cache::get('systemDetail')['menu_html']; ?>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="header-right f-right d-none d-lg-block">
                                <ul class="header-social" style="cursor: pointer;padding: 0;">
                                    <li>
                                        <form action="{{ route('search-post') }}" method="get">
                                            <div class="input-group ">
                                                <input type="text" class="form-control" placeholder="Search Keyword"
                                                    name="search"
                                                    style="margin-left: 15px;border-radius: 0;box-shadow: none;outline: none;border: 0;">
                                                <button class="btn" type="submit"
                                                    style="margin-right: 10px;margin-left: 10px;padding: 0px 10px 0px 10px;"><i
                                                        class="fa fa-search text-white"
                                                        style="font-size: 20px; "></i></button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-md-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
