@extends('layouts.backend.template', ['title' => 'Setting Company'])

@push('css')
    <link href="{{ asset('backend/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />

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
                            <button class="nav-link" id="animated-underline-home-tab"
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
                            <button class="nav-link active" id="animated-underline-database-tab"
                                onclick="redirect('{{ route('database.index') }}')">
                                <i data-feather="database"></i> Database
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form id="info" class="section general-info" action="" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="info">
                            <h6 class="">Backup Database</h6>
                            <div class="row">
                                <div class=" col-lg-12 col-md-12 mt-md-0 mt-4">
                                    <table id="tableData" class="table dt-table-hover table-hover"
                                        style="width:100%; cursor: pointer;">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
    <script src="{{ asset('backend/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script src="{{ asset('backend/src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/select2/custom-select2.js') }}"></script>

    <!-- InputMask -->
    {{-- <script src="{{ asset('backend/src/plugins/src/input-mask/jquery.inputmask.bundle.min.js') }}"></script> --}}

    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        // $(document).ready(function() {

        $('.maxlength').maxlength({
            alwaysShow: true,
            placement: "top",
        });

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            rowId: 'id',
            ajax: {
                url: "{{ route('database.index') }}",
                error: function(jqXHR, textStatus, errorThrown) {
                    handleResponseCode(jqXHR, textStatus, errorThrown)
                },
            },
            columnDefs: [{
                defaultContent: '',
                targets: "_all"
            }],
            buttons: [],
            dom: dom,
            stripeClasses: [],
            lengthMenu: length_menu,
            pageLength: 10,
            oLanguage: o_lang,
            columns: [{
                title: 'Name',
                data: 'name',
            }, {
                title: 'Size',
                data: 'size',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return formatBytes(data)
                    } else {
                        return data
                    }
                }
            }, {
                title: 'Modified',
                data: 'modified_at',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return convertUnixTimestampToTime(data)
                    } else {
                        return data
                    }
                }
            }, {
                title: 'Action',
                orderable: false,
                data: 'name',
                className: "text-center",
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `
                        <button type="button" id="download" class="btn btn-sm btn-primary"><i class="fas fa-download"></i></button>
                        <button type="button" id="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        `
                    } else {
                        return data
                    }
                }
            }, ],
            drawCallback: function(settings) {
                feather.replace();
                tooltip()
            },
            initComplete: function() {
                feather.replace();
            }
        });

        var btn_element = `<div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                        <i data-feather="chevron-down"></i> 
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li><button id="btn_add" type="button" class="dropdown-item bs-tooltip" title="Add Data">Create Backup File</button></li>
                        <li><button id="btn_delete" type="button" class="dropdown-item bs-tooltip" title="Delete Selected Data">Delete All File</button></li>
                    </ul>
                </div>`


        $("div.toolbar").html(btn_element);

        $('#btn_add').click(function() {
            ajax_backup('POST', "{{ route('database.store') }}")
        })

        $('#btn_delete').click(function() {
            ajax_backup('DELETE', "{{ route('database.destroy.batch') }}")
        })

        $('#tableData tbody').on('click', '#delete', function() {
            $('#formEdit .error.invalid-feedback').each(function(i) {
                $(this).hide();
            });
            $('#formEdit input.is-invalid').each(function(i) {
                $(this).removeClass('is-invalid');
            });
            let row = $(this).parents('tr')[0];
            file = table.row(row).data()
            delete_file(file.name)
        });

        $('#tableData tbody').on('click', '#download', function() {
            $('#formEdit .error.invalid-feedback').each(function(i) {
                $(this).hide();
            });
            $('#formEdit input.is-invalid').each(function(i) {
                $(this).removeClass('is-invalid');
            });
            let row = $(this).parents('tr')[0];
            file = table.row(row).data()
            download(file.name)
        });

        function download(file_name) {
            window.open("{{ route('database.download', '') }}/" + file_name, '_blank')
        }

        function delete_file(file_name) {

            Swal.fire({
                title: 'Are you sure?',
                text: "Delete file Backup?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                confirmButtonAriaLabel: 'Thumbs up, Yes!',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                cancelButtonAriaLabel: 'Thumbs down',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                padding: '2em',
                customClass: 'animated tada',
                showClass: {
                    popup: `animated tada`
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    ajax_setup()
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('database.destroy', '') }}/" + file_name,
                        data: {
                            _method: 'DELETE'
                        },
                        beforeSend: function() {
                            block();
                            $('#form .error.invalid-feedback').each(function(i) {
                                $(this).hide();
                            });
                            $('#form input.is-invalid').each(function(i) {
                                $(this).removeClass('is-invalid');
                            });
                        },
                        success: function(res) {
                            unblock();
                            table.ajax.reload();
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
            })

        }

        function ajax_backup(type, url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Create new Backup?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                confirmButtonAriaLabel: 'Thumbs up, Yes!',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                cancelButtonAriaLabel: 'Thumbs down',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                padding: '2em',
                customClass: 'animated tada',
                showClass: {
                    popup: `animated tada`
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    ajax_setup()
                    $.ajax({
                        type: type,
                        url: url,
                        data: {},
                        beforeSend: function() {
                            block();
                            $('#form .error.invalid-feedback').each(function(i) {
                                $(this).hide();
                            });
                            $('#form input.is-invalid').each(function(i) {
                                $(this).removeClass('is-invalid');
                            });
                        },
                        success: function(res) {
                            unblock();
                            table.ajax.reload();
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
            })
        }

        // });
    </script>
@endpush
