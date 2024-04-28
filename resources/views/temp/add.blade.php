<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_add" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="form" action="" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus me-1 bs-tooltip"
                            title="Add Data"></i>Add Data</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label for="server"><i class="fas fa-server me-1 bs-tooltip"
                                    title="Option Server"></i>Server
                                :</label>
                            <select name="server" id="server" class="form-control" style="width: 100%;" required>
                                <option value="">Please Select Server</option>
                            </select>
                            <span id="err_server" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="ip">IP :</label>
                            <input type="text" name="ip" class="form-control mask_ip" id="ip"
                                placeholder="Please Enter ip" minlength="3" maxlength="25" required>
                            <span id="err_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 mb-2">
                            <label class="control-label" for="web">Web :</label>
                            <input type="number" name="web" class="form-control" id="web"
                                placeholder="Please Enter Web" value="0" min="0" required>
                            <span id="err_web" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4 mb-2">
                            <label class="control-label" for="api">Api :</label>
                            <input type="number" name="api" class="form-control" id="api"
                                placeholder="Please Enter Api" value="0" min="0" required>
                            <span id="err_api" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4 mb-2">
                            <label class="control-label" for="win">Win :</label>
                            <input type="number" name="win" class="form-control" id="win"
                                placeholder="Please Enter Win" value="0" min="0" required>
                            <span id="err_win" class="error invalid-feedback" style="display: hide;"></span>
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
