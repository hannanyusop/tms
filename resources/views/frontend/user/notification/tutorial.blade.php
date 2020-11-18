@extends('frontend.layouts.app')

@section('title', __('Get Notify'))

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg wide-sm mx-auto">
                    <div class="nk-block-head-content text-center">
                        <h2 class="nk-block-title fw-normal">Get Notify</h2>
                        <div class="nk-block-des">
                            <p class="text-soft ff-italic">Via : {{ $type }}</p>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block col-md-6 offset-md-3">
                    <div class="card card-bordered">
                        <div class="card-inner card-inner-xl">
                            <div class="entry">
                                <p>1. Download Slack <a target="_blank" href="https://slack.com/intl/en-my/downloads/">Here</a> </p>
                                <p class="text-center">
                                    <img class="img-fluid w-50" alt="slack#1" src="{{ asset('img/tuto/slack/0.jpeg') }}">
                                </p>
                                <p>2. Login / Register using your email </p>
                                <p class="text-center">
                                    <img class="img-fluid w-50" alt="slack#1" src="{{ asset('img/tuto/slack/1.jpeg') }}">
                                </p>
                                <p>3. Add workspace " {{ \App\Models\Utility::getValByName('noty_slack_url') }} " </p>
                                <p class="text-center">
                                    <img class="img-fluid w-50" alt="slack#1" src="{{ asset('img/tuto/slack/2.jpeg') }}">
                                </p>

                                <p>4. Done !</p>


                                <a href="{{ route('frontend.user.notification.testing') }}" class="btn btn-sm btn-info">Test Send Via {{ $type }}</a>



                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
@endsection
