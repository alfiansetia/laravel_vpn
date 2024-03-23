@extends('layouts.backend.template_mikapi', ['title' => 'Hotspot User'])
@push('csslib')
    <link href="{{ asset('backend/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/forms/switches.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/forms/switches.css') }}" rel="stylesheet" type="text/css">
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

        @include('mikapi.hotspot.user.add')
        @include('mikapi.hotspot.user.edit')
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
@endpush


@push('js')
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/func.js') }}"></script>
    <script src="{{ asset('js/mikapi.js') }}"></script>
    <script>
        // $(document).ready(function() {

        $('.maxlength').maxlength({
            alwaysShow: true,
            placement: "top",
        });

        $(".select2").select2();


        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('api.mikapi.hotspot.users.index') }}",
                data: function(dt) {
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
                    return `
                    <div class="form-check form-check-primary d-block new-control">
                        <input class="form-check-input child-chk" type="checkbox" name="id[]" value="${data}" >
                    </div>`
                }
            }, {
                title: "Server",
                data: 'server',
                render: function(data, type, row, meta) {
                    if (data == null) {
                        return 'all';
                    } else {
                        return data
                    }
                }
            }, {
                title: "Name",
                data: 'name',
                render: function(data, type, row, meta) {
                    if (data == null) {
                        return null;
                    } else {
                        if (type == 'display') {
                            if (row.disabled == 'true') {
                                return `<span data-toggle="tooltip" title="Disabled"><font color="red">${data}</font></span>`;
                            } else {
                                return data
                            }
                        } else {
                            return data
                        }
                    }
                }
            }, {
                title: "Profile",
                data: 'profile',
            }, {
                title: "MAC",
                data: 'mac-address',
            }, {
                title: "Uptime",
                data: 'uptime',
                render: function(data, type, row, meta) {
                    if (data == null) {
                        return null;
                    } else {
                        if (type == 'display') {
                            return dtm(data);
                        } else {
                            return data;
                        }
                    }
                }
            }, {
                title: "IN",
                data: 'bytes-in',
                render: function(data, type, row, meta) {
                    if (data == null) {
                        return null;
                    } else {
                        if (type == 'display') {
                            return formatBytes(data);
                        } else {
                            return data;
                        }
                    }
                }
            }, {
                title: "OUT",
                data: 'bytes-out',
                render: function(data, type, row, meta) {
                    if (data == null) {
                        return null;
                    } else {
                        if (type == 'display') {
                            return formatBytes(data);
                        } else {
                            return data;
                        }
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

        $('#btn_add').click(function() {
            show_card_add()
            input_focus('name')
        })

        $('#btn_refresh').click(function() {
            table.ajax.reload()
        })

        $('#btn_delete').click(function() {
            delete_batch("{{ route('api.mikapi.hotspot.users.index') }}")
        })

        multiCheck(table);

        var id;
        var url_post = "{{ route('api.mikapi.hotspot.users.store') }}" + param_router;
        var url_put = "{{ route('api.mikapi.hotspot.users.update', '') }}/" + id + param_router;
        var url_delete = "{{ route('api.mikapi.hotspot.users.destroy', '') }}/" + id + param_router;

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            url_put = "{{ route('api.mikapi.hotspot.users.update', '') }}/" + id + param_router;
            url_delete = "{{ route('api.mikapi.hotspot.users.destroy', '') }}/" + id + param_router;
            edit(true)
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: url_put,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#edit_name').val(result.data.name);
                    $('#edit_shared_users').val(result.data['shared-users']);
                    $('#edit_rate_limit').val(result.data['rate-limit']);
                    if (result.data['parent-queue'] == null) {
                        $('#edit_parent').val('').trigger('change');
                    } else {
                        let option = new Option(result.data['parent-queue'], result.data['parent-queue'], true,
                            true);
                        $('#edit_parent').append(option).trigger('change');
                    }
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
@endpush
