@extends('layouts.backend.template', ['title' => 'Data Vpn'])
@push('csslib')
    <link href="{{ asset('backend/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/forms/switches.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/forms/switches.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/src/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
        type="text/css">

    <link href="{{ asset('backend/src/plugins/css/light/clipboard/custom-clipboard.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/plugins/css/dark/clipboard/custom-clipboard.css') }}" rel="stylesheet"
        type="text/css">

    <link href="{{ asset('backend/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/components/accordions.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/components/accordions.css') }}" rel="stylesheet" type="text/css">
@endpush
@push('css')
    <style>
        .flatpickr-calendar {
            z-index: 1056 !important;
        }

        .tba {
            width: 35%;
            word-wrap: break-word;
            white-space: normal;
            text-align: left;
        }

        .tbb {
            width: 65%;
            word-wrap: break-word;
            white-space: normal;
            text-align: left;
        }

        .tbb::before {
            content: ": ";
        }
    </style>
@endpush
@section('content')
    <div class="row" id="cancel-row">

        <div class="row layout-top-spacing layout-spacing pb-0" id="card_filter">
            <div class="col-md-4">
                <select class="form-control select2" name="status" id="select_status">
                    <option value="">All</option>
                    <option value="yes">Active</option>
                    <option value="no">Nonactive</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control select2" name="trial" id="select_trial">
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
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_table">
            <div class="widget-content widget-content-area br-8">
                <form action="" id="formSelected">
                    <table id="tableData" class="table dt-table-hover table-hover" style="width:100%; cursor: pointer;">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        @include('vpn.detail')

        @include('vpn.create')

        @include('vpn.modal')

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
    <script src="{{ asset('backend/src/plugins/src/input-mask/jquery.inputmask.bundle.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/moment/moment-with-locales.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/clipboard/clipboard.min.js') }}"></script>
@endpush


