@extends('frontend.layouts.auth-app')

@section('title', __('Login'))

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">Sign-In</h5>
            <div class="nk-block-des">
                <p>Access the panel using your email and passcode.</p>
            </div>
        </div>
    </div>
    <x-forms.post :action="route('frontend.auth.login')" class="theme-form">
        <div class="form-group">
            <div class="form-label-group">
                <label class="form-label" for="default-01">Email</label>
            </div>
            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
        </div><!-- .foem-group -->
        <div class="form-group">
            <div class="form-label-group">
                <label class="form-label" for="password">Passcode</label>
                <a class="link link-primary link-sm" tabindex="-1" href="{{ route('frontend.auth.password.request') }}">Forgot Code?</a>
            </div>
            <div class="form-control-wrap">
                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
            </div>
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
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
        </div>
    </x-forms.post>
@endsection
