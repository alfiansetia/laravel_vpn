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
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_name">Profile Name :</label>
                            <input type="text" name="name" class="form-control maxlength" id="edit_name"
                                placeholder="Please Enter Profile Name" minlength="1" maxlength="50" required>
                            <span id="err_edit_name" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_shared_users">Shared User :</label>
                            <input type="number" name="shared_users" class="form-control" id="edit_shared_users"
                                placeholder="Please Enter Shared User" min="0" value="1" required>
                            <span id="err_shared_users" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 mb-2">
                            <label class="control-label" for="edit_data_day">Day Limit :</label>
                            <select name="data_day" id="edit_data_day" class="form-control select2">
                                @for ($i = 0; $i < 365; $i++)
                                    <option value="{{ $i }}">{{ $i }} Day</option>
                                @endfor
                            </select>
                            <span id="err_edit_data_day" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-6 mb-2">
                            <label class="control-label" for="edit_time_limit">Time Limit :</label>
                            <input type="text" name="time_limit" class="form-control" id="edit_time_limit"
                                placeholder="Please Enter Time Limit" value="00:00:00" required>
                            <span id="err_edit_time_limit" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_rate_limit">Rate Limit [UP/DOWN] :</label>
                            <input type="text" name="rate_limit" class="form-control" id="edit_rate_limit"
                                placeholder="1M/1M" minlength="5" maxlength="25">
                            <span id="err_edit_rate_limit" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="edit_parent">Parent Queue :</label>
                            <select name="parent" id="edit_parent" class="form-control" style="width: 100%;">
                                <option value="">Please Select Parent!</option>
                            </select>
                            <span id="err_edit_parent" class="error invalid-feedback" style="display: hide;"></span>
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
