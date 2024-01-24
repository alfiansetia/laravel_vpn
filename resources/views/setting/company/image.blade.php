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

    <link href="{{ asset('backend/src/plugins/src/filepond/filepond.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/plugins/css/dark/filepond/custom-filepond.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <ul class="nav nav-pills" id="animateLine">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-home-tab"
                                onclick="redirect('{{ route('setting.company') }}')">
                                <i data-feather="user"></i> General
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="animated-underline-profile-tab"
                                onclick="redirect('{{ route('setting.image') }}')">
                                <i data-feather="at-sign"></i> Image
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-contact-tab"
                                onclick="redirect('{{ route('setting.telegram') }}')">
                                <i data-feather="send"></i> Telegram
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form id="info" class="section general-info" action="{{ route('setting.image.update') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="info">
                            <h6 class="">General Information</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class=" col-lg-12 col-md-12 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-xxl-6 col-md-12 mb-4">
                                                        <label for="logo">Logo Light</label>
                                                        <div class="img-uploader-content">
                                                            <input type="file" class="filepond" name="logo_light"
                                                                id="logo_light"
                                                                accept="image/png, image/jpeg, image/svg, image/jpg" />
                                                            @error('logo_light')
                                                                <small id="sh-text1" class="form-text text-muted">
                                                                    <font color="red">{{ $message }}</font>
                                                                </small>
                                                            @enderror
                                                            <img src="{{ $company->logo_light }}"
                                                                alt="{{ $company->name }}" height="100">

                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6 col-md-12 mb-4">
                                                        <label for="logo">Logo Dark</label>
                                                        <div class="img-uploader-content">
                                                            <input type="file" class="filepond" name="logo_dark"
                                                                id="logo_dark"
                                                                accept="image/png, image/jpeg, image/svg, image/jpg" />
                                                            @error('logo_dark')
                                                                <small id="sh-text1" class="form-text text-muted">
                                                                    <font color="red">{{ $message }}</font>
                                                                </small>
                                                            @enderror
                                                            <img src="{{ $company->logo_dark }}" alt=""
                                                                height="100">

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

    <script src="{{ asset('backend/src/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {

            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImageExifOrientation,
                FilePondPluginImagePreview,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform,
            );

            FilePond.create(
                document.querySelector('#logo_light'), {
                    name: 'logo_light',
                    storeAsFile: true,
                }
            );

            FilePond.create(
                document.querySelector('#logo_dark'), {
                    name: 'logo_dark',
                    storeAsFile: true,
                }
            );

            $('#info').validate({
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.img-uploader-content').append(error);
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
                    localStorage.clear();
                    form.submit();
                }
            });

        });
    </script>
@endpush
