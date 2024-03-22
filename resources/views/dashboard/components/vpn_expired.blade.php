<div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-table-three">

        <div class="widget-heading">
            <h5 class="">Vpn Expired</h5>
        </div>

        <div class="widget-content">
            @if (count($new_expired_vpns) > 0)
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
            @else
                <div class="alert alert-danger layout-top-spacing" role="alert">
                    No Expired VPN Found!
                </div>
            @endif
        </div>
    </div>
</div>
