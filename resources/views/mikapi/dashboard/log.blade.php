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
                    <select name="interface" id="interface" class="form-control" style="max-width: 150px;width: 150px;"
                        disabled>
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
