@extends('layouts.auth', ['title' => 'Confirm Password'])

@section('content')
    <div class="row">

        @include('components.auth.cover')

        <div
            class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <form action="{{ route('password.confirm') }}" method="POST">
                            @csrf
                            <div class="col-md-12 mb-3">
                                <div class="text-center mb-2">
                                    <img src="{{ $user->avatar }}" alt="">
                                </div>
                                <div class=" mt-2 mb-2">
                                    <p>Hello <strong>{{ $user->name }}</strong>...</p>
                                </div>
                                <p>Please confirm your password before continuing</p>
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
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-secondary w-100">CONFIRM PASSWORD</button>
                                </div>
                            </div>
                        </form>

                        @if (Route::has('login'))
                            <div class="col-12">
                                <div class="text-center">
                                    <p class="mb-0">Already have an account? <a href="javascript:void(0);"
                                            onclick="document.getElementById('form_logout').submit();"
                                            class="text-warning">Sign In</a></p>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://accounts.google.com/gsi/client" async defer></script>
@endpush
