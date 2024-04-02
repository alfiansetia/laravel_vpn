@extends('layouts.backend.template_mikapi', ['title' => 'Hotspot Host'])
@push('csslib')
    <link href="{{ asset('backend/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="row" id="cancel-row">
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

        @include('mikapi.hotspot.host.detail')

    </div>
@endsection
@push('jslib')
    <script src="{{ asset('backend/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endpush


@push('js')
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/func.js') }}"></script>
    <script src="{{ asset('js/mikapi.js') }}"></script>
    <script>
        // $(document).ready(function() {

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('api.mikapi.hotspot.hosts.index') }}",
                data: function(dt) {
                    dt.dt = 'on'
                    dt.router = "{{ request()->query('router') }}";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    handleResponse(jqXHR)
                },
            },
            columnDefs: [{
                defaultContent: '',
                targets: "_all"
            }],
            createdRow: function(row, data, dataIndex) {
                if (data.blocked == true) {
                    $('td', row).css('background-color', 'red');
                }
            },
            buttons: [],
            dom: dom,
            stripeClasses: [],
            lengthMenu: length_menu,
            pageLength: 10,
            oLanguage: o_lang,
            columns: [{
                width: "30px",
                title: 'Id',
                data: 'DT_RowId',
                className: "",
                orderable: !1,
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        let text = `<div class="form-check form-check-primary d-block new-control">
                        <input class="form-check-input child-chk" type="checkbox" name="id[]" value="${data}" >`
                        if (row.authorized) {
                            text +=
                                '<span class="badge me-1 badge-success" title="Authorized">A</span>'
                        }
                        if (row.bypassed) {
                            text +=
                                '<span class="badge me-1 badge-success" title="Bypassed">P</span>'
                        }
                        if (row.blocked) {
                            text += '<span class="badge me-1 badge-danger" title="Bloked">B</span>'
                        }
                        if (row.static) {
                            text += '<span class="badge me-1 badge-secondary" title="Static">S</span>'
                        }
                        if (row['DHCP']) {
                            text += '<span class="badge me-1 badge-secondary" title="DHCP">H</span>'
                        }
                        if (row.dynamic) {
                            text += '<span class="badge me-1 badge-secondary" title="Dynamic">D</span>'
                        }
                        text += `</div>`
                        return text
                    } else {
                        return data
                    }
                }
            }, {
                title: "Server",
                data: 'server',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `${data}`;
                    } else {
                        return data;
                    }

                }
            }, {
                title: "MAC",
                data: 'mac-address',
            }, {
                title: "Address",
                data: 'address',
            }, {
                title: "To Addr",
                data: 'to-address',
            }, {
                title: "Uptime",
                data: 'uptime',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return dtm(data);
                    } else {
                        return data;
                    }
                }
            }, {
                title: "Uptime",
                data: 'uptime',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return dtm(data);
                    } else {
                        return data;
                    }
                }
            }, {
                title: "IN",
                data: 'bytes-in',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return formatBytes(data);
                    } else {
                        return data;
                    }
                }
            }, {
                title: "OUT",
                data: 'bytes-out',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return formatBytes(data);
                    } else {
                        return data;
                    }
                }
            }, {
                title: "Comment",
                data: 'comment',
            }],
            headerCallback: function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML = `
                <div class="form-check form-check-primary d-block new-control">
                    <input class="form-check-input chk-parent" type="checkbox" id="customer-all-info">
                </div>`
            },
            drawCallback: function(settings) {
                feather.replace();
                // tooltip()
            },
            initComplete: function() {
                feather.replace();
            }
        });

        $("div.toolbar").html(btn_element_refresh);

        $('#btn_add').remove()
        $('#edit_save').remove()

        $('#btn_refresh').click(function() {
            table.ajax.reload()
        })

        $('#btn_delete').click(function() {
            delete_batch("{{ route('api.mikapi.hotspot.hosts.destroy.batch') }}" + param_router)
        })

        multiCheck(table);

        var id;
        var url_put = "{{ route('api.mikapi.hotspot.hosts.destroy.batch') }}/" + id + param_router;
        var url_delete = "{{ route('api.mikapi.hotspot.hosts.destroy', '') }}/" + id + param_router;

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            url_put = "{{ route('api.mikapi.hotspot.hosts.destroy.batch') }}/" + id + param_router;
            url_delete = "{{ route('api.mikapi.hotspot.hosts.destroy', '') }}/" + id + param_router;
            edit(true)
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: url_put,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#tbl_detail').empty()
                    Object.keys(result.data).forEach(function(key) {
                        $('#tbl_detail').append(`<tr>
                                <td style="width:30%">${key}</td>
                                <td style="width:2%">:</td>
                                <td style="width:68%">${result.data[key]}</td>
                            </tr>`)
                    });
                    if (show) {
                        show_card_detail()
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