@push('js')
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        $('.close-detail').click(function() {
            hide_card_detail()
        })

        $('.close-add').click(function() {
            hide_card_add()
        })

        $('#send_email').click(function() {
            $('#modalSendEmail').modal('show')
        })

        $('#modalSendEmail').on('shown.bs.modal', function() {
            $('input[name="email"]').focus();
        });

        $('#form_send_email').submit(function(event) {
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
                ajax_setup()
                $.ajax({
                    type: 'POST',
                    url: "{{ url('vpn') }}/" + id + '/send-email',
                    data: $(form).serialize(),
                    beforeSend: function() {
                        block();
                        clear_validate($(form))
                    },
                    success: function(res) {
                        unblock();
                        table.ajax.reload();
                        reset();
                        Swal.fire(
                            'Success!',
                            res.message,
                            'success'
                        )
                    },
                    error: function(xhr, status, error) {
                        unblock();
                        handleResponseForm(xhr, 'add')
                        Swal.fire(
                            'Failed!',
                            xhr.responseJSON.message,
                            'error'
                        )
                    }
                });
            }
        });

        $('#analyze').click(function() {
            $.ajax({
                url: "{{ url('vpn') }}/" + id + '/analyze',
                method: 'GET',
                success: function(result) {
                    unblock();
                    // $('#share').val(result.data.id);
                    console.log(result);
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

        $('#download').click(function() {
            window.open("{{ url('vpn') }}/" + id + '/download', '_blank')
        })

        // $(document).ready(function() {
        var f1 = flatpickr(document.getElementById('expired'), {
            defaultDate: "today",
            disableMobile: true,
        });

        var f2 = flatpickr(document.getElementById('edit_expired'), {
            disableMobile: true,
        });

        var clipboard = new ClipboardJS('.clipboard');

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

        // $(document).ready(function() {

        $('.select2').select2()

        $('[data-mask]').inputmask();
        var perpage = 20;
        $("#email, #edit_email").select2({
            ajax: {
                delay: 1000,
                url: "{{ route('user.paginate') }}",
                data: function(params) {
                    return {
                        email: params.term || '',
                        page: params.page || 1,
                        perpage: perpage,
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.email,
                                id: item.id,
                                disabled: item.email_verified_at == null ? true : false,
                            }
                        }),
                        pagination: {
                            more: (params.page * perpage) < data.total
                        }
                    };
                },
            }
        });

        $("#server").select2({
            ajax: {
                delay: 1000,
                url: "{{ route('server.paginate') }}",
                data: function(params) {
                    return {
                        name: params.term,
                        page: params.page || 1,
                        perpage: perpage,
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.name,
                                id: item.id,
                                disabled: item.is_active == 'no' ? true : false,
                            }
                        }),
                        pagination: {
                            more: (params.page * perpage) < data.total
                        }
                    };
                },
            }
        });

        $('#home-tab-icon, #profile-tab-icon').click(function() {
            $('#edit_reset').click()
        })

        $('#btn_filter').click(function() {
            table.ajax.reload()
        })

        $('.maxlength').maxlength({
            alwaysShow: true,
            placement: "top",
        });

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            rowId: 'id',
            ajax: {
                url: "{{ route('vpn.index') }}",
                data: function(d) {
                    d.status = $('#select_status').val();
                    d.trial = $('#select_trial').val();
                    d.dst = $('#search_port').val();
                },
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
                width: "30px",
                title: 'Id',
                data: 'id',
                className: "",
                orderable: !1,
                render: function(data, type, row, meta) {
                    return `
                    <div class="form-check form-check-primary d-block new-control">
                        <input class="form-check-input child-chk" type="checkbox" name="id[]" value="${data}" >
                    </div>`
                }
            }, {
                title: "User",
                data: 'user_id',
                render: function(data, type, row, meta) {
                    if (type == 'display' && data != null) {
                        return row.user.email
                    } else {
                        return data
                    }
                }
            }, {
                title: "Username",
                data: 'username',
                render: function(data, type, row, meta) {
                    if (row.is_active === 'yes' && row.is_trial === 'yes') {
                        text =
                            `<i class="fas fa-circle text-warning bs-tooltip" title="Active Trial"></i> ${data}`;
                    } else if (row.is_active === 'yes' && row.is_trial === 'no') {
                        text =
                            `<i class="fas fa-circle text-success bs-tooltip" title="Active"></i> ${data}`;
                    } else {
                        text =
                            `<i class="fas fa-circle text-danger bs-tooltip" title="Nonactive"></i> ${data}`;
                    }
                    if (type === 'display') {
                        return text
                    } else {
                        return data
                    }
                }
            }, {
                title: "Server",
                data: 'server.name',
            }, {
                title: "IP",
                data: 'ip',
            }, {
                title: "Expired",
                data: 'expired',
            }, {
                title: "Desc",
                data: 'desc',
            }, ],
            headerCallback: function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML = `
                <div class="form-check form-check-primary d-block new-control">
                    <input class="form-check-input chk-parent" type="checkbox" id="customer-all-info">
                </div>`
            },
            drawCallback: function(settings) {
                feather.replace();
                tooltip()
            },
            initComplete: function() {
                feather.replace();
            }
        });

        $("div.toolbar").html(btn_element);

        $('#btn_add').click(function() {
            show_card_add()
            input_focus('username')
        })

        $('#btn_delete').click(function() {
            delete_batch("{{ route('vpn.destroy.batch') }}")
        })

        multiCheck(table);

        var id;
        var url_post = "{{ route('vpn.store') }}";
        var url_put = "{{ route('vpn.update', '') }}/" + id;
        var url_delete = "{{ route('vpn.destroy', '') }}/" + id;

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
                            Swal.fire(
                                'Success!',
                                'Thanks For Sharing!',
                                'success'
                            )
                        }).catch(err => {
                            Swal.fire(
                                'Failed!',
                                "Error while using Web share API:",
                                'error'
                            )
                            console.log("Error while using Web share API:");
                            console.log(err);
                        });
                    } else {
                        Swal.fire(
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
                    Swal.fire(
                        'Failed!',
                        'Server Error',
                        'error'
                    )
                }
            });
        })

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            edit(true)
            url_put = "{{ route('vpn.update', '') }}/" + id;
            url_delete = "{{ route('vpn.destroy', '') }}/" + id;
            id = table.row(this).id()
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: "{{ route('vpn.show', '') }}/" + id,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#share').val(result.data.id);
                    $('#wa').val(result.data.id);
                    $('#download').val(result.data.id);
                    $('#edit_username').val(result.data.username);
                    $('#edit_password').val(result.data.password);
                    $('#edit_ip').val(result.data.ip);
                    $('#edit_ip').val(result.data.ip);
                    $('#edit_desc').val(result.data.desc);

                    f2.setDate(result.data.expired);
                    if (result.data.user_id == null) {
                        $('#edit_email').val('').trigger('change');
                        $('#input_send_email').val('')
                    } else {
                        $('#input_send_email').val(result.data.user.email)
                        let option1 = new Option(result.data.user.email, result.data.user_id,
                            true, true);
                        $('#edit_email').append(option1).trigger('change');
                    }
                    if (result.data.server_id == null) {
                        $('#edit_server').val('').trigger('change');
                    } else {
                        let option2 = new Option(result.data.server.name, result.data.server_id,
                            true, true);
                        $('#edit_server').append(option2).trigger('change');
                    }

                    if (result.data.is_active == 'yes') {
                        $('#edit_is_active').prop('checked', true).change();
                    } else {
                        $('#edit_is_active').prop('checked', false).change();
                    }
                    $('#edit_sync').prop('checked', true).change();

                    $('#detail_server_name').html(result.data.server.name);
                    $('#detail_server_ip').html(result.data.server.ip);
                    $('#detail_server_domain').html(result.data.server.domain);
                    $('#detail_server_netwatch').html(result.data.server.netwatch);
                    if (result.data.server.is_active === 'yes') {
                        $('#detail_server_status').html(
                            `<span class="badge badge-success">Active</span>`);
                    } else {
                        $('#detail_server_status').html(
                            `<span class="badge badge-danger">Nonactive</span>`);
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
                        let a = '';
                        for (let i = 0; i < result.data.port.length; i++) {
                            a += '<li class="list-group-item border-0 pb-0">'
                            a +=
                                `<span class="badge badge-success clipboard bs-tooltip me-1" id="detail_port_${i}" title="Click to copy!" data-clipboard-action="copy" data-clipboard-target="#detail_port_${i}">${result.data.server.domain}:${result.data.port[i].dst}</span><i class="fas fa-exchange-alt ms-1 me-1"></i><span class="badge badge-info">${result.data.port[i].to}</span>`;
                            a += '</li>'
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
                    tooltip()
                    if (show) {
                        show_card_detail()
                        input_focus('username')
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

        // });
    </script>
@endpush
