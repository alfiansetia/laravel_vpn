@extends('layouts.backend.template', ['title' => 'Data Server'])
@push('csslib')
    <link href="{{ asset('backend/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

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
        @include('server.add')
        @include('server.edit')
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
@endpush


@push('js')
    <script src="{{ asset('js/v1/initial.js') }}"></script>
    <script src="{{ asset('js/v1/navigation.js') }}"></script>
    <script src="{{ asset('js/v1/func.js') }}"></script>
    <script src="{{ asset('js/v1/var.js') }}"></script>
    <script>
        // $(document).ready(function() {

        var url_index = "{{ route('api.servers.index') }}"
        var url_id;
        var id;

        $('.maxlength').maxlength({
            alwaysShow: true,
            placement: "top",
        });

        Inputmask("ip").mask($(".mask_ip"));
        Inputmask("mac").mask($(".mask_mac"));

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: url_index,
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
                title: "Name",
                data: 'name',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `<i class="fas fa-circle bs-tooltip text-${row.is_active == 'yes' ? 'success' : 'danger'}" title="${row.is_active == 'yes' ? 'Active' : 'Nonactive'}"></i> ${data}`;
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
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return hrg(data)
                    } else {
                        return data
                    }
                }
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

        multiCheck(table);

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            url_id = url_index + "/" + id
            $('#formEdit').attr('action', url_id)
            edit(true)
        });

        function edit(show = false) {
            clear_validate('formEdit')
            $.ajax({
                url: url_id,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#formEdit')[0].reset();
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
                    $('#edit_annual_price').val(result.data.annual_price);
                    $('#edit_last_ip').val(result.data.last_ip);
                    if (result.data.is_active == 'yes') {
                        $('#edit_active').prop('checked', true).change();
                    } else {
                        $('#edit_active').prop('checked', false).change();
                    }
                    if (result.data.is_available == 'yes') {
                        $('#edit_available').prop('checked', true).change();
                    } else {
                        $('#edit_available').prop('checked', false).change();
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
    <script src="{{ asset('js/v1/trigger.js') }}"></script>
@endpush
