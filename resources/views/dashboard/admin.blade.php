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
                                <i data-feather="more-horizontal"></i>
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
