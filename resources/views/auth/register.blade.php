@extends('layouts.auth', ['title' => 'Sign Up'])

@push('csslib')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/src/assets/css/dark/elements/alert.css') }}">
    <!--  END CUSTOM STYLE FILE  -->
@endpush
@section('content')
    <div class="row">

        @include('components.auth.cover')

        <div
            class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="col-md-12 mb-3">
                                <h2>Sign Up</h2>
                                <p>Enter your Name, email and password to Sign Up</p>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bs-tooltip" title="Full Name" id="basic-addon10">
                                            <i data-feather="at-sign"></i>
                                        </span>
                                        <input type="text" name="name" id="name"
                                            class="form-control maxlength @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Input Your Full Name"
                                            aria-describedby="basic-addon10" minlength="3" maxlength="100" required
                                            autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
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
                                            aria-describedby="basic-addon1" minlength="5" maxlength="100" required>
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
                                            name="password" id="password" minlength="8" maxlength="150"
                                            autocomplete="current-password" placeholder="Input Password" required>
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
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bs-tooltip" title="Password Confirmation"
                                            id="basic-addon3">
                                            <i data-feather="lock"></i>
                                        </span>
                                        <input type="password"
                                            class="form-control maxlength @error('password') is-invalid @enderror"
                                            name="password_confirmation" id="password_confirmation"
                                            autocomplete="current-password" placeholder="Input Password Confirmation"
                                            minlength="8" maxlength="150" required>
                                        <span class="input-group-text bs-tooltip" title="Show/Hide" id="toggle-password2"
                                            onclick="pw_con();"><i data-feather="eye-off"></i></span>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-check form-check-primary form-check-inline">
                                        <input class="form-check-input me-3" type="checkbox" name="term[]"
                                            id="form-check-default">
                                        <label class="form-check-label" for="form-check-default">
                                            I agree the <a href="javascript:void(0);" class="text-primary">Terms and
                                                Conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="captcha">CAPTCHA</label>
                                    </div>
                                    {!! htmlFormSnippet() !!}
                                    @error('g-recaptcha-response')
                                        <div class="alert alert-light-danger alert-dismissible fade show border-0 mb-4"
                                            role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"><i data-feather="x"></i></button>
                                            <strong>Error!</strong> {{ $message }}</button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-secondary w-100">SIGN UP</button>
                                </div>
                            </div>
                        </form>

                        @include('components.auth.social')

                        @if (Route::has('login'))
                            <div class="col-12">
                                <div class="text-center">
                                    <p class="mb-0">Already have an account ? <a href="{{ route('login') }}"
                                            class="text-warning">Sign In</a></p>
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
