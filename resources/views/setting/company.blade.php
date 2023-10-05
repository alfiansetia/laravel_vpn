@extends('layouts.template')

@push('css')
    <link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/users/account-setting.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row layout-spacing">
        <!-- Content -->

        <div class="col-sm-12 layout-top-spacing">

            <div class="skills layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="mb-3">Update Company</h3>
                    <form id="form" action="{{ route('setting.company.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name"><i class="fas fa-home mr-1" data-toggle="tooltip"
                                    title="Company Name"></i>Company Name</label>
                            <input type="text" name="name"
                                class="form-control maxlength @error('name') is-invalid @enderror" id="name"
                                placeholder="Please Enter Name" value="{{ $comp->name }}" minlength="3" maxlength="50"
                                required autofocus>
                            @error('name')
                                <div class="alert alert-danger mb-3 mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone"><i class="fas fa-phone mr-1" data-toggle="tooltip"
                                    title="Company Phone"></i>Phone</label>
                            <input type="number" name="phone"
                                class="form-control maxlength @error('phone') is-invalid @enderror" id="phone"
                                placeholder="08xxx" value="{{ $comp->phone }}" required maxlength="15">
                            @error('phone')
                                <div class="alert alert-danger mb-3 mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="logo"><i class="fas fa-image mr-1" data-toggle="tooltip"
                                    title="Company Logo"></i>Logo</label>
                            <div class="custom-file mb-2">
                                <input type="file" name="logo" id="logo"
                                    class="custom-file-input @error('logo') is-invalid @enderror">
                                <label class="custom-file-label" for="logo">Choose file</label>
                            </div>
                            <div class="avatar avatar-lg">
                                <img alt="Company Logo" src="{{ asset('assets/img/logo') }}/{{ $comp->logo }}"
                                    class="rounded" style="width: 30%;height: 30%;" />
                            </div>
                            @error('logo')
                                <div class="alert alert-danger mb-3 mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="address"><i class="fas fa-map-marker mr-1" data-toggle="tooltip"
                                    title="Company Address"></i>Address</label>
                            <textarea name="address" id="address" class="form-control" placeholder="PLease Input Address" minlength="3"
                                maxlength="200" required>{{ $comp->address }}</textarea>
                            @error('address')
                                <div class="alert alert-danger mb-3 mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="ml-auto">
                                <button type="reset" id="reset" class="btn btn-warning"><i
                                        class="fas fa-undo mr-1" data-toggle="tooltip" title="Reset"></i>Reset</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                                        data-toggle="tooltip" title="Save"></i>Save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $('#form').submit(function(event) {
                block();
                $('button[type="submit"]').prop('disabled', true);
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
        })
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
