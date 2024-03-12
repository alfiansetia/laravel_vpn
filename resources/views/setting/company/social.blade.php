@extends('layouts.backend.template', ['title' => 'Setting Company'])

@push('css')
    <link href="{{ asset('backend/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/elements/alert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/forms/switches.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/users/account-setting.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/elements/alert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/forms/switches.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/users/account-setting.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <ul class="nav nav-pills" id="animateLine">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-home-tab"
                                onclick="redirect('{{ route('setting.company.general') }}')">
                                <i data-feather="user"></i> General
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="animated-underline-home-tab"
                                onclick="redirect('{{ route('setting.company.social') }}')">
                                <i data-feather="at-sign"></i> Social
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-profile-tab"
                                onclick="redirect('{{ route('setting.company.image') }}')">
                                <i data-feather="image"></i> Image
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-contact-tab"
                                onclick="redirect('{{ route('setting.company.telegram') }}')">
                                <i data-feather="send"></i> Telegram
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-database-tab"
                                onclick="redirect('{{ route('database.index') }}')">
                                <i data-feather="database"></i> Database
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form id="info" class="section general-info" action="{{ route('setting.company.social.update') }}"
                        method="POST">
                        @csrf
                        <div class="info">
                            <h6 class="">Social</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class=" col-lg-12 col-md-12 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-md-11 mx-auto">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group social-linkedin mb-3">
                                                                    <span class="input-group-text me-3" id="linkedin">
                                                                        <i data-feather="linkedin" class="bs-tooltip"
                                                                            title="Linkedin Username"></i></span>
                                                                    <input type="text" name="linkedin"
                                                                        class="form-control maxlength @error('linkedin') is-invalid @enderror"
                                                                        placeholder="Linkedin Username"
                                                                        aria-label="Username" aria-describedby="linkedin"
                                                                        value="{{ $company->linkedin }}" minlength="3"
                                                                        maxlength="30" required>
                                                                    @error('linkedin')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="input-group social-tweet mb-3">
                                                                    <span class="input-group-text me-3" id="tweet">
                                                                        <i data-feather="instagram" class="bs-tooltip"
                                                                            title="Instagram Username"></i></span>
                                                                    <input type="text" name="instagram"
                                                                        class="form-control maxlength @error('instagram') is-invalid @enderror"
                                                                        placeholder="Instagram Username"
                                                                        aria-label="Username" aria-describedby="tweet"
                                                                        value="{{ $company->instagram }}" minlength="3"
                                                                        maxlength="30" required>
                                                                    @error('instagram')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-11 mx-auto">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group social-fb mb-3">
                                                                    <span class="input-group-text me-3" id="fb">
                                                                        <i data-feather="facebook" class="bs-tooltip"
                                                                            title="Facebook Username"></i></span>
                                                                    <input type="text" name="facebook"
                                                                        class="form-control maxlength @error('facebook') is-invalid @enderror"
                                                                        placeholder="Facebook Username"
                                                                        aria-label="Username" aria-describedby="fb"
                                                                        value="{{ $company->facebook }}" minlength="3"
                                                                        maxlength="30" required>
                                                                    @error('facebook')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="input-group social-github mb-3">
                                                                    <span class="input-group-text me-3" id="github">
                                                                        <i data-feather="github" class="bs-tooltip"
                                                                            title="Github Username"></i></span>
                                                                    <input type="text" name="github"
                                                                        class="form-control maxlength @error('github') is-invalid @enderror"
                                                                        placeholder="Github Username"
                                                                        aria-label="Username" aria-describedby="github"
                                                                        value="{{ $company->github }}" minlength="3"
                                                                        maxlength="30" required>
                                                                    @error('github')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11 mx-auto">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group social-fb mb-3">
                                                                    <span class="input-group-text me-3" id="fb">
                                                                        <i data-feather="twitter" class="bs-tooltip"
                                                                            title="Twitter Username"></i></span>
                                                                    <input type="text" name="twitter"
                                                                        class="form-control maxlength @error('twitter') is-invalid @enderror"
                                                                        placeholder="Twitter Username"
                                                                        aria-label="Username" aria-describedby="fb"
                                                                        value="{{ $company->twitter }}" minlength="3"
                                                                        maxlength="30" required>
                                                                    @error('twitter')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="input-group social-github mb-3">
                                                                    <span class="input-group-text me-3" id="blog">
                                                                        <i data-feather="link" class="bs-tooltip"
                                                                            title="Link Blog"></i></span>
                                                                    <input type="text" name="blog"
                                                                        class="form-control maxlength @error('blog') is-invalid @enderror"
                                                                        placeholder="Link Blog" aria-label="Link"
                                                                        aria-describedby="Blog"
                                                                        value="{{ $company->link_blog }}" minlength="3"
                                                                        maxlength="50" required>
                                                                    @error('blog')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11 mx-auto">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="input-group social-fb mb-3">
                                                                    <span class="input-group-text me-3" id="fb">
                                                                        <i data-feather="external-link" class="bs-tooltip"
                                                                            title="Link Status Server"></i></span>
                                                                    <textarea name="status" id="status" class="form-control maxlength @error('twitter') is-invalid @enderror"
                                                                        placeholder="Link Status Server" aria-label="Link" aria-describedby="Status" minlength="3" maxlength="150"
                                                                        required>{{ $company->link_status }}</textarea>
                                                                    @error('twitter')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11 mx-auto">
                                                        <div class="form-group text-end">
                                                            <button type="reset" class="btn btn-warning">
                                                                <i class="fas fa-undo me-1 bs-tooltip"
                                                                    title="Reset"></i>Reset
                                                            </button>
                                                            <button type="submit" class="btn btn-secondary">
                                                                <i class="fas fa-paper-plane me-1 bs-tooltip"
                                                                    title="Save"></i>Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('jslib')
    <script src="{{ asset('backend/src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $('#info').validate({
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).addClass('is-valid');
                },
                submitHandler: function(form) {
                    block();
                    form.submit();
                }
            });

        });
    </script>
@endpush
