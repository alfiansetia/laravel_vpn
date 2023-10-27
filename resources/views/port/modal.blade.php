<div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus mr-1" data-toggle="tooltip"
                        title="Add Data"></i>Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-row mb-2">
                        <div class="form-group col-md-12">
                            <label for="vpn"><i class="fas fa-network-wired mr-1" data-toggle="tooltip"
                                    title="Option Vpn"></i>Vpn :</label>
                            <select name="vpn" id="vpn" class="form-control" style="width: 100%;" required>
                                <option value="">Please Select Vpn</option>
                            </select>
                            <span id="err_vpn" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label for="dst"><i class="fas fa-random mr-1" data-toggle="tooltip"
                                    title="Dst Port"></i>Dst Port :</label>
                            <input type="number" name="dst" class="form-control" id="dst"
                                placeholder="Please Enter Dst" required>
                            <span id="err_dst" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="to"><i class="fas fa-arrows-alt mr-1" data-toggle="tooltip"
                                    title="To Port"></i>To Port :</label>
                            <input type="number" name="to" class="form-control" id="to"
                                placeholder="Please Enter To" required>
                            <span id="err_to" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sync"><i class="fas fa-check mr-1" data-toggle="tooltip"
                                    title="Option Active"></i>Sync :</label>
                            <select name="sync" id="sync" class="form-control" style="width: 100%;" required>
                                <option value="">Select Sync</option>
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                            <span id="err_sync" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"
                        data-toggle="tooltip" title="Close"></i>Close</button>
                <button type="reset" id="reset" class="btn btn-warning"><i class="fas fa-undo mr-1"
                        data-toggle="tooltip" title="Reset"></i>Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1" data-toggle="tooltip"
                        title="Save"></i>Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal animated fade fadeInDown" id="modalEdit" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleEdit"><i class="fas fa-edit mr-1" data-toggle="tooltip"
                        title="Edit Data"></i>Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                    title="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    <div class="form-row mb-2">
                        <div class="form-group col-md-12">
                            <label for="edit_vpn"><i class="fas fa-network-wired mr-1" data-toggle="tooltip"
                                    title="Option Vpn"></i>Vpn :</label>
                            <select name="vpn" id="edit_vpn" class="form-control" style="width: 100%;" required
                                disabled>
                                <option value="">Please Select Vpn</option>
                            </select>
                            <span id="err_edit_vpn" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label for="edit_dst"><i class="fas fa-random mr-1" data-toggle="tooltip"
                                    title="Dst Port"></i>Dst Port :</label>
                            <input type="number" name="dst" class="form-control" id="edit_dst"
                                placeholder="Please Enter Dst" required>
                            <span id="err_edit_dst" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_to"><i class="fas fa-arrows-alt mr-1" data-toggle="tooltip"
                                    title="To Port"></i>To Port :</label>
                            <input type="number" name="to" class="form-control" id="edit_to"
                                placeholder="Please Enter To" required>
                            <span id="err_edit_to" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_sync"><i class="fas fa-check mr-1" data-toggle="tooltip"
                                    title="Option Active"></i>Sync :</label>
                            <select name="sync" id="edit_sync" class="form-control" style="width: 100%;"
                                required>
                                <option value="">Select Sync</option>
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                            <span id="err_edit_sync" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1" data-toggle="tooltip" title="Close"></i>Close
                </button>
                <button type="button" id="edit_reset" class="btn btn-warning">
                    <i class="fas fa-undo mr-1" data-toggle="tooltip" title="Reset"></i>Reset
                </button>
                <button type="button" id="edit_delete" class="btn btn-danger">
                    <i class="fas fa-trash mr-1" data-toggle="tooltip" title="Delete"></i>Delete
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane mr-1" data-toggle="tooltip" title="Save"></i>Save
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
