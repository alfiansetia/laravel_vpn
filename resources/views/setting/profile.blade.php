@extends('layouts.template')

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/elements/custom-typography.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="row layout-spacing">
        <!-- Content -->
        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Profile</h3>
                        <a href="javascript:void(0);" class="mt-2 edit-profile" id="edit_profile_btn">
                            <i data-feather="edit-3"></i>
                        </a>
                    </div>
                    <div class="text-center user-info">
                        <img src="{{ asset('assets/img') }}{{ auth()->user()->gender == 'Male' ? '/boy-2.png' : '/girl-2.png' }}"
                            alt="avatar">
                        <p class="">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="user-info-list">
                        <div class="">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item" data-toggle="tooltip" title="Role Account">
                                    <i data-feather="user"></i>
                                    {{ auth()->user()->role }}
                                </li>
                                <li class="contacts-block__item" data-toggle="tooltip" title="Email">
                                    <a href="mailto:{{ auth()->user()->email }}">
                                        <i data-feather="mail"></i> {{ auth()->user()->email }}
                                    </a>
                                </li>
                                <li class="contacts-block__item" data-toggle="tooltip" title="Gender">
                                    <i data-feather="users"></i> {{ auth()->user()->gender }}
                                </li>
                                <li class="contacts-block__item" data-toggle="tooltip" title="Phone / WhatsApp">
                                    <i data-feather="phone"></i> {{ auth()->user()->phone }}
                                </li>
                                <li class="contacts-block__item" data-toggle="tooltip" title="Address">
                                    <i data-feather="map-pin"></i> {{ auth()->user()->address }}
                                </li>
                                <li class="contacts-block__item" data-toggle="tooltip" title="Register Date">
                                    <i data-feather="calendar"></i>
                                    {{ date('d M Y H:i', strtotime(auth()->user()->created_at)) }}
                                </li>
                                <li class="contacts-block__item" data-toggle="tooltip" title="last Login">
                                    <i data-feather="log-in"></i>
                                    {{ date('d M Y H:i', strtotime(auth()->user()->last_login_at ?? date('Y-m-d H:i:s'))) }}
                                </li>
                                <li class="contacts-block__item" data-toggle="tooltip" title="last Login IP">
                                    <i data-feather="globe"></i>
                                    {{ auth()->user()->last_login_ip ?? 'Unavailable' }}
                                </li>
                            </ul>
                            <a href="{{ route('setting.password') }}" class="btn btn-danger btn-block">
                                <i class="fas fa-fingerprint mr-1"></i>Change Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
            <div class="skills layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">User Settings</h3>
                    <form id="form" class="section contact" method="POST"
                        action="{{ route('setting.profile.update') }}">
                        @csrf
                        <div class="info">
                            <div class="row">
                                <div class="col-md-11 mx-auto">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name"><i class="far fa-user mr-1" data-toggle="tooltip"
                                                        title="Full Name"></i>Name :</label>
                                                <input type="text" name="name"
                                                    class="form-control mb-4 maxlength @error('name') is-invalid @enderror"
                                                    id="name" placeholder="Please Enter Name"
                                                    value="{{ auth()->user()->name }}" minlength="3" maxlength="50"
                                                    required autofocus>
                                                @error('name')
                                                    <div class="alert alert-danger mt-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email"><i class="far fa-envelope mr-1"
                                                        data-toggle="tooltip" title="Email"></i>Email :</label>
                                                <input type="email" name="email" disabled class="form-control mb-4"
                                                    id="email" placeholder="Please Enter Email"
                                                    value="{{ auth()->user()->email }}">
                                                @error('email')
                                                    <div class="alert alert-danger mb-3 mt-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="gender"><i class="fas fa-venus-mars mr1"
                                                        data-toggle="tooltip" title="Gender"></i>Gender :</label>
                                                <select name="gender"
                                                    class="form-control @error('gender') is-invalid @enderror"
                                                    id="gender" required>
                                                    <option {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}
                                                        value="Male">Male</option>
                                                    <option {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}
                                                        value="Female">Female</option>
                                                </select>
                                                @error('gender')
                                                    <div class="alert alert-danger mt-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phone"><i class="fas fa-phone-alt mr-1"
                                                        data-toggle="tooltip" title="Phone / WhatsApp"></i>Phone /
                                                    WhatsApp :</label>
                                                <input type="tel" name="phone"
                                                    class="form-control maxlength @error('phone') is-invalid @enderror"
                                                    id="phone" placeholder="Please Enter Phone"
                                                    value="{{ auth()->user()->phone }}" required minlength="3"
                                                    maxlength="20">
                                                @error('phone')
                                                    <div class="alert alert-danger mt-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address"><i class="fas fa-map-marker-alt mr-1"
                                                        data-toggle="tooltip" title="Full Address"></i>Address :</label>
                                                <textarea type="text" name="address" class="form-control maxlength @error('address') is-invalid @enderror"
                                                    id="address" placeholder="Please Enter Address" minlength="3" maxlength="100" required>{{ auth()->user()->address }}</textarea>
                                                @error('address')
                                                    <div class="alert alert-danger mt-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="reset" id="reset" class="btn btn-warning"><i
                                                    class="fas fa-undo mr-1" data-toggle="tooltip"
                                                    title="Reset"></i>Reset</button>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fas fa-paper-plane mr-1" data-toggle="tooltip"
                                                    title="Save"></i>Save</button>
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

@push('js')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->

    <script>
        $(document).ready(function() {
            $('#edit_profile_btn').click(function() {
                $('#name').focus();
            });

            var old = $('#gender').val()

            $('#gender').select2();

            $('#reset').click(function() {
                $('#gender').val(old).change()
            })

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $('#form').submit(function(event) {
                block();
            }).validate({
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
                }
            });

        });
    </script>



    @if (session()->has('success'))
        <script>
            swal(
                'Success',
                "{{ session('success') }}",
                'success'
            )
        </script>
    @elseif(session()->has('error'))
        <script>
            swal(
                'Failed!',
                "{{ session('error') }}",
                'error'
            )
        </script>
    @endif
@endpush
