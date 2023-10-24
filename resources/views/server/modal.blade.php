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
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="name"><i class="fas fa-server mr-1" data-toggle="tooltip"
                                    title="Name Server"></i>Name Server :</label>
                            <input type="text" name="name" class="form-control maxlength" id="name"
                                placeholder="Please Enter name" minlength="3" maxlength="100" required>
                            <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ip"><i class="fas fa-ethernet mr-1" data-toggle="tooltip"
                                    title="IP Server"></i>IP Server :</label>
                            <input type="text" name="ip" class="form-control" id="ip"
                                data-inputmask="'alias': 'ip'" placeholder="Please Enter IP Address" data-mask required>
                            <span id="err_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="domain"><i class="fas fa-globe mr-1" data-toggle="tooltip"
                                    title="Domain Server"></i>Domain Server :</label>
                            <input type="text" name="domain" class="form-control maxlength" id="domain"
                                placeholder="Please Enter Domain" minlength="3" maxlength="100" required>
                            <span id="err_domain" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="netwatch"><i class="far fa-clock mr-1" data-toggle="tooltip"
                                    title="Netwatch Server"></i>Netwatch Server :</label>
                            <input type="text" name="netwatch" class="form-control" id="netwatch"
                                data-inputmask="'alias': 'ip'" placeholder="Please Enter Netwatch" data-mask required>
                            <span id="err_netwatch" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="location"><i class="fas fa-map-marker mr-1" data-toggle="tooltip"
                                    title="location"></i>Location :</label>
                            <input type="text" name="location" class="form-control" id="location"
                                placeholder="Please Enter location" minlength="3" maxlength="20" required>
                            <span id="err_location" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sufiks"><i class="fas fa-indent mr-1" data-toggle="tooltip"
                                    title="Sufiks"></i>Sufiks :</label>
                            <input type="text" name="sufiks" class="form-control" id="sufiks"
                                placeholder="Please Enter Sufiks" minlength="3" maxlength="20" required>
                            <span id="err_sufiks" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="port"><i class="fas fa-random mr-1" data-toggle="tooltip"
                                    title="Port Server"></i>Port :</label>
                            <input type="number" name="port" class="form-control" id="port"
                                placeholder="Please Enter Port" required>
                            <span id="err_port" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price"><i class="fas fa-dollar-sign mr-1" data-toggle="tooltip"
                                    title="Price Server"></i>Price :</label>
                            <input type="number" name="price" class="form-control" id="price"
                                placeholder="Please Enter Price" required>
                            <span id="err_price" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label for="last_ip"><i class="fas fa-undo mr-1" data-toggle="tooltip"
                                    title="Last IP Server"></i>Last IP :</label>
                            <input type="number" name="last_ip" class="form-control" id="last_ip"
                                placeholder="Please Enter Last IP" required>
                            <span id="err_last_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="count_ip"><i class="fas fa-stopwatch-20 mr-1" data-toggle="tooltip"
                                    title="Count IP Server"></i>Count IP :</label>
                            <input type="number" name="count_ip" class="form-control" id="count_ip"
                                placeholder="Please Enter Count IP" required>
                            <span id="err_count_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_port"><i class="fas fa-step-forward mr-1" data-toggle="tooltip"
                                    title="Last Port Server"></i>Last Port :</label>
                            <input type="number" name="last_port" class="form-control" id="last_port"
                                placeholder="Please Enter Last Port" required>
                            <span id="err_last_port" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label for="is_active" data-toggle="tooltip" title="Option Active Server"><i
                                    class="fas fa-check mr-1"></i>Active ? :</label>
                            <div class="form-check pl-0 pt-2">
                                <div class="custom-control custom-checkbox checkbox-info pl-0">
                                    <label class="new-control new-radio radio-success" data-toggle="tooltip"
                                        title="Server = Active">
                                        <input type="radio" class="new-control-input" name="is_active" checked
                                            value="1">
                                        <span class="new-control-indicator"></span>Active
                                    </label>
                                    <label class="new-control new-radio radio-danger" data-toggle="tooltip"
                                        title="Server = NonActive">
                                        <input type="radio" class="new-control-input" name="is_active"
                                            value="0">
                                        <span class="new-control-indicator"></span>Nonactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="paid" data-toggle="tooltip" title="Option Active Server"><i
                                    class="fas fa-check mr-1"></i>Paid ? :</label>
                            <div class="form-check pl-0 pt-2">
                                <div class="custom-control custom-checkbox checkbox-info pl-0">
                                    <label class="new-control new-radio radio-success" data-toggle="tooltip"
                                        title="Server = Paid">
                                        <input type="radio" class="new-control-input" name="paid" checked
                                            value="1">
                                        <span class="new-control-indicator"></span>Paid
                                    </label>
                                    <label class="new-control new-radio radio-danger" data-toggle="tooltip"
                                        title="Server = Free">
                                        <input type="radio" class="new-control-input" name="paid"
                                            value="0">
                                        <span class="new-control-indicator"></span>Free
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="time"><i class="fas fa-clock mr-1" data-toggle="tooltip"
                                    title="Option Time Server"></i>Time Free :</label>
                            <select name="time" id="time" class="form-control" style="width: 100%;"
                                required>
                                <option value="">Please Select Time Free</option>
                                <option value="1">1 Month</option>
                                <option value="2">2 Month</option>
                                <option value="3">3 Month</option>
                                <option value="4">4 Month</option>
                                <option value="5">5 Month</option>
                                <option value="6">6 Month</option>
                                <option value="12">1 Years</option>
                            </select>
                            <span id="err_time" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="api"><i class="fas fa-clock mr-1" data-toggle="tooltip"
                                    title="Option API Server"></i>API :</label>
                            <select name="api" id="api" class="form-control" style="width: 100%;"
                                required>
                                <option value="">Please Select API</option>
                                <option value="active">Active</option>
                                <option value="nonactive">Nonactive</option>
                            </select>
                            <span id="err_api" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
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
                <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="edit_name"><i class="fas fa-server mr-1" data-toggle="tooltip"
                                    title="Name Server"></i>Name Server :</label>
                            <input type="text" name="name" class="form-control maxlength" id="edit_name"
                                placeholder="Please Enter name" minlength="3" maxlength="100" required>
                            <input type="hidden" name="id" id="edit_id">
                            <span id="err_edit_name" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_ip"><i class="fas fa-ethernet mr-1" data-toggle="tooltip"
                                    title="IP Server"></i>IP Server :</label>
                            <input type="text" name="ip" class="form-control" id="edit_ip"
                                data-inputmask="'alias': 'ip'" placeholder="Please Enter IP Address" data-mask
                                required>
                            <span id="err_edit_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="edit_domain"><i class="fas fa-globe mr-1" data-toggle="tooltip"
                                    title="Domain Server"></i>Domain Server :</label>
                            <input type="text" name="domain" class="form-control maxlength" id="edit_domain"
                                placeholder="Please Enter Domain" minlength="3" maxlength="100" required>
                            <span id="err_edit_domain" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_netwatch"><i class="far fa-clock mr-1" data-toggle="tooltip"
                                    title="Netwatch Server"></i>Netwatch Server :</label>
                            <input type="text" name="netwatch" class="form-control" id="edit_netwatch"
                                data-inputmask="'alias': 'ip'" placeholder="Please Enter Netwatch" data-mask required>
                            <span id="err_edit_netwatch" class="error invalid-feedback"
                                style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="edit_location"><i class="fas fa-map-marker mr-1" data-toggle="tooltip"
                                    title="location"></i>Location :</label>
                            <input type="text" name="location" class="form-control" id="edit_location"
                                placeholder="Please Enter location" minlength="3" maxlength="20" required>
                            <span id="err_edit_location" class="error invalid-feedback"
                                style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_sufiks"><i class="fas fa-indent mr-1" data-toggle="tooltip"
                                    title="Sufiks"></i>Sufiks :</label>
                            <input type="text" name="sufiks" class="form-control maxlength" id="edit_sufiks"
                                placeholder="Please Enter Sufiks" minlength="3" maxlength="20" required>
                            <span id="err_edit_sufiks" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="edit_port"><i class="fas fa-random mr-1" data-toggle="tooltip"
                                    title="Port Server"></i>Port :</label>
                            <input type="number" name="port" class="form-control" id="edit_port"
                                placeholder="Please Enter Port Server" required>
                            <span id="err_edit_port" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_price"><i class="fas fa-dollar-sign mr-1" data-toggle="tooltip"
                                    title="Price Server"></i>Price :</label>
                            <input type="number" name="price" class="form-control" id="edit_price"
                                placeholder="Please Enter Price Server" required>
                            <span id="err_edit_price" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label for="edit_last_ip"><i class="fas fa-undo mr-1" data-toggle="tooltip"
                                    title="Last IP Server"></i>Last IP :</label>
                            <input type="number" name="last_ip" class="form-control" id="edit_last_ip"
                                placeholder="Please Enter Last IP" required>
                            <span id="err_edit_last_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_count_ip"><i class="fas fa-stopwatch-20 mr-1" data-toggle="tooltip"
                                    title="Count IP Server"></i>Count IP :</label>
                            <input type="number" name="count_ip" class="form-control" id="edit_count_ip"
                                placeholder="Please Enter Count IP" required>
                            <span id="err_edit_count_ip" class="error invalid-feedback"
                                style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_last_port"><i class="fas fa-step-forward mr-1" data-toggle="tooltip"
                                    title="Last Port Server"></i>Last Port :</label>
                            <input type="number" name="last_port" class="form-control" id="edit_last_port"
                                placeholder="Please Enter Last Port" required>
                            <span id="err_edit_last_port" class="error invalid-feedback"
                                style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label for="edit_is_active" data-toggle="tooltip" title="Option Active Server"><i
                                    class="fas fa-check mr-1"></i>Active ? :</label>
                            <div class="form-check pl-0 pt-2">
                                <div class="custom-control custom-checkbox checkbox-info pl-0">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-success" data-toggle="tooltip"
                                            title="Server = Active">
                                            <input type="radio" id="edit_is_active1" class="new-control-input"
                                                name="is_active" checked value="1">
                                            <span class="new-control-indicator"></span>Active
                                        </label>
                                        <label class="new-control new-radio radio-danger" data-toggle="tooltip"
                                            title="Server = NonActive">
                                            <input type="radio" id="edit_is_active2" class="new-control-input"
                                                name="is_active" value="0">
                                            <span class="new-control-indicator"></span>Nonactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edit_paid" data-toggle="tooltip" title="Option Active Server"><i
                                    class="fas fa-check mr-1"></i>Paid ? :</label>
                            <div class="form-check pl-0 pt-2">
                                <div class="custom-control custom-checkbox checkbox-info pl-0">
                                    <label class="new-control new-radio radio-success" data-toggle="tooltip"
                                        title="Server = Paid">
                                        <input type="radio" id="edit_paid1" class="new-control-input"
                                            name="paid" checked value="1">
                                        <span class="new-control-indicator"></span>Paid
                                    </label>
                                    <label class="new-control new-radio radio-danger" data-toggle="tooltip"
                                        title="Server = Free">
                                        <input type="radio" id="edit_paid2" class="new-control-input"
                                            name="paid" value="0">
                                        <span class="new-control-indicator"></span>Free
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="edit_time"><i class="fas fa-clock mr-1" data-toggle="tooltip"
                                    title="Option Time Server"></i>Time Free :</label>
                            <select name="time" id="edit_time" class="form-control" style="width: 100%;"
                                required>
                                <option value="0">Please Select Time Free</option>
                                <option value="1">1 Month</option>
                                <option value="2">2 Month</option>
                                <option value="3">3 Month</option>
                                <option value="4">4 Month</option>
                                <option value="5">5 Month</option>
                                <option value="6">6 Month</option>
                                <option value="12">1 Years</option>
                            </select>
                            <span id="err_edit_time" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_api"><i class="fas fa-clock mr-1" data-toggle="tooltip"
                                    title="Option API Server"></i>API :</label>
                            <select name="api" id="edit_api" class="form-control" style="width: 100%;"
                                required>
                                <option value="">Please Select API</option>
                                <option value="active">Active</option>
                                <option value="nonactive">Nonactive</option>
                            </select>
                            <span id="err_edit_api" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"
                        data-toggle="tooltip" title="Close"></i>Close</button>
                <button type="button" id="edit_reset" class="btn btn-warning"><i class="fas fa-undo mr-1"
                        data-toggle="tooltip" title="Reset"></i>Reset</button>
                <button type="button" id="btnPing" class="btn btn-info"><i class="fas fa-rocket mr-1"
                        data-toggle="tooltip" title="Ping"></i>Ping</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                        data-toggle="tooltip" title="Save"></i>Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
