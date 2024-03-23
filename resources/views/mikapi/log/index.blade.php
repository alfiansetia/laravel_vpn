@extends('layouts.backend.template_mikapi', ['title' => 'Log'])
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
        <div class="row layout-top-spacing layout-spacing pb-0" id="card_filter">
            <div class="col-md-8">
                <select class="form-control" name="topics" id="select_topics" multiple>
                    <option value="system" selected>system</option>
                    <option value="error" selected>error</option>
                    <option value="critical" selected>critical</option>
                    <option value="account">account</option>
                    <option value="async">async</option>
                    <option value="backup">backup</option>
                    <option value="bgp">bgp</option>
                    <option value="bfd">bfd</option>
                    <option value="bridge">bridge</option>
                    <option value="calc">calc</option>
                    <option value="caps">caps</option>
                    <option value="certificate">certificate</option>
                    <option value="ddns">ddns</option>
                    <option value="debug">debug</option>
                    <option value="dhcp">dhcp</option>
                    <option value="dns">dns</option>
                    <option value="dot1x">dot1x</option>
                    <option value="dude">dude</option>
                    <option value="e-mail">e-mail</option>
                    <option value="event">event</option>
                    <option value="firewall">firewall</option>
                    <option value="gsm">gsm</option>
                    <option value="gps">gps</option>
                    <option value="health">health</option>
                    <option value="hotspot">hotspot</option>
                    <option value="igmp-proxy">igmp-proxy</option>
                    <option value="interface">interface</option>
                    <option value="ipsec">ipsec</option>
                    <option value="info">info</option>
                    <option value="isdn">isdn</option>
                    <option value="iscsi">iscsi</option>
                    <option value="kvm">kvm</option>
                    <option value="ldp">ldp</option>
                    <option value="lte">lte</option>
                    <option value="lora">lora</option>
                    <option value="l2tp">l2tp</option>
                    <option value="mme">mme</option>
                    <option value="mqtt">mqtt</option>
                    <option value="mpls">mpls</option>
                    <option value="ntp">ntp</option>
                    <option value="raw">raw</option>
                    <option value="radius">radius</option>
                    <option value="radvd">radvd</option>
                    <option value="read">read</option>
                    <option value="route">route</option>
                    <option value="rsvp">rsvp</option>
                    <option value="smb">smb</option>
                    <option value="script">script</option>
                    <option value="sertcp">sertcp</option>
                    <option value="ssh">ssh</option>
                    <option value="sstp">sstp</option>
                    <option value="snmp">snmp</option>
                    <option value="simulator">simulator</option>
                    <option value="state">state</option>
                    <option value="stp">stp</option>
                    <option value="store">store</option>
                    <option value="tftp">tftp</option>
                    <option value="telephony">telephony</option>
                    <option value="timer">timer</option>
                    <option value="tr069">tr069</option>
                    <option value="upnp">upnp</option>
                    <option value="ups">ups</option>
                    <option value="vrrp">vrrp</option>
                    <option value="warning">warning</option>
                    <option value="web-proxy">web-proxy</option>
                    <option value="wireless">wireless</option>
                    <option value="write">write</option>

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

        @include('mikapi.log.edit')
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
    <script>
        // $(document).ready(function() {

        $('.maxlength').maxlength({
            alwaysShow: true,
            placement: "top",
        });

        $("#select_topics").select2({
            tags: true,
            tokenSeparators: [',', ' '],
        }).on('select2:select', function(e) {
            var id = e.params.data.id;
            var option = $(e.target).children('[value=' + id + ']');
            option.detach();
            $(e.target).append(option).change();
        });

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('api.mikapi.logs.destroy') }}",
                data: function(dt) {
                    let topics = $('#select_topics').val() || []
                    let topicsString = ''
                    if (topics.length > 0) {
                        topicsString = topics.join(',');
                    }
                    dt.router = "{{ request()->query('router') }}";
                    dt.topics = topicsString
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    handleResponse(jqXHR)
                },
            },
            columnDefs: [{
                defaultContent: '',
                targets: "_all"
            }],
            order: [
                [1, 'desc']
            ],
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
                title: "Time",
                data: 'time',
            }, {
                title: "Topics",
                data: 'topics',
            }, {
                title: "Message",
                data: 'message',
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

        $('#btn_filter').click(function() {
            table.ajax.reload()
        })

        var btn_element = `<div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                        <i data-feather="chevron-down"></i> 
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li><button id="btn_delete" type="button" class="dropdown-item bs-tooltip" title="Delete All Log">Delete All</button></li>
                    </ul>
                </div>`

        $("div.toolbar").html(btn_element);

        $('#btn_add').click(function() {
            show_card_add()
            input_focus('name')
        })

        $('#btn_delete').click(function() {
            delete_all()
        })

        multiCheck(table);

        var id;

        $('#tableData tbody').on('click', 'tr td:not(:first-child)', function() {
            id = table.row(this).id()
            edit(true)
        });

        function edit(show = false) {
            clear_validate($('#formEdit'))
            $.ajax({
                url: "{{ route('api.mikapi.logs.show', '') }}/" + id + param_router,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $('#edit_time').val(result.data.time);
                    $('#edit_topics').val(result.data.topics);
                    $('#edit_message').val(result.data.message);
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

        function delete_all() {
            ajax_setup()
            Swal.fire({
                title: 'Are you sure?',
                text: "Data Will be Lost!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                confirmButtonAriaLabel: 'Thumbs up, Yes!',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                cancelButtonAriaLabel: 'Thumbs down',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                padding: '2em',
                customClass: 'animated tada',
                showClass: {
                    popup: `animated tada`
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    ajax_setup();
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ route('api.mikapi.logs.destroy') }}" + param_router,
                        beforeSend: function() {
                            block();
                        },
                        success: function(res) {
                            unblock();
                            table.ajax.reload();
                            Swal.fire(
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
                }
            })
        }

        // });
    </script>
@endpush
