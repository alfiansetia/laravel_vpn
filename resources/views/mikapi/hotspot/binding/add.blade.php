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
                        <div class="form-group col-md-12 mb-2">
                            <label class="control-label" for="mac">MAC :</label>
                            <input type="text" name="mac" class="form-control maxlength mask_mac" id="mac"
                                placeholder="Please Enter MAC" minlength="0" maxlength="18">
                            <span id="err_mac" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="address">Address :</label>
                            <input type="text" name="address" class="form-control maxlength mask_ip" id="address"
                                placeholder="Please Enter Address" minlength="0" maxlength="18">
                            <span id="err_address" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="to_address">To Address :</label>
                            <input type="text" name="to_address" class="form-control maxlength mask_ip"
                                id="to_address" placeholder="Please Enter To Address" minlength="0" maxlength="18">
                            <span id="err_to_address" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="server">Server :</label>
                            <select name="server" id="server" class="form-control" style="width: 100%;">
                                <option value="">Please select server</option>
                            </select>
                            <span id="err_server" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-6 mb-2">
                            <label class="control-label" for="type">Type :</label>
                            <select name="type" id="type" class="form-control select2">
                                <option value="">Regular</option>
                                <option value="bypassed">Bypassed</option>
                                <option value="blocked">Blocked</option>
                            </select>
                            <span id="err_type" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="comment">Comment :</label>
                        <textarea name="comment" class="form-control maxlength" id="comment" minlength="0" maxlength="100"
                            placeholder="Please Enter Comment"></textarea>
                        <span id="err_comment" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <div class="col-lg-3 col-6 mb-2 mt-2">
                            <div class="switch form-switch-custom switch-inline form-switch-success">
                                <input class="switch-input" type="checkbox" role="switch" id="is_active"
                                    name="is_active" checked>
                                <label class="switch-label" for="is_active">Active</label>
                            </div>
                        </div>
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
