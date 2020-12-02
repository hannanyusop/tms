
<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ appName() }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}?ver=1.4.0">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css') }}?ver=1.4.0">
</head>
<style>
    .bc{

        /*filter: blur(8px);*/
        /*-webkit-filter: blur(8px);*/

        /* Full height */
        /*height: 100%;*/

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        /*background-size: cover;*/

        background-size: 100% 100%;
        background-image: url('{{ asset('img/login.jpg') }}')
    }

    .bg-text {
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(110, 107, 107, 0.4); /* Black w/opacity/see-through */
        color: white;
        font-weight: bold;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        width: 80%;
        padding: 20px;
        text-align: center;
    }
</style>

<body class="nk-body npc-crypto ui-clean pg-auth">
<!-- app body @s -->
<div class="nk-app-root">
    <div class="nk-split nk-split-page nk-split-md">
        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container">
            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
            </div>
            <div class="nk-block nk-block-middle nk-auth-body">
                <div class="brand-logo pb-5">
                    <h4 class="logo-link">Tang Eng-Le Logistics (M) Sdn. Bhd</h4>
{{--                    <a href="#" class="logo-link">--}}
{{--                        <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/image/logo.png') }}" alt="logo">--}}
{{--                        <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/image/logo.png') }}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">--}}
{{--                    </a>--}}
                </div>
                @include('includes.partials.messages')
                @yield('content')

            </div><!-- .nk-block -->
        </div><!-- .nk-split-content -->
        <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right bc" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
            <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto text-center text-white" >
                <div class="bg-text">
                    <h3>Tang Eng-Le Logistics (M) Sdn. Bhd</h3>
                    <h6>We Care Delivery!</h6>
                </div>
            </div><!-- .slider-wrap -->
        </div><!-- .nk-split-content -->
    </div><!-- .nk-split -->
</div><!-- app body @e -->
<!-- JavaScript -->
<script src="{{ asset('assets/js/bundle.js') }}?ver=1.4.0"></script>
<script src="{{ asset('assets/js/scripts.js') }}?ver=1.4.0"></script>
</body>

</html>
