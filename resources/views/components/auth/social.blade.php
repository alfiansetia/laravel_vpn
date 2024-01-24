<div class="col-12 mb-4">
    <div class="">
        <div class="seperator">
            <hr>
            <div class="seperator-text"> <span>Or continue with</span></div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-12">
    <div class="mb-4">
        <a class="btn btn-social-login w-100" href="{{ route('auth.redirect') }}">
            <img src="{{ asset('images/google-gmail.svg') }}" alt="" class="img-fluid">
            <span class="btn-text-inner">Google</span>
        </a>
    </div>
</div>

<div class="col-sm-6 col-12">
    <div class="mb-4">
        <a class="btn btn-social-login w-100" href="{{ route('auth.fb.redirect') }}">
            <img src="{{ asset('images/github-icon.svg') }}" alt="" class="img-fluid">
            <span class="btn-text-inner">Facebook</span>
        </a>
    </div>
</div>
