@extends('layouts.backend.template_mikapi', ['title' => 'Monitor Interface'])
@push('csslib')
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/plugins/src/notification/snackbar/snackbar.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/plugins/css/light/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/plugins/css/dark/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')
    <div class="row" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_detail">
            <div class="widget-content widget-content-area br-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" id="exampleModalLongTitle">
                            <i class="fas fa-info me-1 bs-tooltip" title="Detail Resource"></i>Monitor Interface
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id="interface"></div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="row">
                            <div class="form-group col-md-8 mb-2">
                                <select name="interface" id="select_interface" class="form-control select2">
                                    <option value="">Select Interface</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 mb-2 d-grid gap-2">
                                <button type="button" id="btn_stop" class="btn btn-lg btn-primary">Stop</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('jslib')
    <script src="{{ asset('backend/src/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/select2/custom-select2.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/apex/apexcharts.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/notification/snackbar/snackbar.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/moment/moment-with-locales.min.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endpush
@push('js')
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/func.js') }}"></script>
    <script src="{{ asset('js/mikapi.js') }}"></script>
    <script>
        // $(document).ready(function() {



        $(document).ready(function() {
            var i;
            var j;
            var options = {
                series: [{
                    name: 'RX',
                    data: []
                }, {
                    name: 'TX',
                    data: []
                }],
                chart: {
                    animations: {
                        enabled: true,
                        easing: 'linear',
                        dynamicAnimation: {
                            speed: 1000
                        }
                    },
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
                    tickAmount: 10,
                    crosshairs: {
                        show: true
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        formatter: function(value, timestamp, opts) {
                            return moment(new Date(value)).format("HH:mm:ss");
                        },
                    },
                },
                yaxis: {
                    tickAmount: 5,
                    floating: false,
                    labels: {
                        formatter: function(value, index) {
                            return formatBytes(value)
                        },
                        offsetX: -15,
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
            var chart = new ApexCharts(document.querySelector("#interface"), options);
            chart.render();

            $("#select_interface").select2({
                placeholder: 'Select Interface',
                allowClear: true,
                ajax: {
                    delay: 1000,
                    url: "{{ route('api.mikapi.interfaces.index') }}" + param_router,
                    data: function(params) {
                        return {
                            name: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.name,
                                    id: item['.id'],
                                    disabled: item.disabled,
                                }
                            })
                        };
                    },
                }
            }).on('change', function() {
                get_interval()
            })

            $("#btn_stop").click(function() {
                clearInterval(i)
            })


            function get_interval() {
                clearInterval(i)
                let id = $('#select_interface').val()
                if (id != '') {
                    get_data(id)
                    i = setInterval(function() {
                        get_data(id)
                    }, 2500)
                }
            }

            function get_data(id) {
                let url = "{{ route('api.mikapi.interfaces.monitor', ':id') }}" + param_router
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(result) {
                        chart.appendData([{
                            data: [{
                                x: Date.now(),
                                y: result.data[0]['rx-bits-per-second']
                            }],
                        }, {
                            data: [{
                                x: Date.now(),
                                y: result.data[0]['tx-bits-per-second']
                            }],
                        }]);
                    },
                    beforeSend: function() {},
                    error: function(xhr, status, error) {
                        clearInterval(i)
                        handleResponse(xhr)
                    }
                });
            }
        })


        // });
    </script>
@endpush
