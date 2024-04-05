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
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_name">Name :</label>
                            <input type="text" name="name" class="form-control maxlength" id="edit_name"
                                placeholder="Please Enter Name" minlength="1" maxlength="50" required>
                            <span id="err_edit_name" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_password">Password :</label>
                            <input type="text" name="password" class="form-control maxlength" id="edit_password"
                                placeholder="Please Enter Password" minlength="0" maxlength="50">
                            <span id="err_edit_password" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_group">Group :</label>
                            <select name="group" id="edit_group" class="form-control" style="width: 100%;" required>
                                <option value="">Please select Group</option>
                            </select>
                            <span id="err_edit_group" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_ip_address">IP :</label>
                            <input type="text" name="ip_address" class="form-control maxlength mask_ip"
                                id="edit_ip_address" placeholder="Please Enter IP Address" minlength="0"
                                maxlength="18">
                            <span id="err_edit_ip_address" class="error invalid-feedback" style="display: hide;"></span>
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
