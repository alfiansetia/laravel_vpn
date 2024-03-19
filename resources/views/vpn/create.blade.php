<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_add" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="form" action="" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus me-1 bs-tooltip"
                            title="Add Data"></i>Add Data</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="form-group col-md-6">
                            <label for="email"><i class="far fa-envelope me-1 bs-tooltip"
                                    title="Option Email User"></i>Email
                                :</label>
                            <select name="email" id="email" class="form-control" style="width: 100%;" required>
                                <option value="">Please Select Email</option>
                            </select>
                            <span id="err_email" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="server"><i class="fas fa-server me-1 bs-tooltip"
                                    title="Option Server"></i>Server
                                :</label>
                            <select name="server" id="server" class="form-control" style="width: 100%;" required>
                                <option value="">Please Select Server</option>
                            </select>
                            <span id="err_server" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-6">
                            <label for="username"><i class="far fa-user me-1 bs-tooltip"
                                    title="Username Vpn"></i>Username Vpn
                                :</label>
                            <input type="text" name="username" class="form-control maxlength" id="username"
                                placeholder="Please Enter Username" minlength="4" maxlength="50" required>
                            <span id="err_username" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password"><i class="fas fa-fingerprint me-1 bs-tooltip"
                                    title="Password Vpn"></i>Password Vpn :</label>
                            <input type="text" name="password" class="form-control maxlength" id="password"
                                placeholder="Please Enter Password" minlength="4" maxlength="50" required>
                            <span id="err_password" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-6">
                            <label for="ip"><i class="fas fa-ethernet me-1 bs-tooltip" title="IP Vpn"></i>IP Vpn
                                :</label>
                            <input type="text" name="ip" class="form-control" id="ip"
                                data-inputmask="'alias': 'ip'" placeholder="Please Enter IP Address" data-mask required>
                            <span id="err_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="expired"><i class="fas fa-calendar me-1 bs-tooltip" title="Expired"></i>Expired
                                :</label>
                            <input type="text" id="expired" name="expired"
                                class="form-control form-control-solid flatpickr flatpickr-input active"
                                placeholder="Select Date.." required>
                            <span id="err_expired" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-2 col-6 mb-2 mt-2">
                            <div class="switch form-switch-custom switch-inline form-switch-success">
                                <input class="switch-input" type="checkbox" role="switch" id="is_active"
                                    name="is_active" checked>
                                <label class="switch-label" for="is_active">Active</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 mb-2 mt-2">
                            <div class="switch form-switch-custom switch-inline form-switch-success">
                                <input class="switch-input" type="checkbox" role="switch" id="sync"
                                    name="sync" checked>
                                <label class="switch-label" for="sync">Sync</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-secondary close-add"><i
                                    class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                            <button type="reset" id="reset" class="btn btn-warning"><i
                                    class="fas fa-undo me-1 bs-tooltip" title="Reset"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i
                                    class="fas fa-paper-plane me-1 bs-tooltip" title="Save"></i>Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
