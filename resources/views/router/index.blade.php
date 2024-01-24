@extends('layouts.backend.template', ['title' => 'Data Router'])
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
@endpush
@section('content')
    <div class="row" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing">
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
    </div>
    @include('router.modal')
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
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        // $(document).ready(function() {

        $('.maxlength').maxlength({
            alwaysShow: true,
            placement: "top",
        });

        $('#router').select2({
            dropdownParent: $("#modalRouter"),
            ajax: {
                delay: 1000,
                url: "{{ route('router.index') }}",
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
                            }
                        })
                    };
                },
            }
        })

        $('#formRouter').submit(function(event) {
            block()
            // event.preventDefault();
            // var id = $('#router').select2('data')[0].id
        })

        $('#btnOpen').on('click', function() {
            // block();
            id = $(this).val();
            let url = "{{ route('mikapi.dashboard') }}?router=" + id;
            window.open(url, '_blank');
        });

        $("#vpn").select2({
            dropdownParent: $("#modalAdd"),
            ajax: {
                delay: 1000,
                url: "{{ route('port.getbyuser') }}",
                data: function(params) {
                    return {
                        dst: params.term,
                        page: params.page
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.vpn.username + ":" + item.dst + ' => ' + item.vpn
                                    .server.name,
                                id: item.id,
                                disabled: item.vpn.is_active == 'yes' ? false : true,
                            }
                        })
                    };
                },
            }
        });

        $("#edit_vpn").select2({
            dropdownParent: $("#modalEdit"),
            ajax: {
                delay: 1000,
                url: "{{ route('port.getbyuser') }}",
                data: function(params) {
                    return {
                        dst: params.term,
                        page: params.page
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.vpn.username + ":" + item.dst + ' => ' + item.vpn
                                    .server.name,
                                id: item.id,
                                disabled: item.vpn.is_active == 'yes' ? false : true,
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
                url: "{{ route('router.index') }}",
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
                title: "VPN",
                data: 'port',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        if (data !== null) {
                            return data.vpn.username + ":" + data.dst;
                        } else {
                            return null;
                        }
                    } else {
                        if (data !== null) {
                            return data.dst
                        } else {
                            return null;
                        }
                    }
                }
            }, {
                title: "Name",
                data: 'name',
            }, {
                title: "Hs Name",
                data: 'hsname',
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
            $('#modalAdd').modal('show')
        })

        $('#btn_delete').click(function() {
            delete_batch("{{ route('router.destroy.batch') }}")
        })

        $('#modalAdd, #modalEdit').on('shown.bs.modal', function() {
            $('input[name="name"]').focus();
        });

        multiCheck(table);

        var id;
        var url_post = "{{ route('router.store') }}";
        var url_put = "{{ route('router.update', '') }}/" + id;
        var url_delete = "{{ route('router.destroy', '') }}/" + id;

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            edit(true)
            url_put = "{{ route('router.update', '') }}/" + id;
            url_delete = "{{ route('router.destroy', '') }}/" + id;
            id = table.row(this).id()
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: "{{ route('router.show', '') }}/" + id,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#edit_reset').val(result.data.id);
                    $('#btnOpen').val(result.data.id);
                    $('#edit_name').val(result.data.name);
                    $('#edit_hsname').val(result.data.hsname);
                    $('#edit_dnsname').val(result.data.dnsname);
                    $('#edit_username').val(result.data.username);
                    if (result.data.port !== null) {
                        let option2 = new Option((result.data.port.vpn.username + ":" +
                                result.data.port.dst + ' => ' + result.data.port.vpn.server.name
                            ),
                            (result.data.port_id), true, true);
                        $('#edit_vpn').append(option2).trigger('change');
                    } else {
                        $('#edit_vpn').val('').change();
                    }
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

        // });
    </script>
@endpush
