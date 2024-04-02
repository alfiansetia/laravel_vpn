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
                    <div class="row">
                        <div class="form-group col-md-12 mb-2">
                            <label class="control-label" for="edit_mac">MAC :</label>
                            <input type="text" name="mac" class="form-control maxlength mask_mac" id="edit_mac"
                                placeholder="Please Enter MAC" minlength="0" maxlength="18">
                            <span id="err_edit_mac" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_address">Address :</label>
                            <input type="text" name="address" class="form-control maxlength mask_ip"
                                id="edit_address" placeholder="Please Enter Address" minlength="0" maxlength="18">
                            <span id="err_edit_address" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_to_address">To Address :</label>
                            <input type="text" name="to_address" class="form-control maxlength mask_ip"
                                id="edit_to_address" placeholder="Please Enter To Address" minlength="0"
                                maxlength="18">
                            <span id="err_edit_to_address" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_server">Server :</label>
                            <select name="server" id="edit_server" class="form-control" style="width: 100%;">
                                <option value="">Please select server</option>
                            </select>
                            <span id="err_edit_server" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-6 mb-2">
                            <label class="control-label" for="edit_type">Type :</label>
                            <select name="type" id="edit_type" class="form-control select2" required>
                                <option value="regular">Regular</option>
                                <option value="bypassed">Bypassed</option>
                                <option value="blocked">Blocked</option>
                            </select>
                            <span id="err_edit_type" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_comment">Comment :</label>
                        <textarea name="comment" class="form-control maxlength" id="edit_comment" minlength="0" maxlength="100"
                            placeholder="Please Enter Comment"></textarea>
                        <span id="err_edit_comment" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <div class="col-lg-3 col-6 mb-2 mt-2">
                            <div class="switch form-switch-custom switch-inline form-switch-success">
                                <input class="switch-input" type="checkbox" role="switch" id="edit_is_active"
                                    name="is_active" checked>
                                <label class="switch-label" for="edit_is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-12">
                            @include('components.form.button_edit')
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
