@extends('layouts.auth')

@section('content')
    <div class="d-flex user-meta">
        <img src="{{ asset('assets/img') }}{{ auth()->user()->gender == 'Male' ? '/boy-2.png' : '/girl-2.png' }}"
            class="usr-profile" alt="avatar">
        <div class="">
            <p class="">{{ auth()->user()->name }}</p>
        </div>
    </div>
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif
    <form class="text-left" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <div class="form">
            <div id="password-field" class="field-wrapper input mb-2">
                <p class="">Before proceeding, please check your <strong>email</strong> for a verification link. If
                    you did not receive the <strong>email</strong>, click this <strong>button below</strong> to request
                    another</p>
            </div>
            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                    <button type="submit" class="btn btn-primary">Resend Email</button>
                </div>
            </div>
            @if (Route::has('login'))
                <p class="signup-link">Already have an account? <a href="javascript:void(0);"
                        onclick="document.getElementById('form_logout').submit();">Log in</a></p>
            @endif
        </div>
    </form>
@endsection

@push('js')
@endpush
