@extends('layouts.backend.template_mikapi', ['title' => 'System Resource'])
@push('csslib')
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="row" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_detail">
            <div class="widget-content widget-content-area br-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" id="exampleModalLongTitle"><i class="fas fa-info me-1 bs-tooltip"
                                title="Detail Resource"></i>Detail Resource</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table" id="tbl_resource" style="font-size: large">
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="refresh" class="btn btn-warning">
                                    <i class="fas fa-undo me-1 bs-tooltip" title="Refresh Data"></i>Refresh
                                </button>
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
        var url1 = "{{ route('api.mikapi.system.resources.index') }}" + param_router

        $(document).ready(function() {
            routerboard(url1, 'tbl_resource')

            $('#refresh').click(function() {
                routerboard(url1,
                    'tbl_resource')
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
