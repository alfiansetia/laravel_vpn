<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_detail" style="display: none;">
    <div class="widget-content widget-content-area br-8">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab-icon" data-bs-toggle="tab"
                            data-bs-target="#home-tab-icon-pane" type="button" role="tab"
                            aria-controls="home-tab-icon-pane" aria-selected="true">
                            <i data-feather="info" class="bs-tooltip" title="Detail"></i> Detail
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab-icon" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-icon-pane" type="button" role="tab"
                            aria-controls="profile-tab-icon-pane" aria-selected="false"
                            onclick="input_focus('username')">
                            <i data-feather="edit" class="bs-tooltip" title="Edit"></i> Edit
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="simple-pill">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-icon-pane" role="tabpanel"
                            aria-labelledby="home-tab-icon" tabindex="0">
                            <div class="media">
                                <div class="media-body">
                                    <div id="iconsAccordion" class="accordion-icons accordion">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6 col-xl-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="collapsed"
                                                                data-bs-toggle="collapse"
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
                                                            <table class="table"
                                                                style="width: 100%; table-layout: fixed;">
                                                                <tr>
                                                                    <td class="tba">Name Server</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!" data-container="body"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_server_name"
                                                                        id="detail_server_name">Loading..
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>IP Server</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_server_ip"
                                                                        id="detail_server_ip">Loading..
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="tba">Domain Server</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_server_domain"
                                                                        id="detail_server_domain">Loading..
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="tba">IP Netwatch</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_server_netwatch"
                                                                        id="detail_server_netwatch">Loading..
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="tba">Server Status</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_server_status"
                                                                        id="detail_server_status"><span
                                                                            class="badge badge-success">Loading..</span>
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
                                                            <div role="menu" class="collapsed"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#iconAccordionTwo"
                                                                aria-expanded="false"
                                                                aria-controls="iconAccordionTwo">
                                                                <div class="accordion-icon">
                                                                    <i data-feather="share-2"></i>
                                                                </div>
                                                                Info Account <span id="account_status"
                                                                    class="font-sm"></span>
                                                                <div class="icons">
                                                                    <i data-feather="chevron-down"></i>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionTwo"
                                                        class="accordion-collapse collapse show">
                                                        <div class="card-body p-0">
                                                            <table class="table"
                                                                style="width: 100%; table-layout: fixed;">
                                                                <tr>
                                                                    <td class="tba">Username</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_acc_username"
                                                                        id="detail_acc_username">Loading..</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="tba">Password</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_acc_password"
                                                                        id="detail_acc_password">Loading..</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="tba">IP</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_acc_ip"
                                                                        id="detail_acc_ip">
                                                                        Loading..</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="tba">Create On</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_acc_create"
                                                                        id="detail_acc_create">
                                                                        Loading..</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="tba">Expired On</td>
                                                                    <td class="tbb clipboard bs-tooltip"
                                                                        title="Click to copy!"
                                                                        data-clipboard-action="copy"
                                                                        data-clipboard-target="#detail_acc_expired"
                                                                        id="detail_acc_expired">Loading..</td>
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
                                                            <div role="menu" class=""
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#iconAccordionThree"
                                                                aria-expanded="false"
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
                                                    <div id="iconAccordionThree"
                                                        class="accordion-collapse collapse show">
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
                                                            <div role="menu" class=""
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#iconAccordionFour"
                                                                aria-expanded="false"
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
                                                            <select id="select_script" class="form-control mb-2"
                                                                style="width: 100%;">
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

                                    <div class="card-footer text-center">
                                        <button type="button" class="btn btn-secondary close-detail me-1"><i
                                                class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                                        <button type="button" id="share" class="btn btn-info me-1"><i
                                                class="fas fa-share-alt me-1 bs-tooltip"
                                                title="Share"></i>Share</button>
                                        <button type="button" id="wa" class="btn btn-success me-1"><i
                                                class="fab fa-whatsapp me-1 bs-tooltip"
                                                title="Share Whatsapp"></i>WA</button>
                                        <button type="button" id="download" class="btn btn-primary me-1"><i
                                                class="fas fa-download me-1 bs-tooltip"
                                                title="Download Config"></i>Download</button>
                                        <button type="button" id="send_email" class="btn btn-primary me-1"><i
                                                class="fas fa-envelope me-1 bs-tooltip" title="Send Email"></i>Send
                                            Email</button>
                                        <button type="button" id="analyze" class="btn btn-warning me-1"><i
                                                class="fas fa-sync me-1 bs-tooltip"
                                                title="Analyze"></i>Analyze</button>
                                        <button type="button" id="btn_temp" class="btn btn-danger me-1"><i
                                                class="fas fa-sync me-1 bs-tooltip"
                                                title="Move Temporary IP"></i>Temporary</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="profile-tab-icon-pane" role="tabpanel"
                            aria-labelledby="profile-tab-icon" tabindex="0">
                            <div class="media">
                                <div class="media-body">
                                    <form id="formEdit" action="" method="POST">
                                        {{ method_field('PUT') }}
                                        <div class="row mb-2">
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="edit_email"><i class="far fa-envelope me-1 bs-tooltip"
                                                        title="Option Email User"></i>Email
                                                    :</label>
                                                <select name="email" id="edit_email" class="form-control"
                                                    style="width: 100%;" required>
                                                    <option value="">Please Select Email</option>
                                                </select>
                                                <span id="err_edit_email" class="error invalid-feedback"
                                                    style="display: hide;"></span>
                                            </div>
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="edit_server"><i class="fas fa-server me-1 bs-tooltip"
                                                        title="Option Server"></i>Server :</label>
                                                <select name="server" id="edit_server" class="form-control"
                                                    style="width: 100%;" disabled readonly>
                                                    <option value="">Please Select Server</option>
                                                </select>
                                                <span id="err_edit_server" class="error invalid-feedback"
                                                    style="display: hide;"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="edit_username"><i class="far fa-user me-1 bs-tooltip"
                                                        title="Username Vpn"></i>Username Vpn
                                                    :</label>
                                                <input type="text" name="username" class="form-control maxlength"
                                                    id="edit_username" placeholder="Please Enter Username"
                                                    minlength="3" maxlength="50" required>
                                                <span id="err_edit_username" class="error invalid-feedback"
                                                    style="display: hide;"></span>
                                            </div>
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="edit_password"><i
                                                        class="fas fa-fingerprint me-1 bs-tooltip"
                                                        title="Password Vpn"></i>Password Vpn
                                                    :</label>
                                                <input type="text" name="password" class="form-control maxlength"
                                                    id="edit_password" placeholder="Please Enter Password"
                                                    minlength="3" maxlength="50" required>
                                                <span id="err_edit_password" class="error invalid-feedback"
                                                    style="display: hide;"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="edit_ip"><i class="fas fa-ethernet me-1 bs-tooltip"
                                                        title="IP Vpn"></i>IP Vpn :</label>
                                                <input type="text" name="ip" class="form-control"
                                                    id="edit_ip" data-inputmask="'alias': 'ip'"
                                                    placeholder="Please Enter IP Address" data-mask required>
                                                <span id="err_edit_ip" class="error invalid-feedback"
                                                    style="display: hide;"></span>
                                            </div>
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="edit_expired"><i class="fas fa-calendar me-1 bs-tooltip"
                                                        title="Expired"></i>Expired :</label>
                                                <input type="text" id="edit_expired" name="expired"
                                                    class="form-control form-control-solid flatpickr flatpickr-input active"
                                                    placeholder="Select Date.." required>
                                                <span id="err_edit_expired" class="error invalid-feedback"
                                                    style="display: hide;"></span>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="control-label" for="edit_desc"><i
                                                        class="fas fa-map-marker me-1 bs-tooltip"
                                                        title="desc User"></i>Description :</label>
                                                <textarea name="desc" class="form-control maxlength" id="edit_desc" placeholder="Please Enter Description"
                                                    minlength="0" maxlength="100"></textarea>
                                                <span id="err_edit_desc" class="error invalid-feedback"
                                                    style="display: hide;"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-2 col-6 mb-2 mt-2">
                                                <div
                                                    class="switch form-switch-custom switch-inline form-switch-success">
                                                    <input class="switch-input" type="checkbox" role="switch"
                                                        id="edit_is_trial" name="is_trial" checked>
                                                    <label class="switch-label" for="edit_is_trial">Trial</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-6 mb-2 mt-2">
                                                <div
                                                    class="switch form-switch-custom switch-inline form-switch-success">
                                                    <input class="switch-input" type="checkbox" role="switch"
                                                        id="edit_is_active" name="is_active" checked>
                                                    <label class="switch-label" for="edit_is_active">Active</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-6 mb-2 mt-2">
                                                <div
                                                    class="switch form-switch-custom switch-inline form-switch-success">
                                                    <input class="switch-input" type="checkbox" role="switch"
                                                        id="edit_sync" name="sync" checked>
                                                    <label class="switch-label" for="edit_sync">Sync</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            @include('components.form.button_edit')
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
