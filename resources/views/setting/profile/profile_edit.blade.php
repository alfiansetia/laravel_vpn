@extends('layouts.backend.template', ['title' => 'Setting Profile'])

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
                            <button class="nav-link active" id="animated-underline-home-tab"
                                onclick="redirect('{{ route('setting.profile.edit') }}')">
                                <i data-feather="user"></i> Preferences
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-profile-tab"
                                onclick="redirect('{{ route('setting.social') }}')">
                                <i data-feather="at-sign"></i> Social
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-contact-tab"
                                onclick="redirect('{{ route('setting.password') }}')">
                                <i data-feather="lock"></i> Password
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form id="info" class="section general-info" action="{{ route('setting.profile.update') }}"
                        method="POST">
                        @csrf
                        <div class="info">
                            <h6 class="">General Information</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class=" col-lg-12 col-md-12 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Full Name</label>
                                                            <input type="text"
                                                                class="form-control mb-3 maxlength @error('name') is-invalid @enderror"
                                                                name="name" id="name" placeholder="Full Name"
                                                                value="{{ $user->name }}" minlength="3" maxlength="50"
                                                                required autofocus>
                                                            @error('name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control mb-3 maxlength"
                                                                name="email" id="email"
                                                                placeholder="Write your email here"
                                                                value="{{ $user->email }}" disabled readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="gender">Gender</label>
                                                            <select
                                                                class="form-select mb-3 @error('gender') is-invalid @enderror"
                                                                name="gender" id="gender" required>
                                                                <option {{ $user->gender == 'male' ? 'selected' : '' }}
                                                                    value="male">Male</option>
                                                                <option {{ $user->gender == 'female' ? 'selected' : '' }}
                                                                    value="female">Female</option>
                                                            </select>
                                                            @error('gender')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Phone</label>
                                                            <input type="tel"
                                                                class="form-control mb-3 maxlength @error('phone') is-invalid @enderror"
                                                                name="phone" id="phone"
                                                                placeholder="Write your phone number here"
                                                                value="{{ $user->phone }}" minlength="8"
                                                                maxlength="15" required>
                                                            @error('phone')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="address">Address</label>
                                                            <textarea class="form-control mb-3 maxlength @error('address') is-invalid @enderror" name="address" id="address"
                                                                placeholder="Your Address" minlength="3" maxlength="150" required>{{ $user->address }}</textarea>
                                                            @error('address')
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
            var old = $('#gender').val()

            $('#gender').select2();

            $('#reset').click(function() {
                $('#gender').val(old).change()
            })

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
