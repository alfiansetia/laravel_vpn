<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_detail" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <div class="card">
            <div class="card-header">
                <h5 class="modal-title" id="titleDetail"><i data-feather="info" class="bs-tooltip" title="Detail"></i>
                    Detail</h5>
            </div>
            <div class="card-body">
                <div id="iconsAccordion" class="accordion-icons accordion">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <section class="mb-0 mt-0">
                                        <div role="menu" class="collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#iconAccordionOne" aria-expanded="true"
                                            aria-controls="iconAccordionOne">
                                            <div class="accordion-icon">
                                                <i data-feather="server"></i>
                                            </div>
                                            Info Server
                                            <div class="icons">
                                                <i data-feather="chevron-down"></i>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div id="iconAccordionOne" class="accordion-collapse collapse show">
                                    <div class="card-body p-0">
                                        <table class="table" style="width: 100%; table-layout: fixed;">
                                            <tr>
                                                <td class="tba">Name Server</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-container="body" data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_name" id="detail_server_name">
                                                    Loading..
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>IP Server</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_ip" id="detail_server_ip">
                                                    Loading..
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="tba">Domain Server</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_domain"
                                                    id="detail_server_domain">
                                                    Loading..
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="tba">IP Netwatch</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_netwatch"
                                                    id="detail_server_netwatch">Loading..
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="tba">Server Status</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_status"
                                                    id="detail_server_status">
                                                    <span class="badge badge-success">Loading..</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <section class="mb-0 mt-0">
                                        <div role="menu" class="collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#iconAccordionTwo" aria-expanded="false"
                                            aria-controls="iconAccordionTwo">
                                            <div class="accordion-icon">
                                                <i data-feather="share-2"></i>
                                            </div>
                                            Info Account <span id="account_status" class="font-sm"></span>
                                            <div class="icons">
                                                <i data-feather="chevron-down"></i>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div id="iconAccordionTwo" class="accordion-collapse collapse show">
                                    <div class="card-body p-0">
                                        <table class="table" style="width: 100%; table-layout: fixed;">
                                            <tr>
                                                <td class="tba">Username</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_username"
                                                    id="detail_acc_username">
                                                    Loading..</td>
                                            </tr>
                                            <tr>
                                                <td class="tba">Password</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_password"
                                                    id="detail_acc_password">
                                                    Loading..</td>
                                            </tr>
                                            <tr>
                                                <td class="tba">IP</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_ip" id="detail_acc_ip">
                                                    Loading..</td>
                                            </tr>
                                            <tr>
                                                <td class="tba">Create On</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_create" id="detail_acc_create">
                                                    Loading..</td>
                                            </tr>
                                            <tr>
                                                <td class="tba">Expired On</td>
                                                <td class="tbb clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_expired"
                                                    id="detail_acc_expired">
                                                    Loading..</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <section class="mb-0 mt-0">
                                        <div role="menu" class="" data-bs-toggle="collapse"
                                            data-bs-target="#iconAccordionThree" aria-expanded="false"
                                            aria-controls="iconAccordionThree">
                                            <div class="accordion-icon">
                                                <i data-feather="link"></i>
                                            </div>
                                            URl Remote
                                            <div class="icons">
                                                <i data-feather="chevron-down"></i>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div id="iconAccordionThree" class="accordion-collapse collapse show">
                                    <div class="card-body pt-0 ps-0">
                                        <ul class="list-group" id="table_port">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <section class="mb-0 mt-0">
                                        <div role="menu" class="" data-bs-toggle="collapse"
                                            data-bs-target="#iconAccordionFour" aria-expanded="false"
                                            aria-controls="iconAccordionFour">
                                            <div class="accordion-icon">
                                                <i data-feather="link"></i>
                                            </div>
                                            Script Winbox
                                            <div class="icons">
                                                <i data-feather="chevron-down"></i>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div id="iconAccordionFour" class="accordion-collapse collapse">
                                    <div class="card-body">
                                        <select id="select_script" class="form-control mb-2" style="width: 100%;">
                                            <option value="">PILIH TYPE VPN</option>
                                            <option value="PPTP">PPTP</option>
                                            <option value="L2TP">L2TP</option>
                                            <option value="SSTP">SSTP</option>
                                            <option value="OVPN">OVPN</option>
                                        </select>
                                        <textarea id="script" cols="40" class="form-control clipboard bs-tooltip" title="Click to copy!"
                                            data-clipboard-action="copy" data-clipboard-target="#script"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-secondary close-detail me-1"><i
                                class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                        <button type="button" id="share" class="btn btn-info me-1"><i
                                class="fas fa-share-alt me-1 bs-tooltip" title="Share"></i>Share</button>
                        <button type="button" id="wa" class="btn btn-success me-1"><i
                                class="fab fa-whatsapp me-1 bs-tooltip" title="Share Whatsapp"></i>WA</button>
                        <button type="button" id="download" class="btn btn-primary me-1"><i
                                class="fas fa-download me-1 bs-tooltip" title="Download Config"></i>Download</button>
                        <button type="button" id="btn_extend" class="btn btn-danger me-1"><i
                                class="fas fa-external-link-alt me-1 bs-tooltip"
                                title="Extend With Balance"></i>Extend</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
