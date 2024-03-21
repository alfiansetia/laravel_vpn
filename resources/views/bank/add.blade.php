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
                        <label class="control-label" for="name"><i class="far fa-user me-1 bs-tooltip"
                                title="Name"></i>Name :</label>
                        <input type="text" name="name" class="form-control maxlength" id="name"
                            placeholder="Please Enter Name" minlength="2" maxlength="100" required>
                        <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="acc_name"><i class="fas fa-file-signature me-1 bs-tooltip"
                                title="Acc Name"></i>Acc Name :</label>
                        <input type="text" name="acc_name" class="form-control maxlength" id="acc_name"
                            placeholder="Please Enter Acc Name" minlength="1" maxlength="100" required>
                        <span id="err_acc_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="acc_number"><i
                                class="fas fa-file-invoice-dollar me-1 bs-tooltip" title="Acc Name"></i>Acc Number
                            :</label>
                        <input type="text" name="acc_number" class="form-control maxlength" id="acc_number"
                            placeholder="Please Enter Acc Name" minlength="1" maxlength="100" required>
                        <span id="err_acc_number" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <div class="col-lg-2 col-6 mb-2 mt-2">
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
                            <button type="button" class="btn btn-secondary show-index"><i
                                    class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                            <button type="reset" id="reset" class="btn btn-warning"><i
                                    class="fas fa-undo me-1 bs-tooltip" title="Reset"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1 bs-tooltip"
                                    title="Save"></i>Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
