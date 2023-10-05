@extends('layouts.template')

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/elements/custom-typography.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row layout-spacing">
        <!-- Content -->
        <div class="col-xl-5 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

            <div class="bio layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">INFO</h3>
                    <ul class="list-icon mb-4">
                        <li>
                            <i class="fas fa-arrow-right"></i>
                            <span class="list-text">Password harus lebih dari 8 karakter.</span>
                        </li>
                        <li>
                            <i class="fas fa-arrow-right"></i>
                            <span class="list-text">Gunakan kombinasi huruf dan angka atau simbol.</span>
                        </li>
                        <li>
                            <i class="fas fa-arrow-right"></i>
                            <span class="list-text">Hindari password dengan kata umum.</span>
                        </li>
                        <li>
                            <i class="fas fa-arrow-right"></i>
                            <span class="list-text">Jangan menggunakan Password yang sama.</span>
                        </li>
                        <li>
                            <i class="fas fa-arrow-right"></i>
                            <span class="list-text">Gunakan istilah yang mudah anda ingat.</span>
                        </li>
                        <li>
                            <i class="fas fa-arrow-right"></i>
                            <span class="list-text">Password akan dienkripsi untuk menghindari penyalahgunaan data.</span>
                        </li>
                        <li>
                            <i class="fas fa-arrow-right"></i>
                            <span class="list-text">Harap hati-hati dalam mengubah password !</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-xl-7 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
            <div class="skills layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">{{ $title }}</h3>
                    <form id="form" class="section contact" method="POST"
                        action="{{ route('setting.password.update') }}">
                        @csrf
                        <div class="info">
                            <div class="row">
                                <div class="col-md-11 mx-auto">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password"><i class="fas fa-lock mr-1" data-toggle="tooltip"
                                                        title="New Password"></i>New Password :</label>
                                                <input type="password" name="password"
                                                    class="form-control mb-4 maxlength @error('password') is-invalid @enderror"
                                                    id="password" placeholder="********" minlength="8" maxlength="50"
                                                    required autofocus>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password2"><i class="fas fa-sync mr-1" data-toggle="tooltip"
                                                        title="Confirm New Password"></i>Confirm New Password :</label>
                                                <input type="password" name="password2"
                                                    class="form-control mb-4 maxlength @error('password2') is-invalid @enderror"
                                                    id="password2" placeholder="********" minlength="8" maxlength="50"
                                                    required>
                                                @error('password2')
                                                    <div class="alert alert-danger mt-2" role="alert">
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
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

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $('#form').submit(function(event) {
                block();
            }).validate({
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    unblock();
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    unblock();
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
