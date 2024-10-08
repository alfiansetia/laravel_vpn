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
    <link href="{{ asset('backend/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .row-disabled {
            background-color: rgb(218, 212, 212)
        }
    </style>
@endpush
@section('content')
    <div class="row" id="cancel-row">

        <div class="row layout-top-spacing layout-spacing pb-0" id="card_filter">
            <div class="col-md-4">
                <select class="form-control select2" name="status" id="select_comment">
                    <option value="">All</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-block btn-primary" id="btn_filter">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
            </div>
        </div>

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
        @include('mikapi.hotspot.user.detail')
    </div>
    <div id="tes"></div>
    @include('mikapi.hotspot.user.modal')
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

        var f1 = $('#time_limit').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:S",
            defaultDate: "today",
            disableMobile: true,
            time_24hr: true,
            enableSeconds: true
        })

        var f2 = $('#edit_time_limit').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:S",
            defaultDate: "today",
            disableMobile: true,
            time_24hr: true,
            enableSeconds: true
        })

        $(".select2").select2();

        $("#profile, #edit_profile").select2({
            placeholder: 'Select Profile',
            ajax: {
                delay: 1000,
                url: "{{ route('api.mikapi.hotspot.profiles.index') }}" + param_router,
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

        $("#template").select2({
            dropdownParent: $('#modal_print'),
            placeholder: 'Select Template',
            ajax: {
                delay: 1000,
                url: "{{ route('api.template.index') }}" + param_router,
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
                                html_up: item.html_up,
                                html_vc: item.html_vc,
                            }
                        })
                    };
                },
            }
        });

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('api.mikapi.hotspot.users.index') }}",
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
                        let text =
                            `<div class="form-check form-check-primary d-block new-control">
                        <input class="form-check-input child-chk" type="checkbox" ${row.default ? 'disabled' : ''} name="id[]" value="${data}" >`
                        if (row.disabled) {
                            text +=
                                '<span class="badge me-1 badge-danger" title="Disabled">X</span>'
                        }
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
                title: "Server",
                data: 'server',
            }, {
                title: "Name",
                data: 'name',
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
                refresh = false
            },
            initComplete: function() {
                feather.replace();
                refresh = false;
                let data_com = this.api().columns().data()[8]
                let uniqueData = Array.from(new Set(data_com.filter(item => item !== null && item !== "")));
                uniqueData.forEach(element => {
                    let opt = new Option(element, element, true, true);
                    $('#select_comment').append(opt)
                });
                $('#select_comment').val('').trigger('change')
                // console.log(uniqueData);
            }
        });

        $("div.toolbar").html(btn_element_refresh);

        $('#btn_add').click(function() {
            show_card_add()
            input_focus('name')
        })

        $('#btn_filter').click(function() {
            let comment = $('#select_comment').val()
            table.column(8).search(comment).draw()
        })

        $('#btn_refresh').click(function() {
            refresh = true
            table.ajax.reload()
        })

        $('#btn_delete').click(function() {
            delete_batch("{{ route('api.mikapi.hotspot.users.destroy.batch') }}" + param_router)
        })

        $('#btn_delete').after(
            `<li><button id="btn_print" type="button" class="dropdown-item bs-tooltip" title="Print Selected Data">Print</button></li>`
        )
        $('#btn_print').click(function() {
            let ids = $('input[name="id[]"]:checked').length;
            if (ids <= 0) {
                Swal.fire({
                    title: 'Failed!',
                    text: "No Selected Data!",
                    icon: 'error',
                })
                return;
            }
            $('#modal_print').modal('show')

        })

        $('#edit_delete').after(btn_detail)

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
                    $('#edit_password').val(result.data['password']);
                    $('#edit_rate_limit').val(result.data['rate-limit']);
                    $('#edit_comment').val(result.data.comment);
                    $('#edit_ip_address').val(result.data['address']);
                    let time = result.data['limit-uptime'];
                    let timeparse = parsedtm(time);
                    $('#edit_data_day').val(timeparse.day).change();
                    f2.setDate(timeparse.time);
                    let limit = result.data['limit-bytes-total'];
                    if (limit > 0 && limit < 1000000) {
                        $('#edit_data_limit').val(limit / 1000);
                        $('#edit_data_type').val('K').change();
                    } else if (limit >= 1000000 && limit < 1000000000) {
                        let mb = limit / 1000000;
                        $('#edit_data_limit').val(mb);
                        $('#edit_data_type').val('M').change();
                    } else if (limit >= 1000000000) {
                        let gb = limit / 1000000000;
                        $('#edit_data_limit').val(gb);
                        $('#edit_data_type').val('G').change();
                    } else {
                        $('#edit_data_limit').val(0);
                        $('#edit_data_type').val('K').change();
                    }
                    if (result.data.server == null || result.data.server == 'all') {
                        $('#edit_server').val('').trigger('change');
                    } else {
                        let option = new Option(result.data.server, result.data.server,
                            true, true);
                        $('#edit_server').append(option).trigger('change');
                    }
                    if (result.data['mac-address'] == null) {
                        $('#edit_mac').val('');
                    } else {
                        $('#edit_mac').val(result.data['mac-address']);
                    }
                    if (result.data.profile == null) {
                        $('#edit_profile').val('').change();
                    } else {
                        let option = new Option(result.data.profile, result.data
                            .profile, true, true);
                        $('#edit_profile').append(option).trigger('change');
                    }
                    if (result.data.disabled == false) {
                        $('#edit_is_active').prop('checked', true).change();
                    } else {
                        $('#edit_is_active').prop('checked', false).change();
                    }

                    let disabled = ['edit_server', 'edit_profile', 'edit_name', 'edit_password',
                        'edit_ip_address', 'edit_mac', 'edit_data_day', 'edit_time_limit',
                        'edit_data_limit', 'edit_data_type', 'edit_comment', 'edit_is_active', 'edit_save',
                        'edit_delete',
                    ]
                    disabled.forEach(element => {
                        $(`#${element}`).prop('disabled', result.data.default);
                    });

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

        var hsname = ''
        var contact = ''
        var url_logo = ''
        $.get("{{ route('router.show', request()->query('router')) }}").done(function(result) {
            hsname = result.data.hsname || '-'
            contact = result.data.contact || '-'
            url_logo = result.data.url_logo
        })

        $(document).ready(function() {
            $('#btn_modal_print').click(function() {
                let select = $('#template').select2('data')[0]
                let type = $('#modal_type').val()
                let html = ''
                if (type == 'up') {
                    html = select.html_up
                } else {
                    html = select.html_vc
                }
                if (html == '') {
                    return
                }

                let decoded = document.createElement('textarea');
                decoded.innerHTML = html;
                // var decoded = $("<div/>").html(html).text();
                // console.log(decoded.value);
                print_vc(decoded.value)

            })
        })

        function print_vc(html) {
            console.log(html);
            let checkedRowsData = [];
            $('input[name="id[]"]:checked').each(function() {
                let rowIndex = $(this).closest('tr').index();
                let rowData = table.row(rowIndex).data();
                checkedRowsData.push(rowData);
            });
            let printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Data Print</title></head><body>');
            for (let i = 0; i < checkedRowsData.length; i++) {
                let username = checkedRowsData[i].name
                let password = checkedRowsData[i].password
                let validity = '1d'
                let price = $('#modal_price').val() || 0
                let timelimit = checkedRowsData[i]['limit_uptime_parse'] || 'unlimited'
                let datalimit = checkedRowsData[i]['limit-bytes-total'] == 0 ? 'unlimited' : checkedRowsData[i][
                    'limit_bytes_total_parse'
                ]
                let num = i + 1
                let newhtml = html.replace('%u_username%', username)
                newhtml = newhtml.replace('%u_password%', password)
                newhtml = newhtml.replace('%validity%', validity)
                newhtml = newhtml.replace('%price%', price)
                newhtml = newhtml.replace('%hs_name%', hsname)
                newhtml = newhtml.replace('%timelimit%', timelimit)
                newhtml = newhtml.replace('%datalimit%', datalimit)
                newhtml = newhtml.replace('%num%', num)
                newhtml = newhtml.replace('%contact%', contact)
                newhtml = newhtml.replace('%url_logo%', url_logo)
                if (checkedRowsData[i].default == false) {
                    printWindow.document.write(newhtml);
                }
            }

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            let img = printWindow.document.querySelector('img');
            // console.log(img);
            if (img == null) {
                printWindow.print();
            } else {
                img.onload = function() {
                    printWindow.print();
                };
            }
            // printWindow.print();

            // printWindow.document.write('<td>' + checkedRowsData[i]['.id'] + '</td>');
            // printWindow.document.write('<td>' + checkedRowsData[i].name + '</td>');
            // printWindow.document.write('<td>' + checkedRowsData[i].password + '</td>');
            // printWindow.document.write('</tr>');
        }


        // });
    </script>
    <script src="{{ asset('js/trigger.js') }}"></script>
@endpush
