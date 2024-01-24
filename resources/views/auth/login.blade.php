@extends('layouts.auth', ['title' => 'Sign In'])

@section('content')
    <div class="row">

        @include('components.auth.cover')

        <div
            class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="col-md-12 mb-3">
                                <h2>Sign In</h2>
                                <p>Enter your email and password to login</p>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bs-tooltip" title="Email" id="basic-addon1">
                                            <i data-feather="at-sign"></i>
                                        </span>
                                        <input type="email" name="email" id="email"
                                            class="form-control maxlength @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="Input Your Email"
                                            aria-describedby="basic-addon1" minlength="5" maxlength="100" required
                                            autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bs-tooltip" title="Password" id="basic-addon2">
                                            <i data-feather="lock"></i>
                                        </span>
                                        <input type="password"
                                            class="form-control maxlength @error('password') is-invalid @enderror"
                                            name="password" id="password" minlength="5" maxlength="150"
                                            autocomplete="current-password" placeholder="Input Your Password" required>
                                        <span class="input-group-text bs-tooltip" title="Show/Hide" id="toggle-password"
                                            onclick="pw();"><i data-feather="eye-off"></i></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 d-flex justify-content-between">
                                    <div class="form-check form-check-primary form-check-inline">
                                        <input class="form-check-input me-3" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">Forgot
                                            Password?</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-secondary w-100">SIGN IN</button>
                                </div>
                            </div>
                        </form>

                        @include('components.auth.social')

                        @if (Route::has('register'))
                            <div class="col-12">
                                <div class="text-center">
                                    <p class="mb-0">Dont't have an account ? <a href="{{ route('register') }}"
                                            class="text-warning">Sign
                                            Up</a></p>
                                </div>
                            </div>
                        @endif

                        @include('components.auth.ontap')

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://accounts.google.com/gsi/client" async defer></script>
@endpush
