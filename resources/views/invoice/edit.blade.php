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
                        <label for="edit_vpn"><i class="far fa-envelope me-1 bs-tooltip" title="Option VPN"></i>VPN
                            :</label>
                        <select name="vpn" id="edit_vpn" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select VPN</option>
                        </select>
                        <span id="err_edit_vpn" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="edit_from"><i class="fas fa-calendar me-1 bs-tooltip" title="from"></i>From
                            :</label>
                        <input type="text" id="edit_from" name="from"
                            class="form-control form-control-solid flatpickr flatpickr-input active"
                            placeholder="Select Date.." required>
                        <span id="err_edit_from" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="edit_to"><i class="fas fa-calendar me-1 bs-tooltip" title="to"></i>To
                            :</label>
                        <input type="text" id="edit_to" name="to"
                            class="form-control form-control-solid flatpickr flatpickr-input active"
                            placeholder="Select Date.." required>
                        <span id="err_edit_to" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="edit_bank"><i class="far fa-envelope me-1 bs-tooltip" title="Option Bank"></i>Bank
                            :</label>
                        <select name="bank" id="edit_bank" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select Bank</option>
                        </select>
                        <span id="err_edit_bank" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="edit_total"><i class="fas fa-dollar-sign me-1 bs-tooltip" title="total"></i>Total
                            :</label>
                        <input type="number" id="edit_total" name="total" class="form-control form-control-solid"
                            placeholder="Input Total" value="0" min="1" required>
                        <span id="err_edit_total" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-12">

                            @include('components.form.button_edit')

                            <div class="btn-group me-4" role="group">
                                <button id="btn_action" type="button" class="btn btn-outline-danger dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                    <i data-feather="chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btn_action">
                                    <button id="btn_paid" type="button" class="dropdown-item"
                                        onclick="update_status('paid')"><i
                                            class="fas fa-check-double me-1"></i>Paid</button>
                                    <button id="btn_cancel" type="button" class="dropdown-item"
                                        onclick="update_status('cancel')"><i
                                            class="fas fa-times me-1"></i>Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
