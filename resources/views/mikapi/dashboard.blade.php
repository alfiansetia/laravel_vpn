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
@endpush

@section('content')
    <div class="row layout-top-spacing">

        @include('mikapi.dashboard.summary')
        @include('mikapi.dashboard.resource')
        @include('mikapi.dashboard.card_count')
        @include('mikapi.dashboard.log')
        @include('mikapi.dashboard.panel')

    </div>

    <button class="btn btn-primary" id="tes">TES</button>

    <button class="btn btn-primary" id="stop">STOP</button>

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
        try {
            var options = {
                series: [{
                    name: 'RX',
                    data: []
                }, {
                    name: 'TX',
                    data: []
                }],
                chart: {
                    fontFamily: 'Quicksand, sans-serif',
                    height: 400,
                    type: 'area',
                    zoom: {
                        enabled: true,
                        type: 'x',
                        autoScaleYaxis: false,
                        zoomedArea: {
                            fill: {
                                color: '#90CAF9',
                                opacity: 0.4
                            },
                            stroke: {
                                color: '#0D47A1',
                                opacity: 0.4,
                                width: 1
                            }
                        }
                    },
                    dropShadow: {
                        enabled: true,
                        opacity: 0.2,
                        blur: 10,
                        left: -7,
                        top: 22
                    },
                },
                colors: ['#1b55e2', '#e7515a'],
                dataLabels: {
                    enabled: false
                },
                title: {
                    text: 'Traffic Monitor',
                    align: 'left',
                    margin: 0,
                    offsetX: -10,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '18px',
                        color: '#0e1726'
                    },
                },
                stroke: {
                    show: true,
                    curve: 'smooth',
                    width: 2,
                    lineCap: 'square'
                },
                markers: {
                    discrete: [{
                        seriesIndex: 0,
                        dataPointIndex: 7,
                        fillColor: '#000',
                        strokeColor: '#000',
                        size: 5
                    }, {
                        seriesIndex: 2,
                        dataPointIndex: 11,
                        fillColor: '#000',
                        strokeColor: '#000',
                        size: 4
                    }]
                },
                xaxis: {
                    type: 'datetime',
                    tickAmount: 5,
                    crosshairs: {
                        show: true
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    formatter: function(val) {
                        return moment(new Date(val)).format("HH:mm:ss");
                    }
                },
                yaxis: {
                    tickAmount: 4,
                    floating: false,
                    labels: {
                        formatter: function(value, index) {
                            return formatBytes(value)
                        },
                        offsetX: -22,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Quicksand, sans-serif',
                            cssClass: 'apexcharts-yaxis-title',
                        },
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    grid: {
                        borderColor: '#e0e6ed',
                        strokeDashArray: 5,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false,
                            }
                        },
                        padding: {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: -10
                        },
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        offsetY: -50,
                        fontSize: '16px',
                        fontFamily: 'Quicksand, sans-serif',
                        markers: {
                            width: 10,
                            height: 10,
                            strokeWidth: 0,
                            strokeColor: '#fff',
                            fillColors: undefined,
                            radius: 12,
                            onClick: undefined,
                            offsetX: 0,
                            offsetY: 0
                        },
                        itemMargin: {
                            horizontal: 0,
                            vertical: 20
                        }
                    },
                },
                tooltip: {
                    theme: 'dark',
                    marker: {
                        show: true,
                    },
                    x: {
                        format: "HH:mm:ss",
                        show: true,
                    },
                    fixed: {
                        enabled: false,
                        position: 'topRight'
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .28,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
                responsive: [{
                    breakpoint: 575,
                    options: {
                        legend: {
                            offsetY: -30,
                        },
                    },
                }],
                grid: {
                    yaxis: {
                        lines: {
                            offsetX: -30
                        }
                    },
                    padding: {
                        left: 20
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#revenueMonthly"), options);
            chart.render();
        } catch (e) {
            console.log(e);
        }
    </script>
    <script>
        var count = 0;
        var routerId = "{{ request()->query('router') }}";

        function monitor() {
            let name = $("#interface option:selected").text()
            name1 = name.replace('&lt;', '<');
            name2 = name1.replace('&gt;', '>');
            let url = "{{ route('mikapi.dashboard', ':id') }}";
            url = url.replace(':id', name2);
            $.get(url).done(function(res) {
                if (res.status == true) {
                    count++;
                    chart.appendData([{
                        data: [{
                            x: Date.now(),
                            y: res.data['rx-bits-per-second']
                        }],
                    }, {
                        data: [{
                            x: Date.now(),
                            y: res.data['tx-bits-per-second']
                        }],
                    }]);
                } else {
                    Snackbar.show({
                        text: res.message,
                        pos: 'bottom-left'
                    });
                }
            }).fail(function(xhr) {
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

            })
        }

        function dashboard() {
            let url = "{{ route('mikapi.dashboard.get.data') }}?router=" + routerId;
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
            $('#btn_refresh').click(function() {
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

            $('#monitor-tab').click(function() {
                $('#interface').attr('disabled', false);
                clearInterval(i);
                i = setInterval(monitor, 2500)
            })

            $('#log-tab').click(function() {
                $('#interface').attr('disabled', true);
                clearInterval(i);
            })

            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });

            $("#interface").select2({
                tags: true,
                ajax: {
                    delay: 1000,
                    url: "{{ route('mikapi.dashboard') }}",
                    data: function(params) {
                        return {
                            email: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.name,
                                    disabled: item.disabled == 'true' ? true : false,
                                }
                            })
                        };
                    },
                },
                escapeMarkup: function(text) {
                    return text;
                }
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
                    url: "{{ route('mikapi.dashboard') }}?router=" + routerId,
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
                dom: "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
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
                    data: 'time',
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
