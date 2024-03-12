@extends('layouts.backend.template', ['title' => 'Setting Password'])

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
    <link href="{{ asset('backend/src/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <ul class="nav nav-pills" id="animateLine">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-home-tab"
                                onclick="redirect('{{ route('setting.profile.edit') }}')">
                                <i data-feather="user"></i> Preferences
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-profile-tab"
                                onclick="redirect('{{ route('setting.profile.social') }}')">
                                <i data-feather="at-sign"></i> Social
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="animated-underline-contact-tab"
                                onclick="redirect('{{ route('setting.profile.password') }}')">
                                <i data-feather="lock"></i> Password
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 layout-spacing">
                    <form class="section general-info">
                        <div class="info">
                            <h6 class="">Info</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class=" col-lg-12 col-md-8 mt-md-0">
                                            <ul class="list-icon mb-4">
                                                <li>
                                                    <i class="fas fa-arrow-right"></i>
                                                    <span class="list-text">Password harus lebih dari 8
                                                        karakter.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-arrow-right"></i>
                                                    <span class="list-text">Gunakan kombinasi huruf dan angka atau
                                                        simbol.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-arrow-right"></i>
                                                    <span class="list-text">Hindari password dengan kata
                                                        umum.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-arrow-right"></i>
                                                    <span class="list-text">Jangan menggunakan Password yang
                                                        sama.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-arrow-right"></i>
                                                    <span class="list-text">Gunakan istilah yang mudah anda
                                                        ingat.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-arrow-right"></i>
                                                    <span class="list-text">Password akan dienkripsi untuk
                                                        menghindari penyalahgunaan data.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-arrow-right"></i>
                                                    <span class="list-text">Harap hati-hati dalam mengubah password
                                                        !</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-12 layout-spacing">
                    <form id="info" class="section general-info"
                        action="{{ route('setting.profile.password.update') }}" method="POST">
                        @csrf
                        <div class="info">
                            <h6 class="">Password Setting</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class=" col-lg-12 col-md-12 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">New Password</label>
                                                            <input type="password" name="password" id="password"
                                                                class="form-control mb-3 maxlength @error('password') is-invalid @enderror"
                                                                placeholder="New Password" minlength="8" maxlength="100"
                                                                required autofocus>
                                                            @error('password')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password_confirmation">Confirm Password</label>
                                                            <input type="password" name="password_confirmation"
                                                                id="password_confirmation" placeholder="Confirm Password"
                                                                class="form-control mb-3 maxlength @error('password_confirmation') is-invalid @enderror"
                                                                minlength="8" maxlength="100" required>
                                                            @error('password_confirmation')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-1">
                                                        <div class="form-group text-end">
                                                            <button type="reset" id="reset"
                                                                class="btn btn-warning">
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

    <script src="{{ asset('backend/src/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/select2/custom-select2.js') }}"></script>

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
