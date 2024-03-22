@extends('layouts.backend.template', ['title' => 'Dashboard'])

@push('css')
    <link href="{{ asset('backend/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <div class="row layout-top-spacing">


        @include('dashboard.components.grafik')
        @include('dashboard.components.donut')
        @include('dashboard.components.vpn_expired')

    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/src/plugins/src/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/src/assets/js/dashboard/dash_2.js') }}"></script>

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
