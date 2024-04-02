<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_add" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="form" action="" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" id="exampleModalLongTitle"><i class="fas fa-plus me-1 bs-tooltip"
                            title="Add Data"></i>Add Data</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="name">Profile Name :</label>
                            <input type="text" name="name" class="form-control maxlength" id="name"
                                placeholder="Please Enter Profile Name" minlength="1" maxlength="50" required>
                            <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-6 mb-2">
                            <label class="control-label" for="only_one">Only One :</label>
                            <select name="only_one" id="only_one" class="form-control select2">
                                <option value="">Default</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <span id="err_only_one" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="local_address">Local Address :</label>
                            <input type="text" name="local_address" class="form-control maxlength mask_ip"
                                id="local_address" placeholder="Please Enter Local Address" minlength="0"
                                maxlength="18">
                            <span id="local_address" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="remote_address">Remote Address :</label>
                            <input type="text" name="remote_address" class="form-control maxlength mask_ip"
                                id="remote_address" placeholder="Please Enter Remote Address" minlength="0"
                                maxlength="18">
                            <span id="err_remote_address" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 mb-2">
                            <label class="control-label" for="data_day">Day Limit :</label>
                            <select name="data_day" id="data_day" class="form-control select2">
                                <option value="">0 Day</option>
                                @for ($i = 1; $i < 365; $i++)
                                    <option value="{{ $i }}">{{ $i }} Day</option>
                                @endfor
                            </select>
                            <span id="err_data_day" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-6 mb-2">
                            <label class="control-label" for="time_limit">Time Limit :</label>
                            <input type="text" name="time_limit" class="form-control" id="time_limit"
                                placeholder="Please Enter Time Limit" value="00:00:00" required>
                            <span id="err_time_limit" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="rate_limit">Rate Limit [UP/DOWN] :</label>
                            <input type="text" name="rate_limit" class="form-control" id="rate_limit"
                                placeholder="1M/1M" minlength="5" maxlength="25">
                            <span id="err_rate_limit" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="parent">Parent Queue :</label>
                            <select name="parent" id="parent" class="form-control" style="width: 100%;">
                                <option value="">Please Select Parent!</option>
                            </select>
                            <span id="err_parent" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="control-label" for="comment">Comment :</label>
                        <textarea name="comment" class="form-control maxlength" id="comment" minlength="0" maxlength="100"
                            placeholder="Please Enter Comment"></textarea>
                        <span id="err_comment" class="error invalid-feedback" style="display: hide;"></span>
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
