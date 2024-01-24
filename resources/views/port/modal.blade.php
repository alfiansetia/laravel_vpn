<form id="form" action="" method="POST" enctype="multipart/form-data">
    <div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus me-1 bs-tooltip"
                            title="Add Data"></i>Add
                        Data</h5>
                    <button type="button" class="btn-close bs-tooltip" data-bs-dismiss="modal" aria-label="Close"
                        title="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="form-group col-md-12">
                            <label for="vpn"><i class="fas fa-network-wired me-1 bs-tooltip"
                                    title="Option Vpn"></i>Vpn :</label>
                            <select name="vpn" id="vpn" class="form-control" style="width: 100%;" required>
                                <option value="">Please Select Vpn</option>
                            </select>
                            <span id="err_vpn" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-4">
                            <label for="dst"><i class="fas fa-random me-1 bs-tooltip" title="Dst Port"></i>Dst Port
                                :</label>
                            <input type="number" name="dst" class="form-control" id="dst"
                                placeholder="Please Enter Dst" required>
                            <span id="err_dst" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="to"><i class="fas fa-arrows-alt me-1 bs-tooltip" title="To Port"></i>To
                                Port
                                :</label>
                            <input type="number" name="to" class="form-control" id="to"
                                placeholder="Please Enter To" required>
                            <span id="err_to" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="col-md-4">
                            <label class="bs-tooltip" for="sync" title="Option Sync Data"></label>
                            <div class="form-check ps-0">
                                <div class="switch form-switch-custom switch-inline form-switch-primary mt-4">
                                    <input class="switch-input" type="checkbox" role="switch" id="sync"
                                        name="sync" checked>
                                    <label class="switch-label" for="sync">Sync</label>
                                </div>
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

<form id="formEdit" action="" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    <div class="modal animated fade fadeInDown" id="modalEdit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleEdit"><i class="fas fa-edit me-1 bs-tooltip"
                            title="Edit Data"></i>Edit Data
                    </h5>
                    <button type="button" class="btn-close bs-tooltip" data-bs-dismiss="modal" aria-label="Close"
                        title="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="form-group col-md-12">
                            <label for="edit_vpn"><i class="fas fa-network-wired me-1 bs-tooltip"
                                    title="Option Vpn"></i>Vpn :</label>
                            <select name="vpn" id="edit_vpn" class="form-control" style="width: 100%;" required
                                disabled>
                                <option value="">Please Select Vpn</option>
                            </select>
                            <span id="err_edit_vpn" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-4">
                            <label for="edit_dst"><i class="fas fa-random me-1 bs-tooltip" title="Dst Port"></i>Dst
                                Port
                                :</label>
                            <input type="number" name="dst" class="form-control" id="edit_dst"
                                placeholder="Please Enter Dst" required>
                            <span id="err_edit_dst" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_to"><i class="fas fa-arrows-alt me-1 bs-tooltip" title="To Port"></i>To
                                Port
                                :</label>
                            <input type="number" name="to" class="form-control" id="edit_to"
                                placeholder="Please Enter To" required>
                            <span id="err_edit_to" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-4">
                                <label class="bs-tooltip" for="sync" title="Option Sync Data"></label>
                                <div class="form-check ps-0">
                                    <div class="switch form-switch-custom switch-inline form-switch-primary mt-4">
                                        <input class="switch-input" type="checkbox" role="switch" id="edit_sync"
                                            name="sync" checked>
                                        <label class="switch-label" for="edit_sync">Sync</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
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
