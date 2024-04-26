@extends('layouts.backend.template', ['title' => 'Data Topup'])
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
    <link href="{{ asset('backend/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />

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
        @include('topup.add')
        @include('topup.edit')
    </div>
    @include('topup.modal')
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

        var perpage = 20;

        $("#bank, #edit_bank").select2({
            ajax: {
                delay: 1000,
                url: "{{ route('bank.paginate') }}",
                data: function(params) {
                    return {
                        name: params.term || '',
                        page: params.page || 1,
                        perpage: perpage,
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: `${item.name} (${item.acc_name})`,
                                id: item.id,
                            }
                        }),
                        pagination: {
                            more: (params.page * perpage) < data.total
                        }
                    };
                },
            }
        });
        // $(document).ready(function() {

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            rowId: 'id',
            ajax: {
                url: "{{ route('topup.index') }}",
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
                title: "Date",
                data: 'date',
            }, {
                title: "Number",
                data: 'number',
            }, {
                title: "Amount",
                data: 'amount',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return hrg(data)
                    } else {
                        return data
                    }
                }
            }, {
                title: 'Status',
                data: 'status',
                className: "text-center",
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `<span class="badge badge-${data === 'done' ? 'success' : (data === 'pending'? 'warning':'danger')}">${data}</span>`
                    } else {
                        return data
                    }
                }
            }, {
                title: "Desc",
                data: 'desc',
            }, ],
            headerCallback: function(e, a, t, n, s) {},
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
            input_focus('amount')
        })

        $('#btn_pay').click(function() {
            $('#modal_pay').modal('show')
        })


        $('#btn_delete').remove()
        $('#edit_delete').remove()

        multiCheck(table);

        var id;
        var url_post = "{{ route('topup.store') }}";
        var url_put = "{{ route('topup.update', '') }}/" + id;
        var url_delete = "{{ route('topup.destroy', '') }}/" + id;
        var url_wa = ''

        $('#btn_modal_confirm').click(function() {
            window.open(url_wa, '_blank')
        })

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            edit(true)
            url_put = "{{ route('topup.update', '') }}/" + id;
            url_delete = "{{ route('topup.destroy', '') }}/" + id;
            id = table.row(this).id()
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: "{{ route('topup.show', '') }}/" + id,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#edit_amount').val(result.data.amount);
                    $('#edit_desc').val(result.data.desc);
                    $('#titleEdit2').html(`<b>${result.data.number}</b> (${result.data.status})`);

                    if (result.data.bank_id == null) {
                        $('#edit_bank').val('').trigger('change')
                    } else {
                        let option_bank = new Option(`${result.data.bank.name} (${result.data.bank.acc_name})`,
                            result.data.bank_id,
                            true, true);
                        $('#edit_bank').append(option_bank).trigger('change')
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
                    let element = ['edit_amount', 'edit_save', 'edit_bank', 'edit_from', 'edit_to',
                        'edit_delete', 'edit_user', 'btn_done', 'btn_cancel', 'edit_desc'
                    ];
                    element.forEach(item => {
                        $(`#${item}`).prop('disabled', true);
                    });

                    $('#btn_pay').prop('disabled', !(result.data.status == 'pending'));

                    $('.modal_amount').text(hrg(result.data.amount))
                    $('.modal_bank_name').text(result.data.bank.name || '')
                    $('.modal_acc_name').text(result.data.bank.acc_name || '')
                    $('.modal_acc_number').text(result.data.bank.acc_number || '')
                    url_wa =
                        `https://api.whatsapp.com/send?phone=6282324129752&text=Halo,%20Saya%20dengan%20email%20${result.data.user.email}%20ingin%20konfirmasi%20Topup%20Saldo%20sebesar%20RP. ${hrg(result.data.amount)}%20melalui%20${result.data.bank.name}%20${result.data.bank.acc_name} (${result.data.bank.acc_number})`
                    if (show) {
                        show_card_edit()
                        input_focus('amount')
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
