<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_edit" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="formEdit" class="fofrm-vertical" action="" method="POST">
            {{ method_field('PUT') }}
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="titleEdit"><i class="fas fa-edit me-1 bs-tooltip"
                            title="Edit Data"></i>Edit Data</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-5 mb-2">
                            <label class="control-label" for="edit_secret">Secret :</label>
                            <input type="text" name="secret" class="form-control maxlength" id="edit_secret"
                                placeholder="Please Enter Secret" minlength="1" maxlength="50" required>
                            <span id="err_edit_secret" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-5 col-8 mb-2">
                            <label class="control-label" for="edit_address">Address :</label>
                            <input type="text" name="address" class="form-control maxlength mask_ip"
                                id="edit_address" placeholder="Please Enter Address" minlength="0" maxlength="18">
                            <span id="edit_address" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-2 col-4 mb-2">
                            <label class="control-label" for="edit_subnet">/ :</label>
                            <input type="number" name="subnet" class="form-control" id="edit_subnet"
                                placeholder="Subnet" min="0" max="32">
                            <span id="err_edit_subnet" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_comment">Comment :</label>
                        <textarea name="comment" class="form-control maxlength" id="edit_comment" minlength="0" maxlength="100"
                            placeholder="Please Enter Comment"></textarea>
                        <span id="err_edit_comment" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-12">
                            @include('components.form.button_edit')
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
