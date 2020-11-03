@extends('frontend.layouts.auth-app')

@section('title', __('Login'))

@section('content')
    <div class="authentication-main">
        <div class="row">
            <div class="col-md-12">
                <div class="auth-innerright">
                    <div class="authentication-box">
                        <div class="text-center"><img src="{{ asset('assets/images/endless-logo.png') }}" alt=""></div>
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4>LOGIN</h4>
                                    <h6>Enter your Username and Password </h6>
                                </div>

                                <x-forms.post :action="route('frontend.auth.login')" class="theme-form">

                                    <div class="form-group">
                                        <label for="email" class="col-form-label pt-0">@lang('E-mail Address')</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-form-label pt-0">@lang('Password')</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input name="remember" id="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }} />

                                                <label class="form-check-label" for="remember">
                                                    @lang('Remember Me')
                                                </label>
                                            </div><!--form-check-->
                                        </div>
                                    </div><!--form-group-->

                                    @if(config('boilerplate.access.captcha.login'))
                                        <div class="row">
                                            <div class="col">
                                                @captcha
                                                <input type="hidden" name="captcha_status" value="true" />
                                            </div><!--col-->
                                        </div><!--row-->
                                    @endif

                                    <div class="form-group form-row mt-3 mb-0">
                                        <button class="btn btn-primary btn-block" type="submit">@lang('Login')</button>
                                        <x-utils.link :href="route('frontend.auth.password.request')" class="mt-2 text-center" :text="__('Forgot Your Password?')" />

                                    </div>
                                </x-forms.post>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
