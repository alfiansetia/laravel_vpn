@extends('layouts.backend.template_mikapi', ['title' => 'System Routerboard'])
@push('csslib')
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="row" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="simple-pill">
                    <div class="card">

                        <div class="card-header">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active rb_refresh" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Routerboard</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rb_refresh_st" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Settings</button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab" tabindex="0">
                                        <table class="table" id="tbl_routerboard" style="font-size: large">
                                        </table>
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-warning rb_refresh">
                                                <i class="fas fa-undo me-1 bs-tooltip" title="Refresh Data"></i>Refresh
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab" tabindex="0">
                                        <table class="table" id="tbl_routerboard_setting" style="font-size: large">
                                        </table>
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-warning rb_refresh_st">
                                                <i class="fas fa-undo me-1 bs-tooltip" title="Refresh Data"></i>Refresh
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('jslib')
    <!-- END PAGE LEVEL SCRIPTS -->
@endpush


@push('js')
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/func.js') }}"></script>
    <script src="{{ asset('js/mikapi.js') }}"></script>
    <script>
        // $(document).ready(function() {

        var url1 = "{{ route('api.mikapi.system.routerboards.index') }}" + param_router
        var url2 = "{{ route('api.mikapi.system.routerboards.settings') }}" + param_router

        $(document).ready(function() {
            routerboard(url1, 'tbl_routerboard')

            $('.rb_refresh').click(function() {
                routerboard(url1, 'tbl_routerboard')
            })

            $('.rb_refresh_st').click(function() {
                routerboard(url2, 'tbl_routerboard_setting')
            })
        })

        function routerboard(url, table) {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(result) {
                    unblock();
                    $(`#${table}`).empty()
                    Object.keys(result.data[0]).forEach(function(key) {
                        $(`#${table}`).append(`<tr>
                        <td style="width:30%">${key}</td>
                        <td style="width:2%">:</td>
                        <td style="width:68%">${result.data[0][key]}</td>
                    </tr>`)
                    });
                },
                beforeSend: function() {
                    $(`#${table}`).empty()
                    $(`#${table}`).append(`<tr>
                <td colspan="3" style="width:30%">Loading....</td>
            </tr>`)
                    block();
                },
                error: function(xhr, status, error) {
                    unblock();
                    handleResponse(xhr)
                }
            });
        }

        // });
    </script>
@endpush
