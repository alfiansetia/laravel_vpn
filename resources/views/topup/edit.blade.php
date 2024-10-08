<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_edit" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="formEdit" class="fofrm-vertical" action="" method="POST">
            {{ method_field('PUT') }}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" id="titleEdit"><i class="fas fa-edit me-1 bs-tooltip"
                            title="Edit Data"></i>Edit Data <span id="titleEdit2"></span></h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="edit_user"><i class="far fa-envelope me-1 bs-tooltip" title="Option User"></i>User
                            :</label>
                        <select name="user" id="edit_user" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select User</option>
                        </select>
                        <span id="err_edit_user" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="edit_bank"><i class="fas fa-university me-1 bs-tooltip" title="Option Bank"></i>Bank
                            :</label>
                        <select name="bank" id="edit_bank" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select Bank</option>
                        </select>
                        <span id="err_edit_bank" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="edit_amount"><i class="fas fa-dollar-sign me-1 bs-tooltip" title="amount"></i>Amount
                            :</label>
                        <input type="number" id="edit_amount" name="amount" class="form-control form-control-solid"
                            placeholder="Input Amount" value="0" min="1" required>
                        <span id="err_edit_amount" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="edit_desc"><i class="fas fa-map-marker me-1 bs-tooltip"
                                title="desc User"></i>Description :</label>
                        <textarea name="desc" class="form-control maxlength" id="edit_desc" placeholder="Please Enter Description"
                            minlength="0" maxlength="100"></textarea>
                        <span id="err_edit_desc" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-12">

                            @include('components.form.button_edit')
                            @if (auth()->user()->is_admin())
                                <div class="btn-group me-4" role="group">
                                    <button id="btn_action" type="button"
                                        class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Status
                                        <i data-feather="chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btn_action">
                                        <button id="btn_done" type="button" class="dropdown-item"
                                            onclick="update_status('done')"><i
                                                class="fas fa-check-double me-1"></i>Done</button>
                                        <button id="btn_cancel" type="button" class="dropdown-item"
                                            onclick="update_status('cancel')"><i
                                                class="fas fa-times me-1"></i>Cancel</button>
                                    </div>
                                </div>
                            @endif
                            <button type="button" class="btn btn-info ms-1 me-1" id="btn_pay"><i
                                    class="fas fa-paper-plane"></i> Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
