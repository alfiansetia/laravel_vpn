@extends('layouts.auth')

@section('content')
    <h1 class="">Password Recovery</h1>
    <p class="signup-link recovery">Enter your email and instructions will sent to you!</p>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form class="text-left" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form">
            <div id="email-field" class="field-wrapper input">
                <div class="d-flex justify-content-between">
                    <label for="email">EMAIL</label>
                </div>
                <i data-feather="at-sign"></i>
                <input id="email" name="email" type="email"
                    class="form-control maxlength @error('email') is-invalid @enderror" value="{{ old('email') }}"
                    autocomplete="email" placeholder="Email" required minlength="3" maxlength="100" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                    <button type="submit" class="btn btn-primary">Reset</button>
                </div>
            </div>

            @if (Route::has('login'))
                <p class="signup-link">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
            @endif
        @endsection

    </div>


</form>
