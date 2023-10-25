@extends('layouts.template')

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/table/datatable/custom_dt_html5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/table/datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/widgets/modules-widgets.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="row layout-top-spacing">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-four">
                <div class="widget-content">

                    <div class="order-summary">

                        <div class="summary-list summary-income">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                </div>

                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Uptime <span class="summary-count" id="sys_up">Loading... </span></h6>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="summary-list summary-profit">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                                        <path
                                            d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                        </path>
                                        <line x1="7" y1="7" x2="7" y2="7"></line>
                                    </svg>
                                </div>
                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Board Name | Model <span class="summary-count" id="sys_rb">Loading...</span>
                                        </h6>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="summary-list summary-expenses">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2">
                                        </rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Router Os <span class="summary-count" id="sys_ros">Loading...</span></h6>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                                                                                                                                                                                                                                                <div class="widget widget-four">

                                                                                                                                                                                                                                                    <div class="widget-content">

                                                                                                                                                                                                                                                        <div class="order-summary">

                                                                                                                                                                                                                                                            <div class="summary-list summary-income">

                                                                                                                                                                                                                                                                <div class="summery-info">

                                                                                                                                                                                                                                                                    <div class="w-icon">
                                                                                                                                                                                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                                                                                                                                                                                                                                                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                                                                                                                                                                                                                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                                                                                                                                                                                                                                                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                                                                                                                                                                                                                                                                        </svg>
                                                                                                                                                                                                                                                                    </div>

                                                                                                                                                                                                                                                                    <div class="w-summary-details">

                                                                                                                                                                                                                                                                        <div class="w-summary-info">
                                                                                                                                                                                                                                                                            <h6>Income <span class="summary-count">$92,600 </span></h6>
                                                                                                                                                                                                                                                                            <p class="summary-average">90%</p>
                                                                                                                                                                                                                                                                        </div>

                                                                                                                                                                                                                                                                    </div>

                                                                                                                                                                                                                                                                </div>

                                                                                                                                                                                                                                                            </div>

                                                                                                                                                                                                                                                            <div class="summary-list summary-profit">

                                                                                                                                                                                                                                                                <div class="summery-info">

                                                                                                                                                                                                                                                                    <div class="w-icon">
                                                                                                                                                                                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                                                                                                                                                                                                                                                                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                                                                                                                                                                                                                            <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                                                                                                                                                                                                                        </svg>
                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                    <div class="w-summary-details">

                                                                                                                                                                                                                                                                        <div class="w-summary-info">
                                                                                                                                                                                                                                                                            <h6>Profit <span class="summary-count">$37,515</span></h6>
                                                                                                                                                                                                                                                                            <p class="summary-average">65%</p>
                                                                                                                                                                                                                                                                        </div>

                                                                                                                                                                                                                                                                    </div>

                                                                                                                                                                                                                                                                </div>

                                                                                                                                                                                                                                                            </div>

                                                                                                                                                                                                                                                            <div class="summary-list summary-expenses">

                                                                                                                                                                                                                                                                <div class="summery-info">

                                                                                                                                                                                                                                                                    <div class="w-icon">
                                                                                                                                                                                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                                                                                                                                                                                                                                                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                                                                                                                                                                                                                                                            <line x1="1" y1="10" x2="23" y2="10"></line>
                                                                                                                                                                                                                                                                        </svg>
                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                    <div class="w-summary-details">

                                                                                                                                                                                                                                                                        <div class="w-summary-info">
                                                                                                                                                                                                                                                                            <h6>Expenses <span class="summary-count">$55,085</span></h6>
                                                                                                                                                                                                                                                                            <p class="summary-average">80%</p>
                                                                                                                                                                                                                                                                        </div>

                                                                                                                                                                                                                                                                    </div>

                                                                                                                                                                                                                                                                </div>

                                                                                                                                                                                                                                                            </div>

                                                                                                                                                                                                                                                        </div>

                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                            </div> -->

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget-four">
                <div class="widget-heading">
                    <h5 class="">Resource</h5>
                </div>
                <div class="widget-content">
                    <div class="vistorsBrowser">
                        <div class="browser-list">
                            <div class="w-icon">
                                <i data-feather="server"></i>
                            </div>
                            <div class="w-browser-details">
                                <div class="w-browser-info">
                                    <h6>CPU</h6>
                                    <p class="browser-count" id="cpu_label">Loading...</p>
                                </div>
                                <div class="w-browser-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-primary" id="cpu" role="progressbar"
                                            style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="browser-list">
                            <div class="w-icon">
                                <i data-feather="server"></i>
                            </div>
                            <div class="w-browser-details">
                                <div class="w-browser-info">
                                    <h6>RAM</h6>
                                    <p class="browser-count" id="ram_label">Loading...</p>
                                </div>
                                <div class="w-browser-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-danger" id="ram" role="progressbar"
                                            style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="browser-list">
                            <div class="w-icon">
                                <i data-feather="server"></i>
                            </div>
                            <div class="w-browser-details">
                                <div class="w-browser-info">
                                    <h6>Disk</h6>
                                    <p class="browser-count" id="disk_label">Loading...</p>
                                </div>
                                <div class="w-browser-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-warning" id="disk" role="progressbar"
                                            style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row widget-statistic">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-one_hybrid widget-engagement">
                        <div class="widget-heading">
                            <div class="w-title" data-toggle="tooltip" title="Open"
                                onclick="window.location.href = `{{ route('mikapi.dashboard') }}`">
                                <div class="w-icon">
                                    <i data-feather="wifi"></i>
                                </div>
                                <div class="">
                                    <p class="w-value" id="hs_active">Loading...</p>
                                    <h5 class="">Hotspot Active</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-title" data-toggle="tooltip" title="Open"
                                onclick="window.location.href = `{{ route('mikapi.dashboard') }}`">
                                <div class="w-icon">
                                    <i data-feather="users"></i>
                                </div>
                                <div class="">
                                    <p class="w-value" id="hs_user">Loading...</p>
                                    <h5 class="">Hotspot User</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-one_hybrid widget-engagement">
                        <div class="widget-heading">
                            <div class="w-title" data-toggle="tooltip" title="Open"
                                onclick="window.location.href = `{{ route('mikapi.dashboard') }}`">
                                <div class="w-icon">
                                    <i data-feather="airplay"></i>
                                </div>
                                <div class="">
                                    <p class="w-value" id="ppp_active">Loading...</p>
                                    <h5 class="">PPP Active</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-title" data-toggle="tooltip" title="Open"
                                onclick="window.location.href = `{{ route('mikapi.dashboard') }}`">
                                <div class="w-icon">
                                    <i data-feather="list"></i>
                                </div>
                                <div class="">
                                    <p class="w-value" id="ppp_secret">Loading...</p>
                                    <h5 class="">PPP Secret</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="widget widget-chart-one">
                <div class="widget-content">
                    <ul class="nav nav-tabs  mb-1 mt-1" id="iconTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="log-tab" data-toggle="tab" href="#log-area" role="tab"
                                aria-controls="log-area" aria-selected="true">
                                <i data-feather="activity"></i> Log
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="monitor-tab" data-toggle="tab" href="#monitor-area" role="tab"
                                aria-controls="monitor-area" aria-selected="false">
                                <i data-feather="bar-chart-2"></i> Monitor
                            </a>
                        </li>
                        <li class="nav-item ml-1" style="max-width: 150px;width: 150px;">
                            <select name="interface" id="interface" class="form-control"
                                style="max-width: 150px;width: 150px;" disabled>
                                <option value="ether1">ether1</option>
                            </select>
                        </li>
                    </ul>
                    <div class="tab-content" id="iconTabContent-1">
                        <div class="tab-pane fade show active" id="log-area" role="tabpanel" aria-labelledby="log-tab">
                            <form method="POST" action="" id="delete">
                                <table id="tableData" class="table table-bordered" style="width: 100%;cursor: pointer;">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="monitor-area" role="tabpanel" aria-labelledby="monitor-tab">
                            <div id="revenueMonthly"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="widget-four">
                <div class="widget-heading">
                    <h5 class="">Panel</h5>
                </div>
                <div class="widget-content">
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary" id="tes">TES</button>

    <button class="btn btn-primary" id="stop">STOP</button>

    {{-- <div class="spinner-border" role="status"> --}}
    </div>
@endsection

@push('js')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>

    <script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>


    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

    <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>

    <script src="{{ asset('assets/js/func.js') }}"></script>

    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                swal(
                    'Failed!',
                    '{{ session('error') }}',
                    'error'
                )
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
            let url = "{{ route('mikapi.dashboard') }}?router=" + routerId;
            $.get(url).done(function(res) {
                if (res.status == true) {
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
                } else {
                    Snackbar.show({
                        text: res.message,
                        pos: 'bottom-left'
                    });
                }
                unblock();
            }).fail(function(xhr) {
                unblock();
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
