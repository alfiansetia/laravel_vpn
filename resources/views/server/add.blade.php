<div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing" id="card_add" style="display: none;">
    <div class="widget-content widget-content-area br-8">

        <form id="form" action="" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus me-1 bs-tooltip"
                            title="Add Data"></i>Add Data</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="form-group col-md-6 mb-2">
                            <label for="name"><i class="fas fa-server me-1 bs-tooltip" title="Name Server"></i>Name
                                Server :</label>
                            <input type="text" name="name" class="form-control maxlength" id="name"
                                placeholder="Please Enter name" minlength="3" maxlength="100" required>
                            <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label for="ip"><i class="fas fa-ethernet me-1 bs-tooltip" title="IP Server"></i>IP
                                Server :</label>
                            <input type="text" name="ip" class="form-control maxlength" id="ip"
                                placeholder="Please Enter IP Address" minlength="0" maxlength="15" required>
                            <span id="err_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-6 mb-2">
                            <label for="domain"><i class="fas fa-globe me-1 bs-tooltip"
                                    title="Domain Server"></i>Domain Server :</label>
                            <input type="text" name="domain" class="form-control maxlength" id="domain"
                                placeholder="Please Enter Domain" minlength="3" maxlength="100" required>
                            <span id="err_domain" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label for="netwatch"><i class="far fa-clock me-1 bs-tooltip"
                                    title="Netwatch Server"></i>Netwatch Server :</label>
                            <input type="text" name="netwatch" class="form-control maxlength" id="netwatch"
                                minlength="0" maxlength="15" placeholder="Please Enter Netwatch" required>
                            <span id="err_netwatch" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-6 mb-2">
                            <label for="location"><i class="fas fa-map-marker me-1 bs-tooltip"
                                    title="location"></i>Location :</label>
                            <input type="text" name="location" class="form-control maxlength" id="location"
                                placeholder="Please Enter location" minlength="3" maxlength="20" required>
                            <span id="err_location" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label for="sufiks"><i class="fas fa-indent me-1 bs-tooltip" title="Sufiks"></i>Sufiks
                                :</label>
                            <input type="text" name="sufiks" class="form-control maxlength" id="sufiks"
                                placeholder="Please Enter Sufiks" minlength="0" maxlength="20">
                            <span id="err_sufiks" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-6 mb-2">
                            <label for="username"><i class="fas fa-user me-1 bs-tooltip"
                                    title="Username Server"></i>Username :</label>
                            <input type="text" name="username" class="form-control maxlength" id="username"
                                placeholder="Please Enter Username" minlength="5" maxlength="100" required>
                            <span id="err_username" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label for="password"><i class="fas fa-fingerprint me-1 bs-tooltip"
                                    title="Password Server"></i>Password :</label>
                            <input type="password" name="password" class="form-control maxlength" id="password"
                                placeholder="Please Enter Password" minlength="5" maxlength="100" required>
                            <span id="err_password" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-4 mb-2">
                            <label for="port"><i class="fas fa-random me-1 bs-tooltip"
                                    title="Port Server"></i>Port :</label>
                            <input type="number" name="port" class="form-control" id="port"
                                placeholder="Please Enter Port" value="0" min="0" required>
                            <span id="err_port" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4 mb-2">
                            <label for="price"><i class="fas fa-dollar-sign me-1 bs-tooltip"
                                    title="Price Server"></i>Price :</label>
                            <input type="number" name="price" class="form-control" id="price"
                                placeholder="Please Enter Price" value="0" min="0" required>
                            <span id="err_price" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-4 mb-2">
                            <label for="annual_price"><i class="fas fa-dollar-sign me-1 bs-tooltip"
                                    title="Annual Price Server"></i>Annual Price :</label>
                            <input type="number" name="annual_price" class="form-control" id="annual_price"
                                placeholder="Please Enter Annual Price" value="0" min="0" required>
                            <span id="err_annual_price" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-6 mb-2">
                            <label for="last_ip"><i class="fas fa-undo me-1 bs-tooltip"
                                    title="Last IP Server"></i>Last IP :</label>
                            <input type="number" name="last_ip" class="form-control" id="last_ip"
                                placeholder="Please Enter Last IP" value="0" min="0" required>
                            <span id="err_last_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label for="last_port"><i class="fas fa-step-forward me-1 bs-tooltip"
                                    title="Last Port Server"></i>Last Port :</label>
                            <input type="number" name="last_port" class="form-control" id="last_port"
                                placeholder="Please Enter Last Port" value="0" min="0" required>
                            <span id="err_last_port" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-md-6 mb-2">
                            <label for="count_ip"><i class="fas fa-stopwatch-20 me-1 bs-tooltip"
                                    title="Count IP Server"></i>Count IP :</label>
                            <input type="number" name="count_ip" class="form-control" id="count_ip"
                                placeholder="Please Enter Count IP" value="0" min="0" required>
                            <span id="err_count_ip" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label class="bs-tooltip" for="active" title="Option Active Server"></label>
                            <div class="form-check ps-0">
                                <div class="switch form-switch-custom switch-inline form-switch-primary mt-4">
                                    <input class="switch-input" type="checkbox" role="switch" id="active"
                                        name="active" checked>
                                    <label class="switch-label" for="active">Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label class="bs-tooltip" for="available" title="Option Available Server"></label>
                            <div class="form-check ps-0">
                                <div class="switch form-switch-custom switch-inline form-switch-primary mt-4">
                                    <input class="switch-input" type="checkbox" role="switch" id="available"
                                        name="available" checked>
                                    <label class="switch-label" for="available">Available</label>
                                </div>
                            </div>
                        </div>
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
