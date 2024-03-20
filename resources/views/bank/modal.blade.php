<form id="form" class="form-vertical" action="" method="POST" enctype="multipart/form-data">
    <div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus me-1 bs-tooltip"
                            title="Add Data"></i>Add Data</h5>
                    <button type="button" class="btn-close bs-tooltip" data-bs-dismiss="modal" aria-label="Close"
                        title="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
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

<form id="formEdit" class="fofrm-vertical" action="" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    <div class="modal animated fade fadeInDown" id="modalEdit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleEdit"><i class="fas fa-edit me-1 bs-tooltip"
                            title="Edit Data"></i>Edit Data</h5>
                    <button type="button" class="btn-close bs-tooltip" data-bs-dismiss="modal" aria-label="Close"
                        title="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_name"><i class="far fa-user me-1 bs-tooltip"
                                title="Name"></i>Name :</label>
                        <input type="text" name="name" class="form-control maxlength" id="edit_name"
                            placeholder="Please Enter Name" minlength="2" maxlength="100" required>
                        <span id="err_edit_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_acc_name"><i
                                class="fas fa-file-signature me-1 bs-tooltip" title="Acc Name"></i>Acc Name :</label>
                        <input type="text" name="acc_name" class="form-control maxlength" id="edit_acc_name"
                            placeholder="Please Enter Acc Name" minlength="1" maxlength="100" required>
                        <span id="err_edit_acc_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_acc_number"><i
                                class="fas fa-file-invoice-dollar me-1 bs-tooltip" title="Acc Name"></i>Acc Number
                            :</label>
                        <input type="text" name="acc_number" class="form-control maxlength" id="edit_acc_number"
                            placeholder="Please Enter Acc Name" minlength="1" maxlength="100" required>
                        <span id="err_edit_acc_number" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <div class="col-lg-2 col-6 mb-2 mt-2">
                            <div class="switch form-switch-custom switch-inline form-switch-success">
                                <input class="switch-input" type="checkbox" role="switch" id="edit_is_active"
                                    name="is_active" checked>
                                <label class="switch-label" for="edit_is_active">Active</label>
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
