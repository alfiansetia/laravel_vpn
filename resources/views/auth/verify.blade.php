@extends('layouts.auth', ['title' => 'Sign In'])

@section('content')
    <div class="row">

        @include('components.auth.cover')

        <div
            class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <form action="{{ route('verification.resend') }}" method="POST">
                            @csrf
                            <div class="col-md-12 mb-3">
                                <div class="text-center mb-2">
                                    <img src="{{ $user->avatar }}" alt="">
                                </div>
                                <div class=" mt-2 mb-2">
                                    <p>Hello <strong>{{ $user->name }}</strong>...</p>
                                </div>
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif
                                <p class="">Before proceeding, please check your <strong>email</strong> for a
                                    verification link. If
                                    you did not receive the <strong>email</strong>, click this <strong>button below</strong>
                                    to request
                                    another</p>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-secondary w-100">RESEND EMAIL</button>
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
