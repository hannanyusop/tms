<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="SirHannan">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}">
    <title>@yield('title') | {{ appName() }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}?ver=1.4.0">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css') }}?ver=1.4.0">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
        <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
            <div class="nk-sidebar-element nk-sidebar-head">
                <div class="nk-sidebar-brand">
                    <a href="{{ route('frontend.user.dashboard') }}" class="logo-link nk-sidebar-logo">
                        <img class="logo-light logo-img" src="{{ asset('assets/image/logo.png') }}" srcset="{{ asset('assets/image/logo.png') }} 2x" alt="logo">
                        <img class="logo-dark logo-img" src="{{ asset('assets/image/logo.png') }}" srcset="{{ asset('assets/image/logo.png') }} 2x" alt="logo-dark">
                    </a>
                </div>
                <div class="nk-menu-trigger mr-n2">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div><!-- .nk-sidebar-element -->
            <div class="nk-sidebar-element">
                <div class="nk-sidebar-content">
                    <div class="nk-sidebar-menu" data-simplebar>
                        <ul class="nk-menu">
                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Applications</h6>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('frontend.user.dashboard') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                    <span class="nk-menu-text">Dashboard</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-truck"></em></span>
                                    <span class="nk-menu-text">Lorry Management</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{ route('frontend.user.lorry.index') }}" class="nk-menu-link"><span class="nk-menu-text">List</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('frontend.user.lorry.create') }}" class="nk-menu-link"><span class="nk-menu-text">Register Lorry</span></a>
                                    </li>
                                </ul><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                        </ul><!-- .nk-menu -->
                    </div><!-- .nk-sidebar-menu -->
                </div><!-- .nk-sidebar-content -->
            </div><!-- .nk-sidebar-element -->
        </div>
        <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ml-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand d-xl-none">
                            <a href="#" class="logo-link">
                                <img class="logo-light logo-img" src="{{ asset('assets/image/logo.png') }}" srcset="{{ asset('assets/image/logo.png') }} 2x" alt="logo">
                                <img class="logo-dark logo-img" src="{{ asset('assets/image/logo.png') }}" srcset="{{ asset('assets/image/logo.png') }} 2x" alt="logo-dark">
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-news d-none d-xl-block">
                        </div><!-- .nk-header-news -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                            <div class="user-info d-none d-md-block">
                                                <div class="user-status">{{ auth()->user()->email }}</div>
                                                <div class="user-name dropdown-indicator">{{ auth()->user()->name }}</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span>AB</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ auth()->user()->name }}</span>
                                                    <span class="sub-text">{{ auth()->user()->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="#"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="{{ route('frontend.auth.logout') }}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .dropdown -->
                            </ul><!-- .nk-quick-nav -->
                        </div><!-- .nk-header-tools -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">@yield('title')</h3>

                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                            @include('includes.partials.messages')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
            <!-- footer @s -->
            <div class="nk-footer">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> All rights reserved. © 2020 Tang Eng-Le Logistics (M) Sdn. Bhd.</div>
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
@stack('before-scripts')
<script src="{{ asset('assets/js/bundle.js') }}?ver=1.4.0"></script>
<script src="{{ asset('assets/js/scripts.js') }}?ver=1.4.0"></script>
<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

<script type="text/javascript">

    "use strict";
    (function($) {
        "use strict";
//Minimum and Maxium Date
        $('#minMaxExample').datepicker({
            language: 'en',
            minDate: new Date() // Now can select only dates, which goes after today
        })

//Disable Days of week
        var disabledDays = [0, 6];

        $('#disabled-days').datepicker({
            language: 'en',
            onRenderCell: function (date, cellType) {
                if (cellType == 'day') {
                    var day = date.getDay(),
                        isDisabled = disabledDays.indexOf(day) != -1;
                    return {
                        disabled: isDisabled
                    }
                }
            }).then(function(e) {
                e.dismiss === Swal.DismissReason.timer && console.log("I was closed by the timer")
            }), e.preventDefault()
        }), e(".eg-swal-av6").on("click", function(e) {
            Swal.fire({
                title: "Submit your Github username",
                input: "text",
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: !0,
                confirmButtonText: "Look up",
                showLoaderOnConfirm: !0,
                preConfirm: function(e) {
                    return fetch("//api.github.com/users/".concat(e)).then(function(e) {
                        if (!e.ok) throw new Error(e.statusText);
                        return e.json()
                    }).catch(function(e) {
                        Swal.showValidationMessage("Request failed: ".concat(e))
                    })
                },
                allowOutsideClick: function() {
                    return !Swal.isLoading()
                }
            }).then(function(e) {
                e.value && Swal.fire({
                    title: "".concat(e.value.login, "'s avatar"),
                    imageUrl: e.value.avatar_url,
                    imageWidth: "120px"
                })
            }), e.preventDefault()
        })
    }((NioApp, jQuery));


    $(".delete").click(function (){

        let data_url = $(this).data('url');
        let  message = $(this).data('message');

        swal.fire({
            // title: "Are you sure?",
            text: message,
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: 0,
        }).then((e) => {
            if (e) {
                $.ajax({
                    type: 'GET',
                    url: data_url,
                    success: function (results) {

                        if (results.success === true) {
                            swal.fire("Done!", results.message, "success");
                            location.reload();
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    }
                });
            } else {
                swal.fire("Your imaginary file is safe!");
            }
        }),e.preventDefault()
    });


</script>
@stack('after-scripts')
</body>

</html>
