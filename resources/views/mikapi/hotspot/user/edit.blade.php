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
                            <label class="control-label" for="edit_server">Server :</label>
                            <select name="server" id="edit_server" class="form-control" style="width: 100%;" required>
                                <option value="">Please select server</option>
                            </select>
                            <span id="err_edit_server" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_profile">Profile :</label>
                            <select name="profile" id="edit_profile" class="form-control" style="width: 100%;" required>
                                <option value="">Please select Profile</option>
                            </select>
                            <span id="err_edit_profile" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_name">Name :</label>
                            <input type="text" name="name" class="form-control maxlength" id="edit_name"
                                placeholder="Please Enter Name" minlength="3" maxlength="50" required>
                            <span id="err_edit_name" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_password">Password :</label>
                            <input type="text" name="password" class="form-control maxlength" id="edit_password"
                                placeholder="Please Enter Password" minlength="3" maxlength="50" required>
                            <span id="err_edit_password" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_ip_address">IP :</label>
                            <input type="text" name="ip_address" class="form-control maxlength" id="edit_ip_address"
                                data-inputmask="'alias': 'ip'" data-mask placeholder="Please Enter IP Address"
                                minlength="0" maxlength="18">
                            <span id="err_edit_ip_address" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="mac">MAC :</label>
                            <input type="text" name="mac" class="form-control maxlength" id="mac"
                                data-inputmask="'alias': 'mac'" data-mask placeholder="Please Enter MAC" minlength="0"
                                maxlength="18">
                            <span id="err_mac" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-12" for="time_edit_limit">Time Limit :</label>
                        <div class="col-6">
                            <select name="data_day" id="edit_data_day" class="form-control">
                                <option value="">0 Day</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <input type="text" name="time_limit" class="form-control" id="edit_time_limit"
                                placeholder="Please Enter Time Limit">
                        </div>
                        <span id="err_edit_time_limit" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-12" for="edit_data_limit">Data Limit :</label>
                        <div class="col-6">
                            <input type="number" name="data_limit" class="form-control" id="edit_data_limit"
                                placeholder="Please Enter Data Limit">
                        </div>
                        <div class="col-6">
                            <select name="data_type" id="edit_data_type" class="form-control">
                                <option value="M">MB</option>
                                <option value="G">GB</option>
                            </select>
                        </div>
                        <span id="err_edit_data_limit" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_comment">Comment :</label>
                        <textarea name="comment" class="form-control" id="edit_comment" minlength="0" maxlength="100"
                            placeholder="Please Enter Comment"></textarea>
                        <span id="err_edit_comment" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="n-chk">
                        <label class="new-control new-radio radio-success" data-toggle="tooltip"
                            title="User = Active">
                            <input type="radio" class="new-control-input" name="is_active" checked value="1">
                            <span class="new-control-indicator"></span>Active
                        </label>
                        <label class="new-control new-radio radio-danger" data-toggle="tooltip"
                            title="User = NonActive">
                            <input type="radio" class="new-control-input" name="is_active" value="0">
                            <span class="new-control-indicator"></span>Nonactive
                        </label>
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
