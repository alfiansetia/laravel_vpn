<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_edit" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="formEdit" class="fofrm-vertical" action="" method="POST">
            {{ method_field('PUT') }}
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="titleEdit"><i class="fas fa-edit me-1 bs-tooltip"
                            title="Edit Data"></i>Edit Data</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_vpn"><i class="fas fa-network-wired me-1 bs-tooltip"
                                title="VPN"></i>VPN :</label>
                        <select name="vpn" id="edit_vpn" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select VPN</option>
                        </select>
                        <span id="err_edit_vpn" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_name"><i class="far fas fa-clone me-1 bs-tooltip"
                                title="Session Name"></i>Session Name :</label>
                        <input type="text" name="name" class="form-control maxlength" id="edit_name"
                            placeholder="Please Enter Session Name" minlength="3" maxlength="50" required>
                        <span id="err_edit_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_hsname"><i class="fas fas fa-wifi me-1 bs-tooltip"
                                title="HS Name"></i>HS Name :</label>
                        <input type="text" name="hsname" class="form-control maxlength" id="edit_hsname"
                            placeholder="Please Enter HS Name" minlength="3" maxlength="50" required>
                        <span id="err_edit_hsname" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_dnsname"><i
                                class="fas fas fa-project-diagram me-1 bs-tooltip" title="DNS Name"></i>DNS Name
                            :</label>
                        <input type="text" name="dnsname" class="form-control maxlength" id="edit_dnsname"
                            placeholder="Please Enter DNS Name" minlength="3" maxlength="50" required>
                        <span id="err_edit_dnsname" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_username"><i class="fas fa-user me-1 bs-tooltip"
                                title="Username"></i>Username :</label>
                        <input type="text" name="username" class="form-control maxlength" id="edit_username"
                            placeholder="Please Enter Username" minlength="3" maxlength="50" required>
                        <span id="err_edit_username" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_password"><i class="fas fa-lock me-1 bs-tooltip"
                                title="Password"></i>Password :</label>
                        <input type="password" name="password" class="form-control maxlength" id="edit_password"
                            placeholder="Please Enter Password" minlength="0" maxlength="100">
                        <div class="mt-1">
                            <span class="badge badge-primary w-100">
                                <small id="sh-text4" class="form-text mt-0 text-left">Kosongkan jika tidak ingin
                                    mengganti password!</small>
                            </span>
                        </div>
                        <span id="err_edit_password" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-12">

                            @include('components.form.button_edit')

                            <button type="button" class="btn btn-secondary" id="btn_ping">
                                <i class="fas fa-plug me-1 bs-tooltip" title="Ping"></i>Ping
                            </button>

                            <button type="button" class="btn btn-info" id="btn_open">
                                <i class="fas fa-rocket me-1 bs-tooltip" title="Open"></i>Open
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
