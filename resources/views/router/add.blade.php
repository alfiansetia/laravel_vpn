<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_add" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="form" action="" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus me-1 bs-tooltip"
                            title="Add Data"></i>Add Data</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label class="control-label" for="vpn"><i class="fas fa-network-wired me-1 bs-tooltip"
                                title="VPN"></i>VPN :</label>
                        <select name="vpn" id="vpn" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select VPN</option>
                        </select>
                        <span id="err_vpn" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="name"><i class="fas fa-clone me-1 bs-tooltip"
                                title="Session Name"></i>Session Name :</label>
                        <input type="text" name="name" class="form-control maxlength" id="name"
                            placeholder="Please Enter Session Name" minlength="3" maxlength="50" required>
                        <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="hsname"><i class="fas fa-wifi me-1 bs-tooltip"
                                title="HS Name"></i>HS
                            Name :</label>
                        <input type="text" name="hsname" class="form-control maxlength" id="hsname"
                            placeholder="Please Enter HS Name" minlength="3" maxlength="50" required>
                        <span id="err_hsname" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="dnsname"><i class="fas fa-project-diagram me-1 bs-tooltip"
                                title="DNS Name"></i>DNS Name :</label>
                        <input type="text" name="dnsname" class="form-control maxlength" id="dnsname"
                            placeholder="Please Enter DNS Name" minlength="3" maxlength="50" required>
                        <span id="err_dnsname" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="username"><i class="fas fa-user me-1 bs-tooltip"
                                title="Username"></i>Username :</label>
                        <input type="text" name="username" class="form-control maxlength" id="username"
                            placeholder="Please Enter Username" minlength="3" maxlength="50" required>
                        <span id="err_username" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="password"><i class="fas fa-lock me-1 bs-tooltip"
                                title="Password"></i>Password :</label>
                        <input type="text" name="password" class="form-control maxlength" id="password"
                            placeholder="Please Enter Password" minlength="5" maxlength="100" required>
                        <span id="err_password" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-12">
                            @include('components.form.button_add')
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
