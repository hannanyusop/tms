@extends('backend.layouts.app')

@section('title', __('Setting'))

@php
    $tabs = [
    'system' => __('System'),
    'email' => __('Email Configuration'),
    'notification' => __('Notification')
];

    $active_tab = session('active_tab', 'system')
@endphp
@section('content')

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <ul class="nav nav-tabs mt-n3">
                    @foreach($tabs as $key => $tab)
                        <li class="nav-item">
                            <a class="nav-link {{ ($active_tab == $key)? "active show" : "" }}" data-toggle="tab" href="#{{ $key }}">{{ $tab }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    <div class="tab-pane {{ ($active_tab == "system")? "active" : "" }}" id="system">
                        <x-forms.post :action="route('admin.setting.save-system')" class="form theme-form">
                            <div class="card-body">

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit" data-original-title="" title="">{{ __('Save System') }}</button>
                            </div>
                        </x-forms.post>
                    </div>
                    <div class="tab-pane {{ ($active_tab == "email")? "active" : "" }}" id="email">
                        <p>email</p>
                    </div>
                    <div class="tab-pane {{ ($active_tab == "notification")? "active" : "" }}" id="notification">
                         <span>
                             System notification is to allow user to receive notification from the system. Make sure the configuration for the selected
                              agent is correct.
                          </span>

                        <x-forms.post :action="route('admin.setting.save-notification')" class="gy-3">

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Notification Agent') }}</label>
                                        <span class="form-note">Enable or disable registration from site.</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <ul class="custom-control-group g-3 align-center flex-wrap">
                                        @foreach(notificationTypes() as $type => $available)
                                            <li>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" value="{{ $type }}" name="notification_type" id="{{ $type }}" {{ ($available == false)? "disabled" : " " }} {{ ($settings['notification_type'] == $type)? "checked" : " " }}>
                                                    <label class="custom-control-label" for="{{ $type }}">{{ $type }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <hr>
                            <h5>{{ __('Slack Configuration') }}</h5>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="noty_slack_webhook">{{ __('Webhook') }}</label>
                                        <span class="form-note">Specify the name of your website.</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" id="noty_slack_webhook" name="noty_slack_webhook" class="form-control" placeholder="{{ __('Webhook URL') }}" value="{{ old('noty_slack_webhook') ?? $settings['noty_slack_webhook'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="noty_slack_channel">{{ __('Channel') }}</label>
                                        <span class="form-note"></span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" id="noty_slack_channel" name="noty_slack_channel" class="form-control" placeholder="{{ __('Channel') }}" value="{{ old('noty_slack_channel') ?? $settings['noty_slack_channel'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="noty_slack_username">{{ __('Bot Username') }}</label>
                                        <span class="form-note"></span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" id="noty_slack_username" name="noty_slack_username" class="form-control" placeholder="{{ __('Username') }}" value="{{ old('noty_slack_username') ?? $settings['noty_slack_username'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="noty_slack_icon_emoji">{{ __('Bot Default Emoji') }}</label>
                                        <span class="form-note"></span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" id="noty_slack_icon_emoji" name="noty_slack_icon_emoji" class="form-control" placeholder="{{ __('EX : :gost:') }}" value="{{ old('noty_slack_icon_emoji') ?? $settings['noty_slack_icon_emoji'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="noty_slack_icon_emoji">{{ __('Test ') }}</label>
                                        <span class="form-note"></span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <a href="{{ route('admin.setting.testing-slack') }}" class="btn btn-success">{{ __('Test Send Notification Via Slack') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-lg-7 offset-lg-5">
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-lg btn-primary">Save Notifaication</button>
                                    </div>
                                </div>
                            </div>
                        </x-forms.post>
                    </div>

                </div>
            </div>
        </div><!-- .card-preview -->
    </div>
@endsection
