@extends('layouts.backend.template_mikapi', ['title' => 'Hotspot Binding'])
@push('csslib')
    <link href="{{ asset('backend/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/src/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
        type="text/css">

    <link href="{{ asset('backend/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/forms/switches.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/forms/switches.css') }}" rel="stylesheet" type="text/css">
    <style>
        .row-disabled {
            background-color: rgb(218, 212, 212)
        }
    </style>
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

        @include('mikapi.hotspot.binding.add')
        @include('mikapi.hotspot.binding.edit')
        @include('mikapi.hotspot.binding.detail')
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

    <script src="{{ asset('backend/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/moment/moment-with-locales.min.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('backend/src/plugins/src/input-mask/jquery.inputmask.bundle.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endpush


@push('js')
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/func.js') }}"></script>
    <script src="{{ asset('js/mikapi.js') }}"></script>
    <script>
        // $(document).ready(function() {

        $('.mask_angka').inputmask({
            alias: 'numeric',
            groupSeparator: '.',
            autoGroup: true,
            digits: 0,
            rightAlign: false,
            removeMaskOnSubmit: true,
            autoUnmask: true,
            min: 0,
        });

        var refresh = false
        $('.maxlength').maxlength({
            alwaysShow: true,
            placement: "top",
        });

        Inputmask("ip").mask($(".mask_ip"));
        Inputmask("mac").mask($(".mask_mac"));

        $(".select2").select2();

        $("#server, #edit_server").select2({
            placeholder: 'all',
            allowClear: true,
            ajax: {
                delay: 1000,
                url: "{{ route('api.mikapi.hotspot.servers.index') }}" + param_router,
                data: function(params) {
                    return {
                        name: params.term || '',
                        page: params.page || 1,
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.name,
                                id: item.name,
                            }
                        })
                    };
                },
            }
        });

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('api.mikapi.hotspot.bindings.index') }}",
                data: function(dt) {
                    if (refresh) {
                        dt.refresh = 'on'
                    }
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
                if (data.disabled == true) {
                    $('td', row).css('background-color', 'rgb(218, 212, 212)');
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
                        if (row.disabled) {
                            text +=
                                '<span class="badge me-1 badge-danger" title="Disabled">X</span>'
                        }
                        if (row.bypassed) {
                            text +=
                                '<span class="badge me-1 badge-success" title="Bypassed">P</span>'
                        }
                        if (row.blocked) {
                            text += '<span class="badge me-1 badge-danger" title="Bloked">B</span>'
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
                        if (data == null) {
                            return 'all';
                        } else {
                            return data
                        }
                    } else {
                        return data
                    }
                }
            }, {
                title: "MAC",
                data: 'mac-address',
            }, {
                title: "Address",
                data: 'address',
            }, {
                title: "To Address",
                data: 'to-address',
            }, {
                title: "Type",
                data: 'type',
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
                refresh = false
            },
            initComplete: function() {
                feather.replace();
                refresh = false
            }
        });

        $("div.toolbar").html(btn_element_refresh);

        $('#btn_add').click(function() {
            show_card_add()
            input_focus('name')
        })

        $('#btn_refresh').click(function() {
            refresh = true
            table.ajax.reload()
        })

        $('#btn_delete').click(function() {
            delete_batch("{{ route('api.mikapi.hotspot.bindings.destroy.batch') }}" + param_router)
        })

        $('#edit_delete').after(btn_detail)

        multiCheck(table);

        var id;
        var url_post = "{{ route('api.mikapi.hotspot.bindings.store') }}" + param_router;
        var url_put = "{{ route('api.mikapi.hotspot.bindings.update', '') }}/" + id + param_router;
        var url_delete = "{{ route('api.mikapi.hotspot.bindings.destroy', '') }}/" + id + param_router;

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            url_put = "{{ route('api.mikapi.hotspot.bindings.update', '') }}/" + id + param_router;
            url_delete = "{{ route('api.mikapi.hotspot.bindings.destroy', '') }}/" + id + param_router;
            edit(true)
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: url_put,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#edit_comment').val(result.data.comment);
                    $('#edit_mac').val(result.data['mac-address']);
                    $('#edit_address').val(result.data['address']);
                    $('#edit_to_address').val(result.data['to-address']);
                    $('#edit_type').val(result.data.type).trigger('change');
                    if (result.data.server == null || result.data.server == 'all') {
                        $('#edit_server').val('').trigger('change');
                    } else {
                        let option = new Option(result.data.server, result.data.server,
                            true, true);
                        $('#edit_server').append(option).trigger('change');
                    }
                    if (result.data.disabled == false) {
                        $('#edit_is_active').prop('checked', true).change();
                    } else {
                        $('#edit_is_active').prop('checked', false).change();
                    }
                    $('#tbl_detail').empty()
                    Object.keys(result.data).forEach(function(key) {
                        $('#tbl_detail').append(`<tr>
                                <td style="width:30%">${key}</td>
                                <td style="width:2%">:</td>
                                <td style="width:68%">${result.data[key]}</td>
                            </tr>`)
                    });
                    if (show) {
                        show_card_edit()
                        input_focus('name')
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
    <script src="{{ asset('js/trigger.js') }}"></script>
@endpush
