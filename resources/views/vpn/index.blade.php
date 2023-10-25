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

    <link href="{{ asset('assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="row layout-top-spacing layout-spacing pb-0">
        <div class="col-md-4">
            <select class="form-control" name="status" id="select_status">
                <option value="">All</option>
                <option value="yes">Active</option>
                <option value="no">Nonactive</option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" name="trial" id="select_trial">
                <option value="">All</option>
                <option value="yes">Trial</option>
                <option value="no">Paid</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" name="search_port" id="search_port" min="0"
                placeholder="DST Port">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-block btn-primary" id="btn_filter">
                <i class="fas fa-filter mr-1"></i>Filter
            </button>
        </div>
    </div>

    <div class="row layout-top-spacing layout-spacing pt-0">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="" id="formSelected">
                        <table id="tableData" class="table table-bordered" style="width: 100%;cursor: pointer;">
                            <thead>
                                <tr>
                                    <th class="dt-no-sorting" style="width: 30px;">Id</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Server</th>
                                    <th>IP</th>
                                    <th>Expired</th>
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

    @include('vpn.modal')
@endsection

@push('jslib')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('plugins/table/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/table/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


    <script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

    <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>

    <script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        var f1 = flatpickr(document.getElementById('regist'), {
            defaultDate: "today",
            disableMobile: true
        });

        var f2 = flatpickr(document.getElementById('edit_regist'), {
            disableMobile: true
        });

        var clipboard = new Clipboard('.clipboard');

        function share(data) {
            let text;
            text = `============================\n`;
            text += `Detail Of VPN : ${data.username}\n`;
            text += `============================\n`;
            text += `Username : ${data.username}\n`;
            text += `Password : ${data.password}\n`;
            text += `IP       : ${data.ip}\n`;
            text += `------------------------------------------------\n`;
            text += `Server Name    : ${data.server.name}\n`;
            text += `Server Domain  : ${data.server.domain}\n`;
            text += `Server IP      : ${data.server.ip}\n`;
            text += `------------------------------------------------\n`;
            text += `Created At : ${moment.utc(data.created_at, "YYYY-MM-DD\THH:mm:ss\Z").format('DD MMM YYYY')}\n`;
            text +=
                `Status     : ${(data.is_active == 1 && data.masa == 0) ? 'Trial' : (data.is_active == 1 && data.masa > 0) ? 'Active': 'Nonactive' }\n`;
            text += `Expired    : ${moment(data.expired).format('DD MMM YYYY')}\n`;
            text += `------------------------------------------------\n`;
            for (let i = 0; i < data.port.length; i++) {
                text += `Port ${data.port[i].to} <=> ${data.server.domain}:${data.port[i].dst}\n`;
            }
            text += `------------------------------------------------\n`;
            text += `Tgl         : ${moment().format('DD MMM YYYY HH:mm:ss')}\n`;
            text += `Generate By : {{ auth()->user()->name }}\n`;
            text += `------------------------------------------------\n`;
            text += `CS          : 082324129752\n`;
            text += `Web         : https://kacangan.net\n`;
            text += `Member Area : https://member.kacangan.net\n`;
            text += `Tutorial    : https://blog.kacangan.net\n`;
            text += `------------------------------------------------\n`;
            text += `Terima Kasih Telah Menggunakan Layanan Kami\n`;
            text += `============================\n`;
            return text;
        }

        $(document).ready(function() {

            $('[data-mask]').inputmask();

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $("#email").select2({
                dropdownParent: $("#modalAdd"),
                ajax: {
                    delay: 1000,
                    url: "{{ route('user.index') }}",
                    data: function(params) {
                        return {
                            email: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.email,
                                    id: item.id,
                                    disabled: item.email_verified_at == null ? true : false,
                                }
                            })
                        };
                    },
                }
            });

            $("#server").select2({
                dropdownParent: $("#modalAdd"),
                ajax: {
                    delay: 1000,
                    url: "{{ route('server.index') }}",
                    data: function(params) {
                        return {
                            name: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                    disabled: item.is_active == 'no' ? true : false,
                                }
                            })
                        };
                    },
                }
            });

            $("#masa, #is_active, #sync").select2({
                dropdownParent: $("#modalAdd"),
            });

            $("#edit_email").select2({
                dropdownParent: $("#modalEdit"),
                ajax: {
                    delay: 1000,
                    url: "{{ route('user.index') }}",
                    data: function(params) {
                        return {
                            email: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.email,
                                    id: item.id,
                                    disabled: item.email_verified_at == null ? true : false,
                                }
                            })
                        };
                    },
                }
            });

            $("#edit_server").select2({
                dropdownParent: $("#modalEdit"),
                ajax: {
                    delay: 1000,
                    url: "{{ route('server.index') }}",
                    data: function(params) {
                        return {
                            name: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                    disabled: item.is_active == 'no' ? true : false,
                                }
                            })
                        };
                    },
                }
            });

            $("#edit_masa, #edit_is_active, #edit_sync").select2({
                dropdownParent: $("#modalEdit"),
            });

            // $("#select_script").select2({
            //     dropdownParent: $("#modalEdit"),
            // });

            $('#border-home-tab').click(function() {
                $('#edit_reset').click()
            })

            $('#btn_filter').click(function() {
                table.ajax.url("{{ route('vpn.index') }}?status=" + $('#select_status').val() + '&dst=' +
                    $('#search_port').val() + '&trial=' +
                    $('#select_trial').val()).load();
            })


            var table = $('#tableData').DataTable({
                processing: true,
                serverSide: true,
                rowId: 'id',
                ajax: {
                    url: "{{ route('vpn.index') }}?status=" + $('#select_status').val() + '&trial=' + $(
                        '#select_trial').val() + '&dst=' + $('#search_port').val(),
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
                    data: 'id',
                    width: "30px",
                    className: "",
                    orderable: false,
                    render: function(e, a, t, n) {
                        return `<label class="new-control new-checkbox checkbox-outline-primary  m-auto">\n<input type="checkbox" name="id[]" value="${e}" class="new-control-input child-chk select-customers-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>`
                    }
                }, {
                    title: "Email",
                    data: 'user.email',
                    visible: false,
                }, {
                    title: "Username",
                    data: 'username',
                    render: function(data, type, row, meta) {
                        if (row.is_active === 'yes' && row.is_trial === 'yes') {
                            text =
                                `<i class="fas fa-circle text-warning" data-toggle="tooltip" title="Active Trial"></i> ${data}`;
                        } else if (row.is_active === 'yes' && row.is_trial === 'no') {
                            text =
                                `<i class="fas fa-circle text-success" data-toggle="tooltip" title="Active"></i> ${data}`;
                        } else {
                            text =
                                `<i class="fas fa-circle text-danger" data-toggle="tooltip" title="Nonactive"></i> ${data}`;
                        }
                        if (type === 'display') {
                            return text
                        } else {
                            return data
                        }
                    }
                }, {
                    title: "password",
                    data: 'password',
                    visible: false,
                }, {
                    title: "Server",
                    data: 'server.name',
                }, {
                    title: "IP",
                    data: 'ip',
                }, {
                    title: "Expired",
                    data: 'expired',
                }, ],
                buttons: [{
                    text: '<i class="fas fa-plus-circle"></i>Add',
                    className: 'btn btn-sm btn-primary bs-tooltip',
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Add Data'
                    },
                    action: function(e, dt, node, config) {
                        $('#modalAdd').modal('show');
                        $('#username').focus();
                    }
                }, {
                    text: '<i class="fas fa-trash"></i>Del',
                    className: 'btn btn-sm btn-danger',
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Delete Selected Data',
                        'id': 'btndel'
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

            $('#share').click(function() {
                id = $(this).val();
                $.ajax({
                    url: "{{ route('vpn.show', '') }}/" + id,
                    method: 'GET',
                    success: function(result) {
                        unblock();
                        let text = share(result.data);
                        if (navigator.share) {
                            navigator.share({
                                title: result.data.username,
                                text: text,
                            }).then(() => {
                                swal(
                                    'Success!',
                                    'Thanks For Sharing!',
                                    'success'
                                )
                            }).catch(err => {
                                swal(
                                    'Failed!',
                                    "Error while using Web share API:",
                                    'error'
                                )
                                console.log("Error while using Web share API:");
                                console.log(err);
                            });
                        } else {
                            swal(
                                'Failed!',
                                "Browser doesn't support this API !",
                                'error'
                            )
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
            })

            $('#wa').click(function() {
                // id = $(this).val();
                $.ajax({
                    url: "{{ route('vpn.show', '') }}/" + id,
                    method: 'GET',
                    success: function(result) {
                        unblock();
                        let text = share(result.data);
                        var win = window.open('https://api.whatsapp.com/send/?phone=&text=' +
                            encodeURIComponent(text), '_blank');
                        win.focus();
                    },
                    beforeSend: function() {
                        block();
                    },
                    error: function(xhr, status, error) {
                        unblock();
                        er = xhr.responseJSON.errors
                        swal(
                            'Failed!',
                            'Server Error',
                            'error'
                        )
                    }
                });
            })

            $('#edit_reset').click(function() {
                // id = $(this).val();
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
                    let url = "{{ route('vpn.update', ':id') }}";
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
                $('#email, #server, #masa, #is_active, #sync').val('').change();
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
                        url: "{{ route('vpn.store') }}",
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
                    url: "{{ route('vpn.show', '') }}/" + id,
                    method: 'GET',
                    success: function(result) {
                        unblock();
                        $('#edit_reset').val(result.data.id);
                        $('#share').val(result.data.id);
                        $('#wa').val(result.data.id);
                        $('#download').val(result.data.id);
                        $('#edit_username').val(result.data.username);
                        $('#edit_password').val(result.data.password);
                        $('#edit_ip').val(result.data.ip);
                        f2.setDate(result.data.regist);
                        let option1 = new Option(result.data.user.email, result.data.user_id,
                            true, true);
                        let option2 = new Option(result.data.server.name, result.data.server_id,
                            true, true);
                        $('#edit_email').append(option1).trigger('change');
                        $('#edit_server').append(option2).trigger('change');
                        $('#edit_masa').val(result.data.masa).change();
                        $('#edit_is_active').val(result.data.is_active).change();
                        $('#edit_sync').val('').change();

                        $('#detail_server_name').html(result.data.server.name);
                        $('#detail_server_ip').html(result.data.server.ip);
                        $('#detail_server_domain').html(result.data.server.domain);
                        $('#detail_server_netwatch').html(result.data.server.netwatch);
                        if (result.data.server.type === 'paid') {
                            $('#detail_server_type').html(
                                `<span class="badge badge-success">Paid</span>`);
                        } else {
                            $('#detail_server_type').html(
                                `<span class="badge badge-danger">Free</span>`);
                        }

                        $('#detail_acc_username').html(result.data.username);
                        $('#detail_acc_password').html(result.data.password);
                        $('#detail_acc_ip').html(result.data.ip);
                        let create = moment.utc(result.data.created_at,
                            "YYYY-MM-DD\THH:mm:ss\Z").format('DD MMM YYYY');
                        let expired = moment(result.data.expired).format('DD MMM YYYY');
                        $('#detail_acc_create').html(create);
                        $('#detail_acc_expired').html(expired);

                        let status = $('#account_status');
                        if (result.data.is_active == 'yes' && result.data.is_trial === 'no') {
                            status.html('<span class="badge badge-success">Active</span>')
                        } else if (result.data.is_active == 'yes' && result.data.is_trial === 'yes') {
                            status.html('<span class="badge badge-warning">Trial</span>')
                        } else {
                            status.html('<span class="badge badge-danger">Nonactive</span>')
                        }

                        $('#table_port').html('');
                        if (result.data.port.length > 0) {
                            let a;
                            for (let i = 0; i < result.data.port.length; i++) {
                                a += `<tr><td>`;
                                a +=
                                    `<span class="badge badge-success clipboard" data-toggle="tooltip" id="detail_port_${i}" title="Click to copy!" data-clipboard-action="copy" data-clipboard-target="#detail_port_${i}">${result.data.server.domain}:${result.data.port[i].dst}</span><i class="fas fa-exchange-alt ml-1 mr-1"></i><span class="badge badge-info">${result.data.port[i].to}</span>`;
                                a += `</td></tr>`;
                            }
                            $('#table_port').html(a);
                        }
                        var select_script = $('#select_script');
                        var script = $('#script');
                        select_script.val('').change();
                        select_script.change(function() {
                            let type = $(this).val();
                            if (type == 'PPTP') {
                                script.val(
                                    `/interface pptp-client add connect-to="${result.data.server.domain}" name="${result.data.server.name}:${result.data.username}" user="${result.data.username}" password="${result.data.password}" disabled="no" comment="<<==${result.data.server.domain}==>"; /tool netwatch add host="${result.data.server.netwatch}" comment="<<==${result.data.server.domain}==>"`
                                );
                            } else if (type == 'L2TP') {
                                script.val(
                                    `/interface l2tp-client add connect-to="${result.data.server.domain}" name="${result.data.server.name}:${result.data.username}" user="${result.data.username}" password="${result.data.password}" disabled="no" comment="<<==${result.data.server.domain}==>"; /tool netwatch add host="${result.data.server.netwatch}" comment="<<==${result.data.server.domain}==>"`
                                );
                            } else if (type == 'SSTP') {
                                script.val(
                                    `/interface sstp-client add connect-to="${result.data.server.domain}" name="${result.data.server.name}:${result.data.username}" user="${result.data.username}" password="${result.data.password}" disabled="no" comment="<<==${result.data.server.domain}==>"; /tool netwatch add host="${result.data.server.netwatch}" comment="<<==${result.data.server.domain}==>"`
                                );
                            } else if (type == 'OVPN') {
                                script.val(
                                    `/interface ovpn-client add connect-to="${result.data.server.domain}" name="${result.data.server.name}:${result.data.username}" user="${result.data.username}" password="${result.data.password}" disabled="no" comment="<<==${result.data.server.domain}==>"; /tool netwatch add host="${result.data.server.netwatch}" comment="<<==${result.data.server.domain}==>"`
                                );
                            } else {
                                script.val('');
                            }
                        })

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
                                url: "{{ route('vpn.destroy', '') }}",
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
