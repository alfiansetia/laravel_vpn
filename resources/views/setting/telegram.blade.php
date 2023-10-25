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
    <div class="row layout-spacing pb-0">
        <!-- Content -->

        <div class="col-sm-12 layout-top-spacing">

            <div class="skills layout-spacing pb-0">
                <div class="widget-content widget-content-area">
                    <h3 class="mb-3">Update Setting Telegram</h3>
                    <form id="form" action="{{ route('setting.telegram.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="telegram_token"><i class="fas fa-key mr-1" data-toggle="tooltip"
                                    title="Telegram Token"></i>Telegram Token</label>
                            <input type="text" name="telegram_token"
                                class="form-control maxlength @error('telegram_token') is-invalid @enderror"
                                id="telegram_token" placeholder="Please Enter Telegram Token"
                                value="{{ $setting->telegram_token }}" minlength="3" maxlength="250" required autofocus>
                            @error('telegram_token')
                                <div class="alert alert-danger mb-3 mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="telegram_bot_name"><i class="fas fa-robot mr-1" data-toggle="tooltip"
                                    title="Telegram Bot Name"></i>Telegram Bot Name</label>
                            <input type="text" name="telegram_bot_name"
                                class="form-control maxlength @error('telegram_bot_name') is-invalid @enderror"
                                id="telegram_bot_name" placeholder="Please Enter Telegram Token"
                                value="{{ $setting->telegram_bot_name }}" minlength="3" maxlength="100" required>
                            @error('telegram_bot_name')
                                <div class="alert alert-danger mb-3 mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="telegram_group_id"><i class="fas fa-user-friends mr-1" data-toggle="tooltip"
                                    title="Telegram Group Id"></i>Telegram Group Id</label>
                            <input type="text" name="telegram_group_id"
                                class="form-control maxlength @error('telegram_group_id') is-invalid @enderror"
                                id="telegram_group_id" placeholder="Please Enter Telegram Token"
                                value="{{ $setting->telegram_group_id }}" minlength="3" maxlength="100" required>
                            @error('telegram_group_id')
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
                                <button type="reset" id="reset" class="btn btn-warning">
                                    <i class="fas fa-undo mr-1" data-toggle="tooltip" title="Reset"></i>Reset
                                </button>
                                <button type="button" id="unset" class="btn btn-danger">
                                    <i class="fas fa-unlink mr-1" data-toggle="tooltip" title="Unset"></i>Unset
                                </button>
                                <button type="button" id="set" class="btn btn-secondary">
                                    <i class="fas fa-link mr-1" data-toggle="tooltip" title="Set"></i>Set
                                </button>
                                <button type="button" id="info" class="btn btn-info">
                                    <i class="fas fa-info mr-1" data-toggle="tooltip" title="Info"></i>Info
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane mr-1" data-toggle="tooltip" title="Save"></i>Save
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row layout-spacing" id="webhook_info">

        <div class="col-sm-12 layout-top-spacing">

            <div class="skills layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="mb-3">Webhook Info</h3>
                    <form action="">
                        <div class="form-group mb-3">
                            <label for="url"><i class="fas fa-external-link-alt mr-1" data-toggle="tooltip"
                                    title="Url"></i>Url</label>
                            <input type="text" class="form-control" id="url" placeholder="Url Webhook">
                        </div>
                        <div class="form-row mb-2">
                            <div class="form-group col-md-6">
                                <label for="pending_update"><i class="fas fa-clock mr-1" data-toggle="tooltip"
                                        title="Pending Update Count"></i>Pending Update Count :</label>
                                <input type="text" name="telegram_token" class="form-control" id="pending_update"
                                    placeholder="Pending Update Count">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="custom_certificate"><i class="fas fa-certificate mr-1" data-toggle="tooltip"
                                        title="Custom Certificate"></i>Custom Certificate :</label>
                                <select name="api" id="custom_certificate" class="form-control"
                                    style="width: 100%;">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="ml-auto">
                                <button type="button" id="close" class="btn btn-secondary"><i
                                        class="fas fa-times mr-1" data-toggle="tooltip" title="Close"></i>Close</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('jslib')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $('#set').click(function() {
                set('set')
            })
            $('#unset').click(function() {
                set('unset')
            })

            $('#info').click(function() {
                set('info')
            })

            $('#webhook_info').hide();

            $('#close').click(function() {
                $('#webhook_info').hide();
            })

            function set(action) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('setting.telegram.set') }}",
                    data: {
                        '_method': 'PUT',
                        'action': action,
                    },
                    beforeSend: function() {
                        block();
                    },
                    success: function(res) {
                        unblock();
                        if (action === 'info') {
                            $('#webhook_info').show();
                            $('#url').val(res.data.result.url)
                            $('#pending_update').val(res.data.result.pending_update_count)
                            $('#custom_certificate').val(res.data.result.has_custom_certificate ===
                                true ? 'yes' : 'no').change()
                        } else {
                            swal(
                                'Success!',
                                res.message,
                                'success'
                            )
                        }
                    },
                    error: function(xhr, status, error) {
                        unblock();
                        handleResponse(xhr)
                    }
                });
            }

            $('#form').validate({
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
                    $('button[type="submit"]').prop('disabled', true);
                    form.submit();
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
