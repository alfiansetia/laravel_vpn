<div class="modal animated fade fadeInDown" id="modal_print" tabindex="-1" role="dialog" aria-labelledby="modal_print"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleEdit"><i class="fas fa-info me-1 bs-tooltip"
                        title="Select Router"></i>Please Select Router! </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6 mb-2">
                        <label class="control-label" for="template">Template :</label>
                        <select name="template" id="template" class="form-control" style="width: 100%;">
                            <option value="">Please select Template</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label class="control-label" for="modal_type">Type :</label>
                        <select name="modal_type" id="modal_type" class="form-control" style="width: 100%;">
                            <option value="up">User & Pass</option>
                            <option value="vc">User = Pass</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mb-2">
                        <label class="control-label" for="modal_price">Price :</label>
                        <input type="number" class="form-control" id="modal_price" min="0" value="0">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                <button type="submit" id="btn_modal_print" class="btn btn-primary"><i
                        class="fas fa-print me-1 bs-tooltip" title="Print"></i>Print</button>
            </div>
        </div>
    </div>
</div>
