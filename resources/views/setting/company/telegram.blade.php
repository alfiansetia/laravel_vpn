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
                                onclick="redirect('{{ route('setting.company') }}')">
                                <i data-feather="user"></i> General
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-profile-tab"
                                onclick="redirect('{{ route('setting.image') }}')">
                                <i data-feather="at-sign"></i> Image
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="animated-underline-contact-tab"
                                onclick="redirect('{{ route('setting.telegram') }}')">
                                <i data-feather="send"></i> Telegram
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form id="form_info" class="section general-info" action="{{ route('setting.telegram.update') }}"
                        method="POST">
                        @csrf
                        <div class="info">
                            <h6 class="">Telegram</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class=" col-lg-12 col-md-12 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="telegram_token">Telegram Bot Token</label>
                                                            <textarea class="form-control mb-3 maxlength @error('telegram_token') is-invalid @enderror" name="telegram_token"
                                                                id="telegram_token" placeholder="Telegram Bot Token" minlength="3" maxlength="250" required>{{ $setting->telegram_token }}</textarea>
                                                            @error('telegram_token')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="telegram_bot_name">Telegram Bot User Name</label>
                                                            <textarea class="form-control mb-3 maxlength @error('telegram_bot_name') is-invalid @enderror" name="telegram_bot_name"
                                                                id="telegram_bot_name" placeholder="Telegram Bot User Name" minlength="3" maxlength="250" required>{{ $setting->telegram_bot_name }}</textarea>
                                                            @error('telegram_bot_name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="telegram_group_id">Telegram Group ID</label>
                                                            <input type="text"
                                                                class="form-control mb-3 maxlength @error('telegram_group_id') is-invalid @enderror"
                                                                name="telegram_group_id" id="telegram_group_id"
                                                                placeholder="Telegram Group ID"
                                                                value="{{ $setting->telegram_group_id }}" minlength="3"
                                                                maxlength="100" required>
                                                            @error('telegram_group_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-1 ms-auto">
                                                        <div class="form-group text-start">
                                                            <button type="button" id="unset"
                                                                class="btn btn-danger me-2 mb-2">
                                                                <i class="fas fa-unlink me-1 bs-tooltip"
                                                                    title="Unset"></i>Unset
                                                            </button>
                                                            <button type="button" id="set"
                                                                class="btn btn-secondary me-2 mb-2">
                                                                <i class="fas fa-link me-1 bs-tooltip"
                                                                    title="Set"></i>Set
                                                            </button>
                                                            <button type="button" id="info"
                                                                class="btn btn-info me-2 mb-2">
                                                                <i class="fas fa-info me-1 bs-tooltip"
                                                                    title="Info"></i>Info
                                                            </button>
                                                            <button type="submit" class="btn btn-primary me-2 mb-2">
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

                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing" id="webhook_info">
                    <form class="section general-info">
                        <div class="info">
                            <h6 class="">Webhook Info</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class=" col-lg-12 col-md-12 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="url">
                                                                <i class="fas fa-external-link-alt me-1 bs-tooltip"
                                                                    title="Url"></i>UrlWebhook
                                                            </label>
                                                            <textarea class="form-control mb-3" id="url" placeholder="Url Webhook"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="url">
                                                                <i class="fas fa-clock me-1 bs-tooltip"
                                                                    title="Pending Update Count"></i>Pending Update Count :
                                                            </label>
                                                            <input type="text" class="form-control mb-3"
                                                                id="pending_update" placeholder="Pending Update Count">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="bs-tooltip" for="custom_certificate"
                                                            title="Custom Certificate"></label>
                                                        <div class="form-check ps-0">
                                                            <div
                                                                class="switch form-switch-custom switch-inline form-switch-primary mt-4">
                                                                <input class="switch-input" type="checkbox"
                                                                    role="switch" id="custom_certificate" checked>
                                                                <label class="switch-label"
                                                                    for="custom_certificate">Custom
                                                                    Certificate</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-1 ms-auto">
                                                        <div class="form-group text-start">
                                                            <button type="button" id="close"
                                                                class="btn btn-secondary">
                                                                <i class="fas fa-times me-2 bs-tooltip"
                                                                    title="Close"></i>Close
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
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        $(document).ready(function() {

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
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
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

                            if (res.data.result.pending_update_count == true) {
                                $('#custom_certificate').prop('checked', true).change();
                            } else {
                                $('#custom_certificate').prop('checked', false).change();
                            }
                        } else {
                            Swal.fire(
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

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $('#form_info').submit(function(event) {
                event.preventDefault();
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
                },
                submitHandler: function(form) {
                    block();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Accept': 'application/json'
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('setting.telegram.update') }}",
                        data: $(form).serialize(),
                        beforeSend: function() {
                            block();
                        },
                        success: function(res) {
                            unblock();
                            Swal.fire(
                                'Success!',
                                res.message,
                                'success'
                            )
                        },
                        error: function(xhr, status, error) {
                            unblock();
                            handleResponse(xhr)
                        }
                    });
                }
            });

        });
    </script>
@endpush
