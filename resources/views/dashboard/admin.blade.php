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

        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h5 class="">Revenue</h5>
                    <div class="task-action">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="renvenue"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-more-horizontal">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </a>
                            <div class="dropdown-menu left" aria-labelledby="renvenue" style="will-change: transform;">
                                <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                                <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                                <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-content">
                    <div id="revenueMonthly"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-two">
                <div class="widget-heading">
                    <h5 class="">Sales by Category</h5>
                </div>
                <div class="widget-content">
                    <div id="chart-2" class=""></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget-two">
                <div class="widget-content">
                    <div class="w-numeric-value">
                        <div class="w-content">
                            <span class="w-value">Daily sales</span>
                            <span class="w-numeric-title">Go to columns for details.</span>
                        </div>
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-dollar-sign">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-chart">
                        <div id="daily-sales"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-three">
                <div class="widget-heading">
                    <h5 class="">Summary</h5>

                    <div class="task-action">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="summary"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-more-horizontal">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </a>

                            <div class="dropdown-menu left" aria-labelledby="summary" style="will-change: transform;">
                                <a class="dropdown-item" href="javascript:void(0);">View Report</a>
                                <a class="dropdown-item" href="javascript:void(0);">Edit Report</a>
                                <a class="dropdown-item" href="javascript:void(0);">Mark as Done</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="widget-content">

                    <div class="order-summary">

                        <div class="summary-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6">
                                    </line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Income</h6>
                                    <p class="summary-count">$92,600</p>
                                </div>

                                <div class="w-summary-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                            style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                                    <path
                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                    </path>
                                    <line x1="7" y1="7" x2="7" y2="7">
                                    </line>
                                </svg>
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Profit</h6>
                                    <p class="summary-count">$37,515</p>
                                </div>

                                <div class="w-summary-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                            style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2">
                                    </rect>
                                    <line x1="1" y1="10" x2="23" y2="10">
                                    </line>
                                </svg>
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Expenses</h6>
                                    <p class="summary-count">$55,085</p>
                                </div>

                                <div class="w-summary-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-warning" role="progressbar"
                                            style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget-one widget">
                <div class="widget-content">
                    <div class="w-numeric-value">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-shopping-cart">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                </path>
                            </svg>
                        </div>
                        <div class="w-content">
                            <span class="w-value">3,192</span>
                            <span class="w-numeric-title">Total Orders</span>
                        </div>
                    </div>
                    <div class="w-chart">
                        <div id="total-orders"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-two">

                <div class="widget-heading">
                    <h5 class="">New Users</h5>
                </div>

                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="th-content">Name</div>
                                    </th>
                                    <th>
                                        <div class="th-content">Email</div>
                                    </th>
                                    <th>
                                        <div class="th-content">Verified</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($new_users as $item)
                                    <tr>
                                        <td>
                                            <div class="td-content customer-name"><img src="{{ $item->avatar }}"
                                                    alt="avatar"><span>{{ $item->name }}</span></div>
                                        </td>
                                        <td>
                                            <div class="td-content product-brand text-primary">{{ $item->email }}</div>
                                        </td>
                                        <td>
                                            <div class="td-content"><span
                                                    class="badge badge-{{ $item->is_verified() == 'verified' ? 'success' : 'danger' }}">{{ $item->is_verified() }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-three">

                <div class="widget-heading">
                    <h5 class="">Vpn Expired</h5>
                </div>

                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-scroll">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="th-content">Server</div>
                                    </th>
                                    <th>
                                        <div class="th-content th-heading">Username</div>
                                    </th>
                                    <th>
                                        <div class="th-content th-heading">Expired</div>
                                    </th>
                                    <th>
                                        <div class="th-content">Trial</div>
                                    </th>
                                    <th>
                                        <div class="th-content">Active</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($new_expired_vpns as $item)
                                    <tr>
                                        <td>
                                            <div class="td-content">
                                                {{ $item->server->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="td-content">{{ $item->username }}</div>
                                        </td>
                                        <td>
                                            <div class="td-content">{{ $item->expired }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="td-content">{{ $item->is_trial }}</div>
                                        </td>
                                        <td>
                                            <div class="td-content">{{ $item->is_active }}</div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

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
