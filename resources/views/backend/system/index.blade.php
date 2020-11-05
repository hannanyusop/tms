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
  <div class="row">
      <div class="col-sm-12 col-xl-12 xl-100">
          <div class="card">
              <div class="card-header">
                  <h5>Simple Material style tab</h5><span>Add <code>.border-tab</code> class with nav class</span>
              </div>
              <div class="card-body">
                  <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                      @foreach($tabs as $key => $tab)
                          <li class="nav-item"><a class="nav-link {{ ($active_tab == $key)? "active show" : "" }}" id="top-{{ $key }}-tab" data-toggle="tab" href="#top-{{ $key }}" role="tab" aria-controls="top-{{ $key }}" aria-selected="true" data-original-title="" title="">{{ $tab }}</a></li>
                      @endforeach
                  </ul>
                  <div class="tab-content" id="top-tabContent">
                      <div class="tab-pane fade {{ ($active_tab == "system")? "active show" : "" }}" id="top-system" role="tabpanel" aria-labelledby="top-system-tab">
                          <x-forms.post :action="route('admin.setting.save-system')" class="form theme-form">
                              <div class="card-body">

                              </div>
                              <div class="card-footer">
                                  <button class="btn btn-primary" type="submit" data-original-title="" title="">{{ __('Save System') }}</button>
                              </div>
                          </x-forms.post>
                      </div>
                      <div class="tab-pane fade {{ ($active_tab == "email")? "active show" : "" }}" id="top-email" role="tabpanel" aria-labelledby="email-top-tab">
                        <p>email</p>
                      </div>
                      <div class="tab-pane fade {{ ($active_tab == "notification")? "active show" : "" }}" id="top-notification" role="tabpanel" aria-labelledby="notification-top-tab">
                          <span>
                             System notification is to allow user to receive notification from the system. Make sure the configuration for the selected
                              agent is correct.
                          </span>
                          <x-forms.post :action="route('admin.setting.save-notification')" class="form theme-form">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col">
                                          <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">{{ __('Notification Agent') }}</label>
                                              <div class="col-sm-9">
                                                  <div class="col">
                                                      <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                          @foreach(notificationTypes() as $type => $available)
                                                              <div class="radio radio-primary">
                                                                  <input id="{{ $type }}" type="radio" name="notification_type" value="{{ $type }}" {{ ($available == false)? "disabled" : " " }} {{ ($settings['notification_type'] == $type)? "checked" : " " }}>
                                                                  <label class="mb-0" for="{{ $type }}">{{ $type }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-sm-12">
                                      <h5 class="text-warning"><i class="fa fa-slack "></i> {{ __('Slack Configuration') }}</h5>
                                  </div>

                                  <div class="row">
                                      <div class="col">
                                          <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">{{ __('Webhook') }}</label>
                                              <div class="col-sm-9">
                                                  <input type="text" id="noty_slack_webhook" name="noty_slack_webhook" class="form-control" placeholder="{{ __('Webhook URL') }}" value="{{ old('noty_slack_webhook') ?? $settings['noty_slack_webhook'] }}">
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col">
                                          <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">{{ __('Channel') }}</label>
                                              <div class="col-sm-9">
                                                  <input type="text" id="noty_slack_channel" name="noty_slack_channel" class="form-control" placeholder="{{ __('Channel') }}" value="{{ old('noty_slack_channel') ?? $settings['noty_slack_channel'] }}">
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col">
                                          <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">{{ __('Bot Username') }}</label>
                                              <div class="col-sm-9">
                                                  <input type="text" id="noty_slack_username" name="noty_slack_username" class="form-control" placeholder="{{ __('Username') }}" value="{{ old('noty_slack_username') ?? $settings['noty_slack_username'] }}">
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col">
                                          <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">{{ __('Bot Default Emoji') }}</label>
                                              <div class="col-sm-9">
                                                  <input type="text" id="noty_slack_icon_emoji" name="noty_slack_icon_emoji" class="form-control" placeholder="{{ __('EX : :gost:') }}" value="{{ old('noty_slack_icon_emoji') ?? $settings['noty_slack_icon_emoji'] }}">
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col">
                                          <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">{{ __('') }}</label>
                                              <div class="col-sm-9">
                                                  <a href="{{ route('admin.setting.testing-slack') }}" class="btn btn-success">{{ __('Test Send Notification Via Slack') }}</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-sm-12">
                                      <h5 class="text-info"><i class="fa fa-envelope-open-o"></i> {{ __('E-mail Configuration') }}</h5>
                                  </div>

                              </div>
                              <div class="card-footer">
                                  <button class="btn btn-primary" type="submit" data-original-title="" title="">{{ __('Save Notification') }}</button>
                              </div>
                          </x-forms.post>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
