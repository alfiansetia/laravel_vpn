@extends('layouts.backend.template_mikapi', ['title' => 'Dashboard'])

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

    <link href="{{ asset('backend/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('backend/src/plugins/src/notification/snackbar/snackbar.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/plugins/css/light/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/plugins/css/dark/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('backend/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row layout-top-spacing">

        @include('mikapi.dashboard.summary')
        @include('mikapi.dashboard.resource')
        @include('mikapi.dashboard.card_count')
        @include('mikapi.dashboard.log')
        @include('mikapi.dashboard.panel')

    </div>

    {{-- <button class="btn btn-primary" id="tes">TES</button>

    <button class="btn btn-primary" id="stop">STOP</button> --}}

    {{-- <div class="spinner-border" role="status"> --}}
    </div>
@endsection


@push('jslib')
    <script src="{{ asset('backend/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script src="{{ asset('backend/src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/select2/custom-select2.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/apex/apexcharts.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/notification/snackbar/snackbar.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ asset('assets/js/func.js') }}"></script>

    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                show_alert("{{ session('error') }}", 'error')
            })
        </script>
    @endif


    <script>
        var count = 0;
        var routerId = "{{ request()->query('router') }}";

        function dashboard() {
            let url = "{{ route('api.mikapi.dashboard.get') }}" + param_router;
            $.get(url).done(function(res) {
                let cpuload = 0
                let ramtot = 0
                let ramfre = 0
                let ramhas = 0

                let disktot = 0
                let diskfre = 0
                let diskhas = 0
                let sys_ros = 'No data!'
                let sys_up = 'No data!'
                let sys_rb = 'No data!'
                if (res.data.resource.length > 0) {
                    cpuload = Math.round(res.data.resource[0]['cpu-load']);
                    ramtot = res.data.resource[0]['total-memory'];
                    ramfre = res.data.resource[0]['free-memory'];
                    ramhas = Math.round((ramtot - ramfre) / ramtot * 100);

                    disktot = res.data.resource[0]['total-hdd-space'];
                    diskfre = res.data.resource[0]['free-hdd-space'];
                    diskhas = Math.round((disktot - diskfre) / disktot * 100);

                    sys_ros = res.data.resource[0].version
                    sys_up = dtm(res.data.resource[0].uptime)
                }
                if (res.data.routerboard.length > 0) {
                    sys_rb = res.data.resource[0]['board-name'] + ' | ' + (res.data.routerboard[0]
                        .routerboard ==
                        'true' ? res.data.routerboard[0].model : 'No Routerboard!')
                }
                $('#sys_ros').text(sys_ros);
                $('#sys_up').text(sys_up);
                $('#sys_rb').text(sys_rb);

                $("#cpu_label").text(cpuload + '%');
                $("#cpu").css('width', cpuload + '%')
                $("#ram_label").text("(" + formatBytes(ramtot - ramfre) + '/' + formatBytes(ramtot) + ')')
                $("#ram").css('width', ramhas + '%')
                $("#disk_label").text("(" + formatBytes(disktot - diskfre) + '/' + formatBytes(disktot) + ')')
                $("#disk").css('width', diskhas + '%')

                $('#hs_active').text(res.data.hs_active);
                $('#hs_user').text(res.data.hs_user);
                $('#ppp_active').text(res.data.ppp_active);
                $('#ppp_secret').text(res.data.ppp_secret);
                unblock();
            }).fail(function(xhr) {
                unblock();
                Snackbar.show({
                    text: xhr.responseJSON.message || 'Server Error!',
                    pos: 'bottom-left'
                });
            })
        }

        $(document).ready(function() {
            $('.refresh-data').click(function() {
                block();
                dashboard();
                table.ajax.reload();
            })

            dashboard();

            var i;
            var j;

            $('#tes').click(function() {
                dashboard()
            });

            var table = $('#tableData').DataTable({
                processing: false,
                serverSide: false,
                searching: false,
                order: [
                    [0, 'desc']
                ],
                rowId: '.id',
                ajax: {
                    url: "{{ route('api.mikapi.logs.index') }}" + param_router +
                        '&topics=hotspot,info,debug',
                    error: function(xhr, error, code) {
                        if (xhr.status == 500) {
                            Snackbar.show({
                                text: 'Server Error!',
                                pos: 'bottom-left'
                            });
                        } else {
                            Snackbar.show({
                                text: xhr.responseJSON.message,
                                pos: 'bottom-left'
                            });
                        }
                    }
                },
                dom: "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                oLanguage: {
                    "oPaginate": {
                        "sPrevious": '<i data-feather="arrow-left"></i>',
                        "sNext": '<i data-feather="arrow-right"></i>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<i data-feather="search"></i>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                lengthMenu: [
                    [10, 50, 100, 500, 1000],
                    ['10 rows', '50 rows', '100 rows', '500 rows', '1000 rows']
                ],
                pageLength: 10,
                lengthChange: false,
                columns: [{
                    title: "Time",
                    data: 'time'
                }, {
                    title: "Message",
                    data: 'message',
                }],
                drawCallback: function(settings) {
                    feather.replace();
                    unblock()
                },
                initComplete: function() {
                    feather.replace();
                    unblock()
                }
            });

        });
    </script>
@endpush
