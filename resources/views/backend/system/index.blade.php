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
                        <p>system</p>
                      </div>
                      <div class="tab-pane fade {{ ($active_tab == "email")? "active show" : "" }}" id="top-email" role="tabpanel" aria-labelledby="email-top-tab">
                        <p>email</p>
                      </div>
                      <div class="tab-pane fade {{ ($active_tab == "notification")? "active show" : "" }}" id="top-notification" role="tabpanel" aria-labelledby="notification-top-tab">
                        <p>noti</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
