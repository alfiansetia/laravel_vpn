@extends('layouts.auth')

@section('content')
    <h1 class="">Sign In</h1>
    <p class="">Log in to your account to continue.</p>
    <form class="text-left" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form">
            <div id="email-field" class="field-wrapper input">
                <label for="email">EMAIL</label>
                <i data-feather="user"></i>
                <input id="email" name="email" type="email"
                    class="form-control maxlength  @error('email') is-invalid @enderror" value="{{ old('email') }}"
                    placeholder="xxx@mail.com" required minlength="3" maxlength="100" autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div id="password-field" class="field-wrapper input mb-2">
                <div class="d-flex justify-content-between">
                    <label for="password">PASSWORD</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-pass-link">Forgot Password?</a>
                    @endif
                </div>
                <i data-feather="lock"></i>
                <input id="password" name="password" type="password"
                    class="form-control maxlength @error('password') is-invalid @enderror" placeholder="Password" required
                    minlength="5" maxlength="100" autocomplete="current-password">
                <i data-feather="eye" id="toggle-password" onclick="pw();"></i>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="field-wrapper terms_condition">
                <div class="n-chk">
                    <label class="new-control new-checkbox checkbox-primary">
                        <input type="checkbox" class="new-control-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <span class="new-control-indicator"></span><span>Remember Me</span>
                    </label>
                </div>
            </div>
            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                    <button type="submit" class="btn btn-primary" value="">Log In</button>
                </div>
            </div>
            <div class="division">
                <span>OR</span>
            </div>
            <div class="social">
                <a href="{{ route('auth.redirect') }}" class="btn social-fb">
                    <i class="fab fa-google"></i>
                    <span class="brand-name">Google</span>
                </a>
                <a href="{{ route('auth.fb.redirect') }}" class="btn social-fb">
                    <i class="fab fa-facebook-f"></i>
                    <span class="brand-name">Facebook</span>
                </a>
            </div>
            {{-- @if (Route::has('register')) --}}
            <p class="signup-link">Not registered ? <a href="{{ route('auth.redirect') }}">Create an account</a></p>
            {{-- @endif --}}
        </div>
    </form>
    <div id="g_id_onload" data-client_id="{{ env('GOOGLE_CLIENT_ID') }}" data-login_uri="{{ route('auth.onetap') }}"
        data-_token="{{ csrf_token() }}" data-auto_prompt="true"> >
    </div>
    <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with"
        data-shape="rectangular" data-logo_alignment="left">
    </div>
    </div>
@endsection

@push('js')
    <script src="https://accounts.google.com/gsi/client" async defer></script>
@endpush
