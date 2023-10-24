<div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus mr-1" data-toggle="tooltip"
                        title="Add Data"></i>Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" class="form-vertical" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label" for="name"><i class="far fa-user mr-1" data-toggle="tooltip"
                                title="Full Name User"></i>Name :</label>
                        <input type="text" name="name" class="form-control maxlength" id="name"
                            placeholder="Please Enter Name" minlength="3" maxlength="25" required>
                        <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="email"><i class="far fa-envelope mr-1"
                                data-toggle="tooltip" title="Email User"></i>Email :</label>
                        <input type="email" name="email" class="form-control maxlength" id="email"
                            placeholder="Please Enter Email" minlength="3" maxlength="50" required>
                        <span id="err_email" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="gender"><i class="fas fa-venus-mars mr-1"
                                data-toggle="tooltip" title="Gender User"></i>Gender :</label>
                        <select name="gender" id="gender" class="form-control" style="width: 100%;" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span id="err_gender" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="phone"><i class="fas fa-phone-alt mr-1"
                                data-toggle="tooltip" title="Phone User"></i>Phone :</label>
                        <input type="text" name="phone" class="form-control maxlength" id="phone"
                            placeholder="Please Enter Phone" minlength="3" maxlength="15" required>
                        <span id="err_phone" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password"><i class="fas fa-lock mr-1" data-toggle="tooltip"
                                title="Password User"></i>Password :</label>
                        <input type="password" name="password" class="form-control maxlength" id="password"
                            placeholder="Please Enter Password" minlength="5" maxlength="100" required>
                        <span id="err_password" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="role"><i class="fas fa-user-tag mr-1"
                                data-toggle="tooltip" title="Role User"></i>Role :</label>
                        <select name="role" id="role" class="form-control" style="width: 100%;" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                        <span id="err_role" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="address"><i class="fas fa-map-marker mr-1"
                                data-toggle="tooltip" title="Address User"></i>Address :</label>
                        <textarea name="address" class="form-control maxlength" id="address" placeholder="Please Enter Address"
                            minlength="3" maxlength="100" required></textarea>
                        <span id="err_address" class="error invalid-feedback" style="display: hide;"></span>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="switch s-primary mr-2">
                            <input id="verified" name="verified" type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="align-self-center">Verified</span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"
                        data-toggle="tooltip" title="Close"></i>Close</button>
                <button type="reset" id="reset" class="btn btn-warning"><i class="fas fa-undo mr-1"
                        data-toggle="tooltip" title="Reset"></i>Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                        data-toggle="tooltip" title="Save"></i>Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal animated fade fadeInDown" id="modalEdit" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
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
                <form id="formEdit" class="fofrm-vertical" action="" method="POST"
                    enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label class="control-label" for="edit_name"><i class="far fa-user mr-1"
                                data-toggle="tooltip" title="Full Name User"></i>Name :</label>
                        <input type="hidden" name="id" id="edit_id">
                        <input type="text" name="name" class="form-control maxlength" id="edit_name"
                            placeholder="Please Enter Name" minlength="3" maxlength="25" required>
                        <span id="err_edit_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_email"><i class="far fa-envelope mr-1"
                                data-toggle="tooltip" title="Email User"></i>Email :</label>
                        <input type="email" name="email" class="form-control maxlength" id="edit_email"
                            placeholder="Please Enter Email" minlength="3" maxlength="50" required>
                        <span id="err_edit_email" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_gender"><i class="fas fa-venus-mars mr-1"
                                data-toggle="tooltip" title="Gender User"></i>Gender :</label>
                        <select name="gender" id="edit_gender" class="form-control" style="width: 100%;" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span id="err_edit_gender" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_phone"><i class="fas fa-phone-alt mr-1"
                                data-toggle="tooltip" title="Phone User"></i>Phone :</label>
                        <input type="text" name="phone" class="form-control maxlength" id="edit_phone"
                            placeholder="Please Enter Phone" minlength="3" maxlength="15" required>
                        <span id="err_edit_phone" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_password"><i class="fas fa-lock mr-1"
                                data-toggle="tooltip" title="Password User"></i>Password :</label>
                        <input type="password" name="edit_password" class="form-control maxlength"
                            id="edit_password" placeholder="Please Enter Password" minlength="0" maxlength="100">
                        <span id="err_edit_password" class="error invalid-feedback" style="display: hide;"></span>
                        <small id="sh-text1" class="form-text text-muted">Leave blank if not change password.</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_role"><i class="fas fa-user-tag mr-1"
                                data-toggle="tooltip" title="Role User"></i>Role :</label>
                        <select name="role" id="edit_role" class="form-control" style="width: 100%;" required>
                            <option value="">Select Role</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                        <span id="err_edit_role" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_address"><i class="fas fa-map-marker mr-1"
                                data-toggle="tooltip" title="Address User"></i>Address :</label>
                        <textarea name="address" class="form-control maxlength" id="edit_address" placeholder="Please Enter Address"
                            minlength="3" maxlength="100" required></textarea>
                        <span id="err_edit_address" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label class="switch s-primary mr-2">
                            <input id="edit_verified" name="verified" type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="align-self-center">Verified</span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"
                        data-toggle="tooltip" title="Close"></i>Close</button>
                <button type="button" id="edit_reset" class="btn btn-warning"><i class="fas fa-undo mr-1"
                        data-toggle="tooltip" title="Reset"></i>Reset</button>
                <button type="button" id="edit_delete" class="btn btn-danger"><i class="fas fa-trash mr-1"
                        data-toggle="tooltip" title="Delete"></i>Delete</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                        data-toggle="tooltip" title="Save"></i>Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
