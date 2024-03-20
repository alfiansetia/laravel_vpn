<form id="form" class="form-vertical" action="" method="POST">
    <div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">
                        <i class="fas fa-plus me-1 bs-tooltip" title="Add Data"></i>Add Data
                    </h5>
                    <button type="button" class="btn-close bs-tooltip" data-bs-dismiss="modal" aria-label="Close"
                        title="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="vpn"><i class="far fa-envelope me-1 bs-tooltip" title="Option VPN"></i>VPN
                            :</label>
                        <select name="vpn" id="vpn" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select VPN</option>
                        </select>
                        <span id="err_vpn" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="from"><i class="fas fa-calendar me-1 bs-tooltip" title="from"></i>From
                            :</label>
                        <input type="text" id="from" name="from"
                            class="form-control form-control-solid flatpickr flatpickr-input active"
                            placeholder="Select Date.." required>
                        <span id="err_from" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="to"><i class="fas fa-calendar me-1 bs-tooltip" title="to"></i>To
                            :</label>
                        <input type="text" id="to" name="to"
                            class="form-control form-control-solid flatpickr flatpickr-input active"
                            placeholder="Select Date.." required>
                        <span id="err_to" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="bank"><i class="far fa-envelope me-1 bs-tooltip" title="Option Bank"></i>Bank
                            :</label>
                        <select name="bank" id="bank" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select Bank</option>
                        </select>
                        <span id="err_bank" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="total"><i class="fas fa-dollar-sign me-1 bs-tooltip" title="total"></i>Total
                            :</label>
                        <input type="number" id="total" name="total" class="form-control form-control-solid"
                            placeholder="Input Total" value="0" min="1" required>
                        <span id="err_total" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                    <button type="reset" id="reset" class="btn btn-warning"><i class="fas fa-undo me-1 bs-tooltip"
                            title="Reset"></i>Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1 bs-tooltip"
                            title="Save"></i>Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="formEdit" class="fofrm-vertical" action="" method="POST">
    {{ method_field('PUT') }}
    <div class="modal animated fade fadeInDown" id="modalEdit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleEdit"><i class="fas fa-edit me-1 bs-tooltip"
                            title="Edit Data"></i>Edit
                        Data</h5>
                    <button type="button" class="btn-close bs-tooltip" data-bs-dismiss="modal" aria-label="Close"
                        title="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_name"><i class="far fa-user me-1 bs-tooltip"
                                title="Full Name User"></i>Name :</label>
                        <input type="text" name="name" class="form-control maxlength" id="edit_name"
                            placeholder="Please Enter Name" minlength="3" maxlength="25" required>
                        <span id="err_edit_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_email"><i class="far fa-envelope me-1 bs-tooltip"
                                title="Email User"></i>Email :</label>
                        <input type="email" name="email" class="form-control maxlength" id="edit_email"
                            placeholder="Please Enter Email" minlength="3" maxlength="50" required>
                        <span id="err_edit_email" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_gender"><i class="fas fa-venus-mars me-1 bs-tooltip"
                                title="Gender User"></i>Gender :</label>
                        <select name="gender" id="edit_gender" class="form-control" style="width: 100%;" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span id="err_edit_gender" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_phone"><i class="fas fa-phone-alt me-1 bs-tooltip"
                                title="Phone User"></i>Phone :</label>
                        <input type="text" name="phone" class="form-control maxlength" id="edit_phone"
                            placeholder="Please Enter Phone" minlength="3" maxlength="15" required>
                        <span id="err_edit_phone" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_password"><i class="fas fa-lock me-1 bs-tooltip"
                                title="Password User"></i>Password :</label>
                        <input type="password" name="edit_password" class="form-control maxlength"
                            id="edit_password" placeholder="Please Enter Password" minlength="0" maxlength="100">
                        <span id="err_edit_password" class="error invalid-feedback" style="display: hide;"></span>
                        <small id="sh-text1" class="form-text text-muted">Leave blank if not change password.</small>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_address"><i class="fas fa-map-marker me-1 bs-tooltip"
                                title="Address User"></i>Address :</label>
                        <textarea name="address" class="form-control maxlength" id="edit_address" placeholder="Please Enter Address"
                            minlength="3" maxlength="100" required></textarea>
                        <span id="err_edit_address" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 col-6 mb-2 mt-2">
                            <div class="switch form-switch-custom switch-inline form-switch-success">
                                <input class="switch-input" type="checkbox" role="switch" id="edit_role"
                                    name="role" checked>
                                <label class="switch-label" for="pricing-includes-texes">Admin</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 mb-2 mt-2">
                            <div class="switch form-switch-custom switch-inline form-switch-success">
                                <input class="switch-input" type="checkbox" role="switch" id="edit_verified"
                                    name="verified" checked>
                                <label class="switch-label" for="pricing-includes-texes">Verified</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 mb-2 mt-2">
                            <div class="switch form-switch-custom switch-inline form-switch-success">
                                <input class="switch-input" type="checkbox" role="switch" id="edit_status"
                                    name="status" checked>
                                <label class="switch-label" for="pricing-includes-texes">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close
                    </button>
                    <button type="button" id="edit_reset" class="btn btn-warning">
                        <i class="fas fa-undo me-1 bs-tooltip" title="Reset"></i>Reset
                    </button>
                    <button type="button" id="edit_delete" class="btn btn-danger">
                        <i class="fas fa-trash me-1 bs-tooltip" title="Delete"></i>Delete
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1 bs-tooltip" title="Save"></i>Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
