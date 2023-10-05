@extends('layouts.auth')

@section('content')
    <h1 class="">Register</h1>
    @if (Route::has('login'))
        <p class="signup-link register">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
    @endif
    <form class="text-left" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form">
            <div id="name-field" class="field-wrapper input">
                <label for="name">FULL NAME</label>
                <i data-feather="user"></i>
                <input id="name" name="name" type="text"
                    class="form-control maxlength @error('name') is-invalid @enderror" value="{{ old('name') }}"
                    autocomplete="name" placeholder="FULL NAME" minlength="3" maxlength="100" autofocus required />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div id="email-field" class="field-wrapper input">
                <label for="email">EMAIL</label>
                <i data-feather="at-sign"></i>
                <input id="email" name="email" type="email"
                    class="form-control maxlength @error('email') is-invalid @enderror" value="{{ old('email') }}"
                    autocomplete="email" placeholder="Email" minlength="3" maxlength="100" required />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div id="password-field" class="field-wrapper input mb-2">
                <div class="d-flex justify-content-between">
                    <label for="password">PASSWORD</label>
                </div>
                <i data-feather="lock"></i>
                <input id="password" name="password" type="password"
                    class="form-control maxlength @error('password') is-invalid @enderror" autocomplete="new-password"
                    placeholder="Password" minlength="5" maxlength="100" required />
                <i data-feather="eye" id="toggle-password" onclick="pw();"></i>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div id="password_confirm-field" class="field-wrapper input mb-2">
                <div class="d-flex justify-content-between">
                    <label for="password_confirm">CONFIRM PASSWORD</label>
                </div>
                <i data-feather="lock"></i>
                <input id="password_confirm" name="password_confirmation" type="password" class="form-control maxlength"
                    autocomplete="new-password" placeholder="Password" minlength="5" maxlength="100" required />
                <i data-feather="eye" onclick="con_pw();"></i>
            </div>
            <div class="field-wrapper terms_condition">
                <div class="n-chk">
                    <label class="new-control new-checkbox checkbox-primary">
                        <input type="checkbox" class="new-control-input" name="term[]">
                        <span class="new-control-indicator"></span><span>I agree to the <a href="javascript:void(0);"> terms
                                and conditions </a></span>
                    </label>
                </div>
            </div>
            <div id="captcha-field" class="field-wrapper input mb-2">
                <div class="d-flex justify-content-between">
                    <label for="captcha">CAPTCHA</label>
                </div>
                {!! htmlFormSnippet() !!}
            </div>
            @error('g-recaptcha-response')
                <div class="alert alert-light-danger border-0 mb-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i data-feather="x" class="close"></i>
                    </button>
                    <strong>Error!</strong> {{ $message }}
                </div>
            @enderror
            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                    <button type="submit" class="btn btn-primary">Get Started!</button>
                </div>
            </div>
            <div class="division">
                <span>OR</span>
            </div>
            <div class="social">
                <a href="javascript:void(0);" class="btn social-fb">
                    <i class="fab fa-google"></i>
                    <span class="brand-name">Google</span>
                </a>
                <a href="javascript:void(0);" class="btn social-fb">
                    <i class="fab fa-facebook-f"></i>
                    <span class="brand-name">Facebook</span>
                </a>
            </div>
        </div>
    </form>

    <div id="g_id_onload" data-client_id="{{ env('GOOGLE_CLIENT_ID') }}" data-login_uri="{{ route('auth.onetap') }}"
        data-_token="{{ csrf_token() }}" data-auto_prompt="true"> >
    </div>
    <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with"
        data-shape="rectangular" data-logo_alignment="left">
    </div>
@endsection


@push('js')
    <script src="https://accounts.google.com/gsi/client" async defer></script>
@endpush
