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
                            <label class="control-label" for="name">Name :</label>
                            <input type="text" name="name" class="form-control maxlength" id="name"
                                placeholder="Please Enter Name" minlength="1" maxlength="50" required>
                            <span id="err_name" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label class="control-label" for="skin">Skin :</label>
                            <select name="skin" id="skin" class="form-control select2" style="width: 100%;">
                                <option value="">Default</option>
                            </select>
                            <span id="err_skin" class="error invalid-feedback" style="display: hide;"></span>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="form-group mb-2"> --}}
                        @php
                            $policies = [
                                'read',
                                'winbox',
                                'local',
                                'telnet',
                                'ssh',
                                'ftp',
                                'reboot',
                                'write',
                                'policy',
                                'test',
                                'password',
                                'web',
                                'sniff',
                                'sensitive',
                                'api',
                                'romon',
                                'dude',
                                'tikapp',
                            ];
                        @endphp
                        @foreach ($policies as $item)
                            <div class="col-lg-3 col-md-3 col-6 mb-2 mt-2">
                                <div class="switch form-switch-custom switch-inline form-switch-success">
                                    <input class="switch-input" type="checkbox" role="switch" id="{{ $item }}"
                                        name="{{ $item }}" checked>
                                    <label class="switch-label" for="{{ $item }}">{{ $item }}</label>
                                </div>
                            </div>
                        @endforeach
                        {{-- </div> --}}
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
