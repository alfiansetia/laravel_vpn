<div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus mr-1" data-toggle="tooltip"
                        title="Add Data"></i>Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="email"><i class="far fa-envelope mr-1" data-toggle="tooltip"
                                    title="Option Email User"></i>Email :</label>
                            <select name="email" id="email" class="form-control" style="width: 100%;" required>
                                <option value="">Please Select Email</option>
                            </select>
                            <span id="err_email" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="server"><i class="fas fa-server mr-1" data-toggle="tooltip"
                                    title="Option Server"></i>Server :</label>
                            <select name="server" id="server" class="form-control" style="width: 100%;" required>
                                <option value="">Please Select Server</option>
                            </select>
                            <span id="err_server" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="username"><i class="far fa-user mr-1" data-toggle="tooltip"
                                    title="Username Vpn"></i>Username Vpn :</label>
                            <input type="text" name="username" class="form-control maxlength" id="username"
                                placeholder="Please Enter Username" minlength="4" maxlength="50" required>
                            <span id="err_username" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password"><i class="fas fa-fingerprint mr-1" data-toggle="tooltip"
                                    title="Password Vpn"></i>Password Vpn :</label>
                            <input type="text" name="password" class="form-control maxlength" id="password"
                                placeholder="Please Enter Password" minlength="4" maxlength="50" required>
                            <span id="err_password" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="ip"><i class="fas fa-ethernet mr-1" data-toggle="tooltip"
                                    title="IP Vpn"></i>IP Vpn :</label>
                            <input type="text" name="ip" class="form-control" id="ip"
                                data-inputmask="'alias': 'ip'" placeholder="Please Enter IP Address" data-mask required>
                            <span id="err_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="regist"><i class="fas fa-calendar mr-1" data-toggle="tooltip"
                                    title="Regist"></i>Regist :</label>
                            <input type="text" id="regist" name="regist"
                                class="form-control form-control-solid flatpickr flatpickr-input active"
                                placeholder="Select Date.." required>
                            <span id="err_regist" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label for="masa"><i class="far fa-clock mr-1" data-toggle="tooltip"
                                    title="Option Masa"></i>Masa :</label>
                            <select name="masa" id="masa" class="form-control" style="width: 100%;">
                                <option value="">Trial</option>
                                <option value="1">1 Month</option>
                                <option value="2">2 Month</option>
                                <option value="3">3 Month</option>
                                <option value="4">4 Month</option>
                                <option value="5">5 Month</option>
                                <option value="6">6 Month</option>
                                <option value="12">1 Years</option>
                            </select>
                            <span id="err_masa" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="is_active"><i class="fas fa-check mr-1" data-toggle="tooltip"
                                    title="Option Active"></i>Active :</label>
                            <select name="is_active" id="is_active" class="form-control" style="width: 100%;"
                                required>
                                <option value="">Select Active</option>
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                            <span id="err_is_active" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sync"><i class="fas fa-check mr-1" data-toggle="tooltip"
                                    title="Option Active"></i>Sync :</label>
                            <select name="sync" id="sync" class="form-control" style="width: 100%;"
                                required>
                                <option value="">Select Sync</option>
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                            <span id="err_sync" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"
                        data-toggle="tooltip" title="Close"></i>Close</button>
                <button type="reset" id="reset" class="btn btn-warning"><i class="fas fa-undo mr-1"
                        data-toggle="tooltip" title="Reset"></i>Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                        data-toggle="tooltip" title="Save"></i>Save</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal animated fade fadeInDown" id="modalEdit" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header pl-1">
                <h5>
                    <ul class="nav nav-tabs" id="border-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="border-home-tab" data-toggle="tab" href="#border-home"
                                role="tab" aria-controls="border-home" aria-selected="true">
                                <i data-feather="info"></i> Detail
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="border-profile-tab" data-toggle="tab" href="#border-profile"
                                role="tab" aria-controls="border-profile" aria-selected="false">
                                <i data-feather="edit"></i> Edit
                            </a>
                        </li>
                        <button type="button" class="close ml-auto mr-3" data-dismiss="modal" aria-label="Close"
                            data-toggle="tooltip" title="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </ul>
                </h5>
            </div>
            <div class="modal-body">
                <div class="tab-content mb-4" id="border-tabsContent">
                    <div class="tab-pane fade show active p-0" id="border-home" role="tabpanel"
                        aria-labelledby="border-home-tab">
                        <div class="media">
                            <div class="media-body">
                                <div class="form-row">
                                    <div class="col-xs-12 col-md-6 col-xl-4">
                                        <h3>Info Server</h3>
                                        <table class="table" style="width: 100%; table-layout: fixed;">
                                            <tr>
                                                <td>Name Server</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_name"
                                                    id="detail_server_name">Loading..</td>
                                            </tr>
                                            <tr>
                                                <td>IP Server</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_ip" id="detail_server_ip">
                                                    Loading..</td>
                                            </tr>
                                            <tr>
                                                <td>Domain Server</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_domain"
                                                    id="detail_server_domain">Loading..</td>
                                            </tr>
                                            <tr>
                                                <td>IP Netwatch</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_netwatch"
                                                    id="detail_server_netwatch">Loading..</td>
                                            </tr>
                                            <tr>
                                                <td>Server Type</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_server_type"
                                                    id="detail_server_type"><span
                                                        class="badge badge-success">Loading..</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-xl-4">
                                        <h3>Info Account <span id="account_status" class="font-sm"></span></h3>
                                        <table class="table" style="width: 100%; table-layout: fixed;">
                                            <tr>
                                                <td>Username</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_username"
                                                    id="detail_acc_username">Loading..</td>
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_password"
                                                    id="detail_acc_password">Loading..</td>
                                            </tr>
                                            <tr>
                                                <td>IP</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_ip" id="detail_acc_ip">
                                                    Loading..</td>
                                            </tr>
                                            <tr>
                                                <td>Create On</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_create" id="detail_acc_create">
                                                    Loading..</td>
                                            </tr>
                                            <tr>
                                                <td>Expired On</td>
                                                <td style="width: 10px;text-align: center;">:</td>
                                                <td style="word-wrap: break-word;white-space: normal;text-align: left;"
                                                    class="clipboard bs-tooltip" title="Click to copy!"
                                                    data-clipboard-action="copy"
                                                    data-clipboard-target="#detail_acc_expired"
                                                    id="detail_acc_expired">Loading..</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-xl-4">
                                        <h3>URL Remote</h3>
                                        <table class="table table-sm" id="table_port" style="width: 100%;">
                                        </table>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-xl-8">
                                        <h3>Script Winbox</h3>
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                            class="fas fa-times mr-1" data-toggle="tooltip"
                                            title="Close"></i>Close</button>
                                    <button type="button" id="share" class="btn btn-info"><i
                                            class="fas fa-share-alt mr-1" data-toggle="tooltip"
                                            title="Share"></i>Share</button>
                                    <button type="button" id="wa" class="btn btn-success"><i
                                            class="fab fa-whatsapp mr-1" data-toggle="tooltip"
                                            title="Share Whatsapp"></i>WA</button>
                                    <button type="button" id="download" class="btn btn-success"><i
                                            class="fas fa-download mr-1" data-toggle="tooltip"
                                            title="Download Config"></i>Download</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-0" id="border-profile" role="tabpanel"
                        aria-labelledby="border-profile-tab">
                        <div class="media">
                            <div class="media-body">
                                <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                                    {{ method_field('PUT') }}
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="edit_email"><i class="far fa-envelope mr-1"
                                                    data-toggle="tooltip" title="Option Email User"></i>Email
                                                :</label>
                                            <select name="email" id="edit_email" class="form-control"
                                                style="width: 100%;" required>
                                                <option value="">Please Select Email</option>
                                            </select>
                                            <span id="err_edit_email" class="error invalid-feedback"
                                                style="display: hide;"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="edit_server"><i class="fas fa-server mr-1"
                                                    data-toggle="tooltip" title="Option Server"></i>Server :</label>
                                            <select name="server" id="edit_server" class="form-control"
                                                style="width: 100%;" required>
                                                <option value="">Please Select Server</option>
                                            </select>
                                            <span id="err_edit_server" class="error invalid-feedback"
                                                style="display: hide;"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="edit_username"><i class="far fa-user mr-1"
                                                    data-toggle="tooltip" title="Username Vpn"></i>Username Vpn
                                                :</label>
                                            <input type="text" name="username" class="form-control maxlength"
                                                id="edit_username" placeholder="Please Enter Username" minlength="3"
                                                maxlength="50" required>
                                            <span id="err_edit_username" class="error invalid-feedback"
                                                style="display: hide;"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="edit_password"><i class="fas fa-fingerprint mr-1"
                                                    data-toggle="tooltip" title="Password Vpn"></i>Password Vpn
                                                :</label>
                                            <input type="text" name="password" class="form-control maxlength"
                                                id="edit_password" placeholder="Please Enter Password" minlength="3"
                                                maxlength="50" required>
                                            <span id="err_edit_password" class="error invalid-feedback"
                                                style="display: hide;"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="edit_ip"><i class="fas fa-ethernet mr-1"
                                                    data-toggle="tooltip" title="IP Vpn"></i>IP Vpn :</label>
                                            <input type="text" name="ip" class="form-control" id="edit_ip"
                                                data-inputmask="'alias': 'ip'" placeholder="Please Enter IP Address"
                                                data-mask required>
                                            <span id="err_edit_ip" class="error invalid-feedback"
                                                style="display: hide;"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="edit_regist"><i class="fas fa-calendar mr-1"
                                                    data-toggle="tooltip" title="Regist"></i>Regist :</label>
                                            <input type="text" id="edit_regist" name="regist"
                                                class="form-control form-control-solid flatpickr flatpickr-input active"
                                                placeholder="Select Date.." required>
                                            <span id="err_edit_regist" class="error invalid-feedback"
                                                style="display: hide;"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="edit_masa"><i class="far fa-clock mr-1" data-toggle="tooltip"
                                                    title="Option Masa"></i>Masa :</label>
                                            <select name="masa" id="edit_masa" class="form-control"
                                                style="width: 100%;">
                                                <option value="0">Trial</option>
                                                <option value="1">1 Month</option>
                                                <option value="2">2 Month</option>
                                                <option value="3">3 Month</option>
                                                <option value="4">4 Month</option>
                                                <option value="5">5 Month</option>
                                                <option value="6">6 Month</option>
                                                <option value="12">1 Years</option>
                                            </select>
                                            <span id="err_edit_masa" class="error invalid-feedback"
                                                style="display: hide;"></span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="edit_is_active"><i class="fas fa-check mr-1"
                                                    data-toggle="tooltip" title="Option Active"></i>Active :</label>
                                            <select name="is_active" id="edit_is_active" class="form-control"
                                                style="width: 100%;" required>
                                                <option value="">Select Active</option>
                                                <option value="yes">yes</option>
                                                <option value="no">no</option>
                                            </select>
                                            <span id="err_edit_is_active" class="error invalid-feedback"
                                                style="display: hide;"></span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="edit_sync"><i class="fas fa-check mr-1" data-toggle="tooltip"
                                                    title="Option Active"></i>Sync :</label>
                                            <select name="sync" id="edit_sync" class="form-control"
                                                style="width: 100%;" required>
                                                <option value="">Select Sync</option>
                                                <option value="yes">yes</option>
                                                <option value="no">no</option>
                                            </select>
                                            <span id="err_edit_sync" class="error invalid-feedback"
                                                style="display: hide;"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                                class="fas fa-times mr-1" data-toggle="tooltip"
                                                title="Close"></i>Close</button>
                                        <button type="button" id="edit_reset" class="btn btn-warning"><i
                                                class="fas fa-undo mr-1" data-toggle="tooltip"
                                                title="Reset"></i>Reset</button>
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fas fa-paper-plane mr-1" data-toggle="tooltip"
                                                title="Save"></i>Save</button>
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
