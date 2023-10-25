@extends('layouts.template')

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/table/datatable/custom_dt_html5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/table/datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="" id="formSelected">
                        <table id="tableData" class="table table-bordered" style="width: 100%;cursor: pointer;">
                            <thead>
                                <tr>
                                    <th class="dt-no-sorting" style="width: 30px;">Id</th>
                                    <th>Username</th>
                                    <th>Server</th>
                                    <th>Dst</th>
                                    <th>To</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus mr-1" data-toggle="tooltip"
                            title="Add Data"></i>Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row mb-2">
                            <div class="form-group col-md-12">
                                <label for="vpn"><i class="fas fa-network-wired mr-1" data-toggle="tooltip"
                                        title="Option Vpn"></i>Vpn :</label>
                                <select name="vpn" id="vpn" class="form-control" style="width: 100%;" required>
                                    <option value="">Please Select Vpn</option>
                                </select>
                                <span id="err_vpn" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <div class="form-group col-md-4">
                                <label for="dst"><i class="fas fa-random mr-1" data-toggle="tooltip"
                                        title="Dst Port"></i>Dst Port :</label>
                                <input type="number" name="dst" class="form-control" id="dst"
                                    placeholder="Please Enter Dst" required>
                                <span id="err_dst" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="to"><i class="fas fa-arrows-alt mr-1" data-toggle="tooltip"
                                        title="To Port"></i>To Port :</label>
                                <input type="number" name="to" class="form-control" id="to"
                                    placeholder="Please Enter To" required>
                                <span id="err_to" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sync"><i class="fas fa-check mr-1" data-toggle="tooltip"
                                        title="Option Active"></i>Sync :</label>
                                <select name="sync" id="sync" class="form-control" style="width: 100%;"
                                    required>
                                    <option value="">Select Sync</option>
                                    <option value="yes">yes</option>
                                    <option value="no">no</option>
                                </select>
                                <span id="err_sync" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"
                            data-toggle="tooltip" title="Close"></i>Close</button>
                    <button type="reset" id="reset" class="btn btn-warning"><i class="fas fa-undo mr-1"
                            data-toggle="tooltip" title="Reset"></i>Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                            data-toggle="tooltip" title="Save"></i>Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal animated fade fadeInDown" id="modalEdit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleEdit"><i class="fas fa-edit mr-1" data-toggle="tooltip"
                            title="Edit Data"></i>Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        title="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        <div class="form-row mb-2">
                            <div class="form-group col-md-12">
                                <label for="edit_vpn"><i class="fas fa-network-wired mr-1" data-toggle="tooltip"
                                        title="Option Vpn"></i>Vpn :</label>
                                <select name="vpn" id="edit_vpn" class="form-control" style="width: 100%;" required
                                    disabled>
                                    <option value="">Please Select Vpn</option>
                                </select>
                                <span id="err_edit_vpn" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <div class="form-group col-md-4">
                                <label for="edit_dst"><i class="fas fa-random mr-1" data-toggle="tooltip"
                                        title="Dst Port"></i>Dst Port :</label>
                                <input type="number" name="dst" class="form-control" id="edit_dst"
                                    placeholder="Please Enter Dst" required>
                                <span id="err_edit_dst" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="edit_to"><i class="fas fa-arrows-alt mr-1" data-toggle="tooltip"
                                        title="To Port"></i>To Port :</label>
                                <input type="number" name="to" class="form-control" id="edit_to"
                                    placeholder="Please Enter To" required>
                                <span id="err_edit_to" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="edit_sync"><i class="fas fa-check mr-1" data-toggle="tooltip"
                                        title="Option Active"></i>Sync :</label>
                                <select name="sync" id="edit_sync" class="form-control" style="width: 100%;"
                                    required>
                                    <option value="">Select Sync</option>
                                    <option value="yes">yes</option>
                                    <option value="no">no</option>
                                </select>
                                <span id="err_edit_sync" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"
                            data-toggle="tooltip" title="Close"></i>Close</button>
                    <button type="button" id="edit_reset" class="btn btn-warning"><i class="fas fa-undo mr-1"
                            data-toggle="tooltip" title="Reset"></i>Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                            data-toggle="tooltip" title="Save"></i>Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('plugins/table/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/table/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $("#vpn").select2({
                dropdownParent: $("#modalAdd"),
                ajax: {
                    delay: 1000,
                    url: "{{ route('vpn.index') }}",
                    data: function(params) {
                        return {
                            username: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.username,
                                    id: item.id,
                                    disabled: item.is_active == 'yes' ? false : true,
                                }
                            })
                        };
                    },
                }
            });

            $("#sync").select2({
                dropdownParent: $("#modalAdd"),
            });

            $("#edit_sync").select2({
                dropdownParent: $("#modalEdit"),
            });

            $("#edit_vpn").select2({
                dropdownParent: $("#modalEdit"),
                ajax: {
                    delay: 1000,
                    url: "{{ route('vpn.index') }}",
                    data: function(params) {
                        return {
                            username: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.username,
                                    id: item.id,
                                    disabled: item.is_active == 'yes' ? false : true,
                                }
                            })
                        };
                    },
                }
            });

            var table = $('#tableData').DataTable({
                processing: true,
                serverSide: true,
                rowId: 'id',
                ajax: {
                    url: "{{ route('port.index') }}",
                    error: function(jqXHR, textStatus, errorThrown) {
                        handleResponseCode(jqXHR, textStatus, errorThrown)
                    },
                },
                dom: "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                oLanguage: {
                    "oPaginate": {
                        "sPrevious": '<i data-feather="arrow-left"></i>',
                        "sNext": '<i data-feather="arrow-right"></i>'
                    },
                    // "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<i data-feather="search"></i>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                lengthMenu: [
                    [10, 50, 100, 500, 1000],
                    ['10 rows', '50 rows', '100 rows', '500 rows', '1000 rows']
                ],
                pageLength: 10,
                lengthChange: false,
                columnDefs: [{
                    defaultContent: '',
                    targets: "_all"
                }],
                columns: [{
                    title: 'Id',
                    "data": 'id',
                    width: "30px",
                    className: "",
                    orderable: !1,
                    render: function(e, a, t, n) {
                        return `<label class="new-control new-checkbox checkbox-outline-primary  m-auto">\n<input type="checkbox" name="id[]" value="${e}" class="new-control-input child-chk select-customers-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>`
                    }
                }, {
                    title: "Username",
                    data: 'vpn.username',
                }, {
                    title: "Server",
                    data: 'vpn.server.name',
                }, {
                    title: "Dst",
                    data: 'dst',
                }, {
                    title: "To",
                    data: 'to',
                }],
                buttons: [, {
                    text: '<i class="fa fa-plus"></i>Add',
                    className: 'btn btn-sm btn-primary bs-tooltip',
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Add Data'
                    },
                    action: function(e, dt, node, config) {
                        $('#modalAdd').modal('show');
                        $('#dst').focus();
                    }
                }, {
                    text: '<i class="fas fa-trash"></i>Del',
                    className: 'btn btn-sm btn-danger',
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Delete Selected Data'
                    },
                    action: function(e, dt, node, config) {
                        deleteData()
                    }
                }, {
                    extend: "colvis",
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Column Visible'
                    },
                    className: 'btn btn-sm btn-primary'
                }, {
                    extend: "pageLength",
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Page Length'
                    },
                    className: 'btn btn-sm btn-info'
                }],
                headerCallback: function(e, a, t, n, s) {
                    e.getElementsByTagName("th")[0].innerHTML =
                        '<label class="new-control new-checkbox checkbox-outline-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                },
                drawCallback: function(settings) {
                    feather.replace();
                },
                initComplete: function() {
                    $('#tableData').DataTable().buttons().container().appendTo(
                        '#tableData_wrapper .col-md-6:eq(0)');
                    feather.replace();
                }
            });
            multiCheck(table);

            var id;

            $('#edit_reset').click(function() {
                // id = $(this).val()
                edit(id, false)
            })

            $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
                $('#formEdit .error.invalid-feedback').each(function(i) {
                    $(this).hide();
                });
                $('#formEdit input.is-invalid').each(function(i) {
                    $(this).removeClass('is-invalid');
                });
                id = table.row(this).id()
                edit(id, true)
            });

            $('#formEdit').submit(function(event) {
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    let url = "{{ route('port.update', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: $(form).serialize(),
                        beforeSend: function() {
                            block();
                            $('#formEdit .error.invalid-feedback').each(function(i) {
                                $(this).hide();
                            });
                            $('#formEdit input.is-invalid').each(function(i) {
                                $(this).removeClass('is-invalid');
                            });
                        },
                        success: function(res) {
                            unblock();
                            table.ajax.reload();
                            $('#reset').click();
                            swal(
                                'Success!',
                                res.message,
                                'success'
                            )
                        },
                        error: function(xhr, status, error) {
                            unblock();
                            handleResponseForm(xhr)
                        }
                    });
                }
            });

            $('#reset').click(function() {
                $('#form .error.invalid-feedback').each(function(i) {
                    $(this).hide();
                });
                $('#form input.is-invalid').each(function(i) {
                    $(this).removeClass('is-invalid');
                });
                $('#vpn').val('').change();
                $('#server').val('').change();
            })

            $('#form').submit(function(event) {
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('port.store') }}",
                        data: $(form).serialize(),
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
                            $('#reset').click();
                            swal(
                                'Success!',
                                res.message,
                                'success'
                            )
                        },
                        error: function(xhr, status, error) {
                            unblock();
                            handleResponseForm(xhr)
                        }
                    });
                }
            });

            function edit(id, show = false) {

                $.ajax({
                    url: "{{ route('port.show', '') }}/" + id,
                    method: 'GET',
                    success: function(result) {
                        unblock();
                        $('#edit_reset').val(result.data.id);
                        $('#edit_dst').val(result.data.dst);
                        $('#edit_to').val(result.data.to);
                        let option1 = new Option(result.data.vpn.username, result.data.vpn_id,
                            true, true);
                        $('#edit_vpn').append(option1).trigger('change');
                        if (show) {
                            $('#modalEdit').modal('show');
                        }
                    },
                    beforeSend: function() {
                        block();
                    },
                    error: function(xhr, status, error) {
                        unblock();
                        handleResponse(xhr)
                    }
                });
            }

            function deleteData() {
                if (selected()) {
                    swal({
                        title: 'Delete Selected Data?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                        confirmButtonAriaLabel: 'Thumbs up, Yes!',
                        cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                        cancelButtonAriaLabel: 'Thumbs down',
                        padding: '2em',
                        animation: false,
                        customClass: 'animated tada',
                    }).then(function(result) {
                        if (result.value) {
                            let form = $("#formSelected");
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: 'DELETE',
                                url: "{{ route('port.destroy.batch') }}",
                                data: $(form).serialize(),
                                beforeSend: function() {
                                    block();
                                },
                                success: function(res) {
                                    unblock();
                                    table.ajax.reload();
                                    swal(
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
            }

        });
    </script>
@endpush
