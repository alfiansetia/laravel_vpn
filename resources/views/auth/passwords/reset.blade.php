@extends('layouts.auth', ['title' => 'Reset Password'])

@section('content')
    <div class="row">

        @include('components.auth.cover')

        <div
            class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="col-md-12 mb-3">
                                <h2>Reset Password</h2>
                                <p>Enter your new password to change</p>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
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
                                            value="{{ $email ?? old('email') }}" placeholder="Input Your Email"
                                            aria-describedby="basic-addon1" minlength="8" maxlength="100" required
                                            readonly>
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
                                            autocomplete="current-password" placeholder="Input Your Password" autofocus
                                            required>
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
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-secondary w-100">RESET PASSWORD</button>
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
