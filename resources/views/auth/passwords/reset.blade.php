@extends('layouts.auth')

@section('content')
    <h1 class="">Reset Password</h1>
    <form class="text-left" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form">
            <div id="email-field" class="field-wrapper input">
                <label for="email">EMAIL</label>
                <i data-feather="at-sign"></i>
                <input id="email" name="email" type="email"
                    class="form-control maxlength @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}"
                    autocomplete="email" placeholder="Email" minlength="3" maxlength="100" required autofocus />
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

            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </div>

            @if (Route::has('login'))
                <p class="signup-link">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
            @endif
        </div>
    </form>
@endsection


@push('js')
@endpush
