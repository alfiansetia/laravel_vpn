@extends('layouts.auth')

@section('content')
    <h1 class="">Confirm Password</h1>
    <p class="">Please confirm your password before continuing.</p>
    <form class="text-left" method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="form">
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
                    minlength="5" maxlength="100" autocomplete="current-password" autofocus>
                <i data-feather="eye" id="toggle-password" onclick="pw();"></i>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                    <button type="submit" class="btn btn-primary" value="">Confirm Password</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
@endpush
