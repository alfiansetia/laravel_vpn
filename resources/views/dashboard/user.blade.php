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

        @include('dashboard.components.vpn_expired')
        @include('dashboard.components.donut')

    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/src/plugins/src/apex/apexcharts.min.js') }}"></script>

    <script>
        window.addEventListener("load", function() {

            try {
                getcorkThemeObject = localStorage.getItem("theme");
                getParseObject = JSON.parse(getcorkThemeObject)
                ParsedObject = getParseObject;

                var chart_type = {
                    type: 'donut',
                    width: 385,
                    height: 365
                }
                var chart_legend = {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    fontSize: '14px',
                    markers: {
                        width: 10,
                        height: 10,
                        offsetX: -5,
                        offsetY: 0
                    },
                    itemMargin: {
                        horizontal: 10,
                        vertical: 30
                    }
                }
                var chart_color = ['#1abc9c', '#e2a03f', '#e7515a', '#e2a03f']

                var chart_plot = {
                    pie: {
                        donut: {
                            size: '75%',
                            background: 'transparent',
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '29px',
                                    fontFamily: 'Nunito, sans-serif',
                                    color: undefined,
                                    offsetY: -10
                                },
                                value: {
                                    show: true,
                                    fontSize: '26px',
                                    fontFamily: 'Nunito, sans-serif',
                                    color: '#0e1726',
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
                                    fontSize: '30px',
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce(function(a, b) {
                                            return a + b
                                        }, 0)
                                    }
                                }
                            }
                        }
                    }
                }

                var chart_res = [{
                        breakpoint: 1440,
                        options: {
                            chart: {
                                width: 325
                            },
                        }
                    },
                    {
                        breakpoint: 1199,
                        options: {
                            chart: {
                                width: 380
                            },
                        }
                    },
                    {
                        breakpoint: 575,
                        options: {
                            chart: {
                                width: 320
                            },
                        }
                    },
                ]
                var chart_series = [parseInt("{{ $data_vpn['active'] ?? 0 }}"), parseInt(
                        "{{ $data_vpn['trial'] ?? 0 }}"),
                    parseInt("{{ $data_vpn['nonactive'] ?? 0 }}")
                ]

                if (ParsedObject.settings.layout.darkMode) {

                    var Theme = 'dark';

                    Apex.tooltip = {
                        theme: Theme
                    }

                    var options = {
                        chart: chart_type,
                        colors: chart_color,
                        dataLabels: {
                            enabled: false
                        },
                        legend: chart_legend,
                        plotOptions: chart_plot,
                        stroke: {
                            show: true,
                            width: 15,
                            colors: '#0e1726'
                        },
                        series: chart_series,
                        labels: ['Active', 'Trial', 'Nonactive'],

                        responsive: chart_res,
                    }

                } else {

                    var Theme = 'dark';

                    Apex.tooltip = {
                        theme: Theme
                    }
                    var options = {
                        chart: chart_type,
                        colors: chart_color,
                        dataLabels: {
                            enabled: false
                        },
                        legend: chart_legend,
                        plotOptions: chart_plot,
                        stroke: {
                            show: true,
                            width: 15,
                            colors: '#fff'
                        },
                        series: chart_series,
                        labels: ['Active', 'Trial', 'Nonactive'],

                        responsive: chart_res,
                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#chart-2"),
                    options
                );

                chart.render();

                /*
                    =============================================
                        Perfect Scrollbar | Recent Activities
                    =============================================
                */
                const ps = new PerfectScrollbar(document.querySelector('.mt-container-ra'));

                /**
                 * =================================================================================================
                 * |     @Re_Render | Re render all the necessary JS when clicked to switch/toggle theme           |
                 * =================================================================================================
                 */

                document.querySelector('.theme-toggle').addEventListener('click', function() {
                    getcorkThemeObject = localStorage.getItem("theme");
                    getParseObject = JSON.parse(getcorkThemeObject)
                    ParsedObject = getParseObject;

                    if (ParsedObject.settings.layout.darkMode) {
                        chart.updateOptions({
                            stroke: {
                                colors: '#0e1726'
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        labels: {
                                            value: {
                                                color: '#bfc9d4'
                                            }
                                        }
                                    }
                                }
                            }
                        })
                    } else {
                        chart.updateOptions({
                            stroke: {
                                colors: '#fff'
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        labels: {
                                            value: {
                                                color: '#0e1726'
                                            }
                                        }
                                    }
                                }
                            }
                        })
                    }
                })
            } catch (e) {
                console.log(e);
            }
        })
    </script>
@endpush
