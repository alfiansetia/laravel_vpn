@extends('layouts.backend.template', ['title' => 'Data Invoice'])
@push('csslib')
    <link href="{{ asset('backend/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('backend/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/src/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
        type="text/css">

    <link href="{{ asset('backend/src/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">

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
        @include('invoice.edit_user')
    </div>
@endsection
@push('jslib')
    <script src="{{ asset('backend/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script src="{{ asset('backend/src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/moment/moment-with-locales.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/select2/custom-select2.js') }}"></script>
@endpush


@push('js')
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        $('.maxlength').maxlength({
            alwaysShow: true,
            placement: "top",
        });

        var edit_from = flatpickr(document.getElementById('edit_from'), {
            defaultDate: "today",
            disableMobile: true,
        });

        var edit_to = flatpickr(document.getElementById('edit_to'), {
            defaultDate: "today",
            disableMobile: true,
        });

        // $(document).ready(function() {
        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            rowId: 'id',
            ajax: {
                url: "{{ route('invoice.index') }}",
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
                title: "Date",
                data: 'date',
            }, {
                title: "Number",
                data: 'number',
            }, {
                title: 'VPN',
                data: 'vpn_id',
                className: "text-center",
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        if (data != null) {
                            return row.vpn.username
                        } else {
                            return ''
                        }
                    } else {
                        return data
                    }
                }
            }, {
                title: "Total",
                data: 'total',
            }, {
                title: 'Status',
                data: 'status',
                className: "text-center",
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `<span class="badge badge-${data === 'paid' ? 'success' : (data === 'unpaid'? 'warning':'danger')}">${data}</span>`
                    } else {
                        return data
                    }
                }
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

        $('#edit_save').remove()
        $('#btn_delete').remove()
        $('#edit_delete').remove()

        multiCheck(table);

        var id;
        var url_post = "{{ route('invoice.store') }}";
        var url_put = "{{ route('invoice.update', '') }}/" + id;
        var url_delete = "{{ route('invoice.destroy', '') }}/" + id;

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            url_put = "{{ route('invoice.update', '') }}/" + id;
            url_delete = "{{ route('invoice.destroy', '') }}/" + id;
            id = table.row(this).id()
            edit(true)
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: "{{ route('invoice.show', '') }}/" + id,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#edit_total').val(result.data.total);
                    $('#edit_desc').val(result.data.desc);
                    $('#titleEdit2').html(`<b>${result.data.number}</b> (${result.data.status})`);
                    edit_from.setDate(result.data.from);
                    edit_to.setDate(result.data.to);

                    if (result.data.bank_id == null) {
                        $('#edit_bank').val('').trigger('change')
                    } else {
                        let option_bank = new Option(`${result.data.bank.name} (${result.data.bank.acc_name})`,
                            result.data.bank_id,
                            true, true);
                        $('#edit_bank').append(option_bank).trigger('change')
                    }
                    if (result.data.vpn_id == null) {
                        $('#edit_vpn').val('').trigger('change')
                    } else {
                        let option_vpn = new Option(
                            `${result.data.vpn.username} (${result.data.vpn.server.name})`,
                            result.data.vpn_id,
                            true, true);
                        $('#edit_vpn').append(option_vpn).trigger('change')
                    }
                    if (result.data.user_id == null) {
                        $('#edit_user').val('').trigger('change')
                    } else {
                        let option_user = new Option(
                            `${result.data.user.name} (${result.data.user.email})`,
                            result.data.user_id,
                            true, true);
                        $('#edit_user').append(option_user).trigger('change')
                    }
                    let element = ['edit_total', 'edit_bank', 'edit_vpn', 'edit_from', 'edit_to',
                        'edit_delete', 'edit_user', 'btn_paid', 'btn_cancel', 'edit_desc'
                    ];
                    element.forEach(item => {
                        $(`#${item}`).prop('disabled', true);
                    })
                    if (show) {
                        show_card_edit()
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
