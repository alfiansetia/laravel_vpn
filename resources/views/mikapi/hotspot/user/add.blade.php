<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_add" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="form" action="" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" id="exampleModalLongTitle"><i class="fas fa-plus me-1 bs-tooltip"
                            title="Add Data"></i>Add Data</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="server">Server :</label>
                            <select name="server" id="server" class="form-control" style="width: 100%;" required>
                                <option value="">Please select server</option>
                            </select>
                            <span id="err_server" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="profile">Profile :</label>
                            <select name="profile" id="profile" class="form-control" style="width: 100%;" required>
                                <option value="">Please select Profile</option>
                            </select>
                            <span id="err_profile" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="name">Name :</label>
                            <input type="text" name="name" class="form-control maxlength" id="name"
                                placeholder="Please Enter Name" minlength="3" maxlength="50" required>
                            <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="password">Password :</label>
                            <input type="text" name="password" class="form-control maxlength" id="password"
                                placeholder="Please Enter Password" minlength="3" maxlength="50" required>
                            <span id="err_password" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="ip_address">IP :</label>
                            <input type="text" name="ip_address" class="form-control maxlength" id="ip_address"
                                data-inputmask="'alias': 'ip'" data-mask placeholder="Please Enter IP Address"
                                minlength="0" maxlength="18">
                            <span id="err_ip_address" class="error invalid-feedback" style="display: hide;"></span>
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
                        <label class="col-12" for="time_limit">Time Limit :</label>
                        <div class="col-6">
                            <select name="data_day" id="data_day" class="form-control">
                                <option value="">0 Day</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <input type="text" name="time_limit" class="form-control" id="time_limit"
                                placeholder="Please Enter Time Limit">
                        </div>
                        <span id="err_time_limit" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-12" for="data_limit">Data Limit :</label>
                        <div class="col-6">
                            <input type="number" name="data_limit" class="form-control" id="data_limit"
                                placeholder="Please Enter Data Limit">
                        </div>
                        <div class="col-6">
                            <select name="data_type" id="data_type" class="form-control">
                                <option value="M">MB</option>
                                <option value="G">GB</option>
                            </select>
                        </div>
                        <span id="err_data_limit" class="error invalid-feedback" style="display: hide;"></span>
                    </div>

                    <div class="form-group mb-2">
                        <label class="control-label" for="comment">Comment :</label>
                        <textarea name="comment" class="form-control" id="comment" minlength="0" maxlength="100"
                            placeholder="Please Enter Comment"></textarea>
                        <span id="err_comment" class="error invalid-feedback" style="display: hide;"></span>
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
                            @include('components.form.button_add')
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
