
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ appName() }}</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
{{--    <link rel="stylesheet" type="text/css" id="color" href="{{ asset('assets/css/light-1.css') }}" media="screen">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">  </head>
<body main-theme-layout="main-theme-layout-1">
    <div class="loader-wrapper">
      <div class="loader bg-white">
        <div class="whirly-loader"> </div>
      </div>
    </div>
    <div class="page-wrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row">
                <div class="main-header-left d-lg-none">
                    <div class="logo-wrapper"><a href="#"><img src="{{ asset('assets/images/endless-logo.png') }}" alt=""></a></div>
                </div>
                <div class="mobile-sidebar">
                    <div class="media-body text-right switch-sm">
                        <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
                    </div>
                </div>
                <div class="nav-right col p-0">
                    <ul class="nav-menus">
                        <li></li>
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                        <li class="onhover-dropdown"><i data-feather="bell"></i>
                            <ul class="notification-dropdown onhover-show-div">
                                <li>Notification <span class="badge badge-pill badge-primary pull-right">0</span></li>
                                <li class="bg-light txt-dark"><a href="#">All</a> notification</li>
                            </ul>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle" src="{{ asset('img/avatar.png') }}" alt="header-user">
                                <div class="dotted-animation"></div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div p-20">
                                <li><a href="#"><i data-feather="user"></i>Edit Profile</a></li>
                                <li><a href="#"><i data-feather="settings"></i>Settings</a></li>
                                <li><a href="#"><i data-feather="lock"></i>Lock Screen</a></li>
                                <li><a href="{{ route('frontend.auth.logout') }}"><i data-feather="log-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
                </div>
            </div>
        </div>
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="page-sidebar">
                <div class="main-header-left d-none d-lg-block">
                    <div class="logo-wrapper">
                        <img src="{{ asset('assets/images/endless-logo.png') }}" alt="">
                    </div>
                </div>
                <div class="sidebar custom-scrollbar">
                    <div class="sidebar-user text-center">
                        <div><img class="img-60 rounded-circle" src="{{ asset('assets/images/user/1.jpg') }}" alt="#">
                            <div class="profile-edit"><a href="#" target="_blank"><i data-feather="edit"></i></a></div>
                        </div>
                        <h6 class="mt-3 f-14">{{ auth()->user()->name }}</h6>
                    </div>
                    <ul class="sidebar-menu">

                        <li><a class="sidebar-header" href="{{ route('frontend.user.dashboard') }}"><i data-feather="home"></i><span> {{ __('Dashboard') }}</span></a></li>
                        <li><a class="sidebar-header" href="{{ route('frontend.user.lorry.index') }}"><i data-feather="truck"></i><span> {{ __('Lorry') }}</span></a></li>
                        <li class="">
                            <a class="sidebar-header" href="#"><i data-feather="settings"></i><span>{{ __('System Setup') }}</span><i class="fa fa-angle-right pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li><a href="#" class=""><i class="fa fa-circle"></i>Notification</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page Sidebar Ends-->

            <div class="page-body">
                <!-- breadcrumb  Start -->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <div class="page-header-left">
                                    <h3>@yield('title')</h3>

                                </div>
                            </div>
                            <!-- Bookmark Start-->
                            <div class="col">
                                <div class="bookmark pull-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('frontend.user.dashboard') }}"><i data-feather="home"></i></a></li>
                                        @if(isset($links))
                                            @foreach($links as $url => $link)
                                                <li class="breadcrumb-item {{ ($link != ' ')? "active" : "" }}"><a href="{{ $link }}">{{ $url }}</a></li>
                                            @endforeach
                                        @endif
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    </ol>
                                </div>
                            </div>
                            <!-- Bookmark Ends-->
                        </div>
                    </div>
                </div>
                <!-- End Breadcrumb -->
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    @include('includes.partials.messages')
                    @yield('content')
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2019 © All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>

<script src="{{ asset('assets/js/chat-menu.js') }}"></script>
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>

<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>
{{--<script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script>--}}

</html>
