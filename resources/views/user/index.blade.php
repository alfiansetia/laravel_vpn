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
    <link href="{{ asset('assets/css/apps/mailbox.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <form action="" id="formSelected">
                    <table id="tableData" class="table table-bordered" style="width: 100%;cursor: pointer;">
                        <thead>
                            <tr>
                                <th class="dt-no-sorting" style="width: 30px;">Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th class="text-center">Role</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    @include('user.modal')
@endsection

@push('jslib')
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
@endpush

@push('js')
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('#reset').click(function() {
                $('#gender').val('Male').change()
                $('#role').val('Admin').change()
            })

            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $("#gender, #role").select2({
                dropdownParent: $("#modalAdd"),
                tags: true,
                allowClear: true
            });

            $("#edit_gender, #edit_role").select2({
                dropdownParent: $("#modalEdit"),
                tags: true,
            });

            var table = $('#tableData').DataTable({
                processing: true,
                serverSide: true,
                rowId: 'id',
                ajax: {
                    url: "{{ route('user.index') }}",
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
                    targets: 0,
                    width: "30px",
                    className: "dt-no-sorting",
                    orderable: !1,
                }, {
                    targets: 5,
                    className: "text-center",
                }],
                columns: [{
                    title: 'Id',
                    data: 'id',
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<label class="new-control new-checkbox checkbox-outline-primary  m-auto">\n<input type="checkbox" name="id[]" value="${data}" class="new-control-input child-chk select-customers-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>`
                    }
                }, {
                    title: "Name",
                    data: 'name',
                    render: function(data, type, row, meta) {
                        if (row.email_verified_at != null) {
                            text =
                                `<i class="fas fa-circle text-success" data-toggle="tooltip" title="Active"></i> ${data}`;
                        } else {
                            text =
                                `<i class="fas fa-circle text-danger" data-toggle="tooltip" title="Nonactive"></i> ${data}`;
                        }
                        if (type == 'display') {
                            return text
                        } else {
                            return data
                        }
                    }
                }, {
                    title: "Email",
                    data: 'email',
                }, {
                    title: "Gender",
                    data: 'gender',
                }, {
                    title: "Phone",
                    data: 'phone',
                }, {
                    title: 'Role',
                    data: 'role',
                    render: function(data, type, row, meta) {
                        if (type == 'display') {
                            return `<span class="badge badge-${data == 'Admin' ? 'success' : 'danger'}">${data}</span>`
                        } else {
                            return data
                        }
                    }
                }, {
                    title: "Address",
                    data: 'address',
                }, ],
                buttons: [, {
                    text: '<i class="fa fa-plus"></i>Add',
                    className: 'btn btn-sm btn-primary bs-tooltip',
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Add Data'
                    },
                    action: function(e, dt, node, config) {
                        $('#modalAdd').modal('show');
                        $('#name').focus();
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
                // id = $(this).val();
                edit(id, false)
            })

            $('#edit_delete').click(function() {
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
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ route('user.destroy', '') }}/" + id,
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
                                $('#modalEdit').modal('hide')
                            },
                            error: function(xhr, status, error) {
                                unblock();
                                handleResponse(xhr)
                            }
                        });
                    }
                })
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
                    var formData1 = form;
                    let url = "{{ route('user.update', '') }}/" + id;
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: $(formData1).serialize(),
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
                $('#address').removeClass('is-invalid');
                $('#form input.is-invalid').each(function(i) {
                    $(this).removeClass('is-invalid');
                });
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
                    let formData = form;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('user.store') }}",
                        data: $(formData).serialize(),
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
                let url = "{{ route('user.show', '') }}/" + id;
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(result) {
                        unblock();
                        $('#edit_reset').val(result.data.id);
                        $('#edit_id').val(result.data.id);
                        $('#edit_name').val(result.data.name);
                        $('#edit_email').val(result.data.email);
                        $('#edit_gender').val(result.data.gender).change();
                        $('#edit_phone').val(result.data.phone);
                        $('#edit_address').val(result.data.address);
                        $('#edit_role').val(result.data.role).change();
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
                                url: "{{ route('user.destroy.batch') }}",
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
