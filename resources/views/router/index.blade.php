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
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <form method="POST" action="" id="formSelected">
                    <table id="tableData" class="table table-bordered" style="width: 100%;cursor: pointer;">
                        <thead>
                            <tr>
                                <th class="dt-no-sorting" style="width: 30px;">Id</th>
                                <th>VPN</th>
                                <th>Name</th>
                                <th>Desc</th>
                            </tr>
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
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                $(document).ready(function() {
                    $('#modalRouter').modal('show');
                    swal(
                        'Failed!',
                        "{{ $error }}",
                        'error'
                    )
                })
            </script>
        @endforeach
    @endif
@endpush

@push('js')
    <script src="{{ asset('js/func.js') }}"></script>

    <script>
        // $(document).ready(function() {

        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        $('.maxlength').maxlength({
            placement: "top",
            alwaysShow: true
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
            dom: dom,
            oLanguage: o_lang,
            lengthMenu: length_menu,
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
                title: "Desc",
                data: 'desc',
            }, ],
            buttons: [{
                text: '<i class="fa fa-plus"></i>Add',
                className: 'btn btn-sm btn-primary bs-tooltip',
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Add Data'
                },
                action: function(e, dt, node, config) {
                    $('#modalAdd').modal('show');
                }
            }, {
                text: '<i class="fas fa-trash"></i>Del',
                className: 'btn btn-sm btn-danger',
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Delete Selected Data'
                },
                action: function(e, dt, node, config) {
                    delete_batch("{{ route('router.destroy.batch') }}")
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
            }, {
                text: 'Router',
                className: 'btn btn-sm btn-primary bs-tooltip',
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Select Router'
                },
                action: function(e, dt, node, config) {
                    $('#modalRouter').modal('show');
                }
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

        $('#modalAdd, #modalEdit').on('shown.bs.modal', function() {
            $('input[name="name"]').focus();
        });

        var id;
        var url_post = "{{ route('router.store') }}";
        var url_put = "{{ route('router.update', '') }}/" + id;
        var url_delete = "{{ route('router.destroy', '') }}/" + id;

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            edit(true)
            url_put = "{{ route('router.update', '') }}/" + id;
            url_delete = "{{ route('router.destroy', '') }}/" + id;
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
                    $('#edit_desc').val(result.data.desc);
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
