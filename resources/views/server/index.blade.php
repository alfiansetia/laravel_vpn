@extends('layouts.template')

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/table/datatable/custom_dt_html5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/table/datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--  BEGIN CUSTOM STYLE FILE  -->
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
                                    <th>Name</th>
                                    <th>IP</th>
                                    <th>Domain</th>
                                    <th>Netwatch</th>
                                    <th>Price</th>
                                    <th>Location</th>
                                    <th>Available</th>
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

    @include('server.modal')
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

    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('js/func.js') }}"></script>

    <script>
        // $(document).ready(function() {

        $('[data-mask]').inputmask();

        $('.maxlength').maxlength({
            placement: "top",
            alwaysShow: true
        });

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            rowId: 'id',
            ajax: {
                url: "{{ route('server.index') }}",
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
                title: "Name",
                data: 'name',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `<i class="fas fa-circle text-${row.is_active == 'yes' ? 'success' : 'danger'}" data-toggle="tooltip" title="${row.is_active == 'yes' ? 'Active' : 'Nonactive'}"></i> ${data}`;
                    } else {
                        return data
                    }
                }
            }, {
                title: "IP",
                data: 'ip',
            }, {
                title: "Domain",
                data: 'domain',
            }, {
                title: "Netwatch",
                data: 'netwatch',
            }, {
                title: "Price",
                data: 'price',
            }, {
                title: "Location",
                data: 'location',
            }, {
                title: "Available",
                data: 'is_available',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `<span class="badge badge-${data == 'yes' ? 'success' : 'danger'}">${data == 'yes' ? 'Available' : 'Unvailable'}</span>`;
                    } else {
                        return data
                    }
                }
            }],
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
                    delete_batch("{{ route('server.destroy.batch') }}")
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

        $('#modalAdd, #modalEdit').on('shown.bs.modal', function() {
            $('input[name="name"]').focus();
        });

        var id;
        var url_post = "{{ route('server.store') }}";
        var url_put = "{{ route('server.update', '') }}/" + id;
        var url_delete = "{{ route('server.destroy', '') }}/" + id;

        $('#btnPing').on('click', function() {
            let url = "{{ route('server.ping', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: 'GET',
                beforeSend: function() {
                    block();
                },
                success: function(res) {
                    unblock();
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
        })

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            edit(true)
            url_put = "{{ route('server.update', '') }}/" + id;
            url_delete = "{{ route('server.destroy', '') }}/" + id;
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: "{{ route('server.show', '') }}/" + id,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#edit_name').val(result.data.name);
                    $('#edit_username').val(result.data.username);
                    $('#edit_password').val('');
                    $('#edit_ip').val(result.data.ip);
                    $('#edit_domain').val(result.data.domain);
                    $('#edit_netwatch').val(result.data.netwatch);
                    $('#edit_location').val(result.data.location);
                    $('#edit_sufiks').val(result.data.sufiks);
                    $('#edit_port').val(result.data.port);
                    $('#edit_price').val(result.data.price);
                    $('#edit_last_ip').val(result.data.last_ip);
                    $('#edit_count_ip').val(result.data.count_ip);
                    $('#edit_last_port').val(result.data.last_port);
                    if (result.data.is_active == 'yes') {
                        $('#edit_is_active1').attr('checked', true);
                        $('#edit_is_active1').click();
                    } else {
                        $('#edit_is_active2').attr('checked', true);
                        $('#edit_is_active2').click();
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
