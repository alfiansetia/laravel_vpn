@extends('layouts.backend.template_mikapi', ['title' => 'PPP L2tp Secret'])
@push('csslib')
    <link href="{{ asset('backend/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
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

        @include('mikapi.ppp.l2tp_secret.add')
        @include('mikapi.ppp.l2tp_secret.edit')
        @include('mikapi.ppp.l2tp_secret.detail')
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
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/func.js') }}"></script>
    <script src="{{ asset('js/mikapi.js') }}"></script>
    <script>
        // $(document).ready(function() {

        Inputmask("ip").mask($(".mask_ip"));

        $('.maxlength').maxlength({
            alwaysShow: true,
            placement: "top",
        });

        $(".select2").select2();

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('api.mikapi.ppp.l2tp_secrets.index') }}",
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
                        if (row.default) {
                            text +=
                                '<span class="badge me-1 badge-info" title="Default">*</span>'
                        }
                        text += `</div>`
                        return text
                    } else {
                        return data
                    }
                }
            }, {
                title: "Address",
                data: 'address',
            }, {
                title: "Secret",
                data: 'secret',
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
            delete_batch("{{ route('api.mikapi.ppp.l2tp_secrets.destroy.batch') }}" + param_router)
        })

        $('#edit_delete').after(btn_detail)

        multiCheck(table);

        var id;
        var url_post = "{{ route('api.mikapi.ppp.l2tp_secrets.store') }}" + param_router;
        var url_put = "{{ route('api.mikapi.ppp.l2tp_secrets.update', '') }}/" + id + param_router;
        var url_delete = "{{ route('api.mikapi.ppp.l2tp_secrets.destroy', '') }}/" + id + param_router;

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            url_put = "{{ route('api.mikapi.ppp.l2tp_secrets.update', '') }}/" + id + param_router;
            url_delete = "{{ route('api.mikapi.ppp.l2tp_secrets.destroy', '') }}/" + id + param_router;
            edit(true)
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: url_put,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#edit_secret').val(result.data.secret);
                    $('#edit_comment').val(result.data.comment);
                    part = result.data.address.split('/')
                    $('#edit_address').val(part[0]);
                    $('#edit_subnet').val(part[1]);
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
