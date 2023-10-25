<div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
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
                        <label class="control-label" for="vpn"><i class="fas fa-network-wired mr-1"
                                data-toggle="tooltip" title="VPN"></i>VPN :</label>
                        <select name="vpn" id="vpn" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select VPN</option>
                        </select>
                        <span id="err_vpn" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="name"><i class="fas fa-clone mr-1" data-toggle="tooltip"
                                title="Session Name"></i>Session Name :</label>
                        <input type="text" name="name" class="form-control maxlength" id="name"
                            placeholder="Please Enter Session Name" minlength="3" maxlength="50" required>
                        <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="hsname"><i class="fas fa-wifi mr-1" data-toggle="tooltip"
                                title="HS Name"></i>HS Name :</label>
                        <input type="text" name="hsname" class="form-control maxlength" id="hsname"
                            placeholder="Please Enter HS Name" minlength="3" maxlength="50" required>
                        <span id="err_hsname" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="dnsname"><i class="fas fa-project-diagram mr-1"
                                data-toggle="tooltip" title="DNS Name"></i>DNS Name :</label>
                        <input type="text" name="dnsname" class="form-control maxlength" id="dnsname"
                            placeholder="Please Enter DNS Name" minlength="3" maxlength="50" required>
                        <span id="err_dnsname" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="username"><i class="fas fa-user mr-1" data-toggle="tooltip"
                                title="Username"></i>Username :</label>
                        <input type="text" name="username" class="form-control maxlength" id="username"
                            placeholder="Please Enter Username" minlength="3" maxlength="50" required>
                        <span id="err_username" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password"><i class="fas fa-lock mr-1"
                                data-toggle="tooltip" title="Password"></i>Password :</label>
                        <input type="text" name="password" class="form-control maxlength" id="password"
                            placeholder="Please Enter Password" minlength="5" maxlength="100" required>
                        <span id="err_password" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="desc"><i class="fas fa-clipboard-list mr-1"
                                data-toggle="tooltip" title="Description"></i>Description :</label>
                        <textarea name="desc" class="form-control maxlength" id="desc" placeholder="Please Enter Description"
                            minlength="0" maxlength="100"></textarea>
                        <span id="err_desc" class="error invalid-feedback" style="display: hide;"></span>
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
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
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
                        <label class="control-label" for="edit_vpn"><i class="fas fa-network-wired mr-1"
                                data-toggle="tooltip" title="VPN"></i>VPN :</label>
                        <select name="vpn" id="edit_vpn" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select VPN</option>
                        </select>
                        <span id="err_edit_vpn" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_name"><i class="far fas fa-clone mr-1"
                                data-toggle="tooltip" title="Session Name"></i>Session Name :</label>
                        <input type="text" name="name" class="form-control maxlength" id="edit_name"
                            placeholder="Please Enter Session Name" minlength="3" maxlength="50" required>
                        <span id="err_edit_name" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_hsname"><i class="fas fas fa-wifi mr-1"
                                data-toggle="tooltip" title="HS Name"></i>HS Name :</label>
                        <input type="text" name="hsname" class="form-control maxlength" id="edit_hsname"
                            placeholder="Please Enter HS Name" minlength="3" maxlength="50" required>
                        <span id="err_edit_hsname" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_dnsname"><i class="fas fas fa-project-diagram mr-1"
                                data-toggle="tooltip" title="DNS Name"></i>DNS Name :</label>
                        <input type="text" name="dnsname" class="form-control maxlength" id="edit_dnsname"
                            placeholder="Please Enter DNS Name" minlength="3" maxlength="50" required>
                        <span id="err_edit_dnsname" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_username"><i class="fas fa-user mr-1"
                                data-toggle="tooltip" title="Username"></i>Username :</label>
                        <input type="text" name="username" class="form-control maxlength" id="edit_username"
                            placeholder="Please Enter Username" minlength="3" maxlength="50" required>
                        <span id="err_edit_username" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_password"><i class="fas fa-lock mr-1"
                                data-toggle="tooltip" title="Password"></i>Password :</label>
                        <input type="text" name="password" class="form-control maxlength" id="edit_password"
                            placeholder="Please Enter Password" minlength="0" maxlength="100">
                        <div class="mt-1">
                            <span class="badge badge-primary w-100">
                                <small id="sh-text4" class="form-text mt-0 text-left">Kosongkan jika tidak ingin
                                    mengganti password!</small>
                            </span>
                        </div>
                        <span id="err_edit_password" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="edit_desc"><i class="fas fa-clipboard-list mr-1"
                                data-toggle="tooltip" title="Description"></i>Description :</label>
                        <textarea name="desc" class="form-control maxlength" id="edit_desc" placeholder="Please Enter Description"
                            minlength="0" maxlength="50"></textarea>
                        <span id="err_edit_desc" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"
                        data-toggle="tooltip" title="Close"></i>Close</button>
                <button type="button" class="btn btn-warning" id="edit_reset"><i class="fas fa-undo mr-1"
                        data-toggle="tooltip" title="Reset"></i>Reset</button>
                <button type="button" class="btn btn-info" id="btnOpen"><i class="fas fa-rocket mr-1"
                        data-toggle="tooltip" title="Open"></i>Open</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                        data-toggle="tooltip" title="Save"></i>Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal animated fade fadeInDown" id="modalRouter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleEdit"><i class="fas fa-info mr-1" data-toggle="tooltip"
                        title="Select Router"></i>Please Select Router! </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                    title="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRouter" class="fofrm-vertical" action="{{ route('mikapi.dashboard') }}"
                    method="GET">
                    <div class="form-group">
                        <label class="control-label" for="router"><i class="fas fa-user-tag mr-1"
                                data-toggle="tooltip" title="Router"></i> Select Router :</label>
                        <select name="router" id="router" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select Router!</option>
                        </select>
                        <span id="err_router" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"
                        data-toggle="tooltip" title="Close"></i>Close</button>
                <button type="submit" id="submit_router" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                        data-toggle="tooltip" title="Save"></i>Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
