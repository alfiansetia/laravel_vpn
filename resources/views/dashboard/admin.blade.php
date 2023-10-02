@extends('layouts.template')

@push('css')
    <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/widgets/modules-widgets.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css">

    <link href="assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row layout-top-spacing">

        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-activity-five">

                <div class="widget-heading">
                    <h5 class="">Activity Log</h5>

                    <div class="task-action">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask"
                                style="will-change: transform;">
                                <a class="dropdown-item" href="">View All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Mark as Read</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-content">

                    <div class="w-shadow-top"></div>

                    <div class="mt-container mx-auto">
                        <div class="timeline-line" id="activity">
                            <div class="item-timeline timeline-new">
                                <div class="t-dot">
                                    <div class="t-primary">
                                        <i data-feather="alert-circle"></i>
                                    </div>

                                </div>
                                <div class="t-content">
                                    <div class="t-uppercontent">
                                        <h5>admin@gmail.com => deleted data</h5>
                                    </div>
                                    <p>127.0.0.1, 27 dec 2022 </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="w-shadow-bottom"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-two">
                <div class="widget-heading">
                    <h5 class="">Data VPN</h5>
                </div>
                <div class="widget-content">
                    <div id="chart-2" class=""></div>
                </div>
            </div>
        </div>



    </div>
@endsection

@push('js')
    <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/widgets/modules-widgets.js') }}"></script> -->

    <script>
        var options = {
            chart: {
                type: 'donut',
                width: 380
            },
            colors: ['#1abc9c', '#e2a03f', '#e7515a', '#e2a03f'],
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                    width: 10,
                    height: 10,
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 8
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '29px',
                                fontFamily: 'Quicksand, sans-serif',
                                color: undefined,
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '26px',
                                fontFamily: 'Quicksand, sans-serif',
                                color: '20',
                                offsetY: 16,
                                formatter: function(val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: 'Total',
                                color: '#888ea8',
                                formatter: function(w) {
                                    return w.globals.seriesTotals.reduce(function(a, b) {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                show: true,
                width: 25,
            },
            series: [parseInt("{{ $data_vpn['active'] }}"), parseInt("{{ $data_vpn['trial'] }}"), parseInt(
                "{{ $data_vpn['nonactive'] }}")],
            labels: ['Active', 'Trial', 'Nonactive'],
            responsive: [{
                breakpoint: 1599,
                options: {
                    chart: {
                        width: '350px',
                        height: '400px'
                    },
                    legend: {
                        position: 'bottom'
                    }
                },

                breakpoint: 1439,
                options: {
                    chart: {
                        width: '250px',
                        height: '390px'
                    },
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                            }
                        }
                    }
                },
            }]
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-2"),
            options
        );
        /*
            =============================================
                Perfect Scrollbar | Notifications
            =============================================
        */
        const ps = new PerfectScrollbar(document.querySelector('.mt-container'));

        chart.render();
    </script>
@endpush
