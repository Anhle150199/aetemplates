    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand ml-auto" href="{{route('home')}}">
                    <img src="{{url('/')}}/img/logo/TF.png" class="navbar-brand-img" alt="...">
                </a>
                <div>
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('dashboard')}}"  >
                                <i class="fa fa-home text-primary"></i>
                                <span class="nav-link-text">Dashboards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-posts" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-posts">
                                <i class="fa fa-paper-plane text-orange"></i>
                                <span class="nav-link-text">Posts</span>
                            </a>
                            <div class="collapse" id="navbar-posts">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">All Posts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Add New Posts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Tags</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        {{-- Users --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-users" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-users">
                                <i class="fa fa-users text-info"></i>
                                <span class="nav-link-text">Users</span>
                            </a>
                            <div class="collapse" id="navbar-users">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">All User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Add New User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('profile.show')}}" class="nav-link">Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-cube text-green"></i>
                                <span class="nav-link-text">Media</span>
                            </a>
                        </li>
                    </ul>
                    <hr class="my-3">
                </div>
            </div>
        </div>
    </nav>
