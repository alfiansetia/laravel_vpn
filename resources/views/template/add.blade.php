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
                        <label class="control-label" for="name">Template Name :</label>
                        <input type="text" name="name" class="form-control maxlength" id="name"
                            placeholder="Please Enter Template Name" minlength="3" maxlength="30" required>
                        <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="html_up">HTML UP :</label>
                        <textarea name="html_up" class="form-control" id="html_up" placeholder="Please Enter HTML UP" rows="10" required></textarea>
                        <span id="err_html_up" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="html_vc">HTML VC :</label>
                        <textarea name="html_vc" class="form-control" id="html_vc" placeholder="Please Enter HTML VC" rows="10" required></textarea>
                        <span id="err_html_vc" class="error invalid-feedback" style="display: hide;"></span>
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
