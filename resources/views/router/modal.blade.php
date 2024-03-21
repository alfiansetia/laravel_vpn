<div class="modal animated fade fadeInDown" id="modalRouter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleEdit"><i class="fas fa-info me-1 bs-tooltip"
                        title="Select Router"></i>Please
                    Select Router! </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" title="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRouter" class="fofrm-vertical" action="{{ route('mikapi.dashboard') }}" method="GET">
                    <div class="form-group mb-2">
                        <label class="control-label" for="router"><i class="fas fa-user-tag me-1 bs-tooltip"
                                title="Router"></i> Select Router :</label>
                        <select name="router" id="router" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select Router!</option>
                        </select>
                        <span id="err_router" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                <button type="submit" id="submit_router" class="btn btn-primary"><i
                        class="fas fa-paper-plane me-1 bs-tooltip" title="Save"></i>Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
