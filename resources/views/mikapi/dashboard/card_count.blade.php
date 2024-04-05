<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="row widget-statistic">
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 layout-spacing">
            <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                    <div class="w-title" data-toggle="tooltip" title="Open"
                        onclick="window.location.href = `{{ route('mikapi.hotspot.active') }}${param_router}`">
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
                        onclick="window.location.href = `{{ route('mikapi.hotspot.user') }}${param_router}`">
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
                        onclick="window.location.href = `{{ route('mikapi.ppp.active') }}${param_router}`">
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
                        onclick="window.location.href = `{{ route('mikapi.ppp.secret') }}${param_router}`">
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
