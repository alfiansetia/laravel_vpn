<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_edit" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="formEdit" class="fofrm-vertical" action="" method="POST">
            {{ method_field('PUT') }}
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="titleEdit"><i class="fas fa-info me-1 bs-tooltip"
                            title="Edit Data"></i>Detail Log</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_time">Time :</label>
                        <input type="text" name="time" class="form-control maxlength" id="edit_time"
                            placeholder="Please Enter Time" minlength="0" maxlength="100">
                        <span id="err_edit_time" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_topics">Topics :</label>
                        <input type="text" name="topics" class="form-control maxlength" id="edit_topics"
                            placeholder="Please Enter Topics" minlength="0" maxlength="100">
                        <span id="err_edit_topics" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_message">Message :</label>
                        <textarea name="message" rows="20" class="form-control maxlength" id="edit_message"
                            placeholder="Please Enter Message" minlength="0" maxlength="250"></textarea>
                        <span id="err_edit_message" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-secondary show-index"><i
                                    class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                            <button type="button" id="edit_reset" class="btn btn-warning">
                                <i class="fas fa-undo me-1 bs-tooltip" title="Refresh Data"></i>Refresh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
