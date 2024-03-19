@extends('layouts.backend.template', ['title' => 'Order Vpn'])
@push('csslib')
    <link href="{{ asset('backend/src/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/src/assets/css/light/forms/switches.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/pricing-table/css/component.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/forms/switches.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/dark/pricing-table/css/component.css') }}" rel="stylesheet"
        type="text/css">

    <link href="{{ asset('backend/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="middle-content container-xxl p-0">

        <div class="row" id="cancel-row">
            <div class="col-lg-6 layout-top-spacing">
                <blockquote class="blockquote">
                    <div class="widget-heading">
                        <h5 class="">Informasi VPN</h5>
                    </div>
                    <ul class="list-icon">
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline">VPN Remote berfungsi untuk remote perangkat anda dari luar
                                jaringan.</span>
                        </li>
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline">Ini dapat digunakan sebagai alternative dari tidak tersedianya ip
                                public pada
                                isp anda.</span>
                        </li>
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline">1 Akun VPN bisa digunakan untuk 3 remote port </span>
                        </li>
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline">Koneksi VPN ini bisa menggunakan protokol PPTP, L2TP, SSTP &
                                OpenVPN.</span>
                        </li>
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline">Masa trial berlaku selama 1 Hari</span>
                        </li>
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline">1 User Hanya Bisa create 1 akun VPN Trial. Untuk Menambah akun
                                VPN maka silahkan lakukan pembayaran akun trial tsb.</span>
                        </li>
                        {{-- <li>
                                    <i data-feather="arrow-right"></i>
                                    <span class="d-inline">1 User Hanya Mendapat 1 Free Akun. Untuk Menambah akun VPN silahkan Pilih
                                        Server berbayar.</span>
                                </li> --}}
                    </ul>
                </blockquote>
            </div>

            <div class="col-lg-6 layout-top-spacing">
                <blockquote class="blockquote">
                    <div class="widget-heading">
                        <h5 class="">Informasi Pengisian</h5>
                    </div>
                    <ul class="list-icon">
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline"><b>VPN Server</b> : Silahkan pilih sesuai lokasi server & harga yang ada
                                inginkan.</span>
                        </li>
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline"><b>Username</b> : Silahkan isi username untuk akun vpn anda.</span>
                        </li>
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline"><b>Password</b> : Silahkan isi password untuk akun vpn anda.</span>
                        </li>
                        <li>
                            <i data-feather="arrow-right"></i>
                            <span class="d-inline">Harap diperhatikan kembali data yang anda isi sebelum order vpn
                                !!!</span>
                        </li>
                    </ul>
                </blockquote>
            </div>


            <div class="col-lg-12 layout-spacing layout-top-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">

                        <div class="pricing-table-2 ">

                            <!-- Billing Cycle  -->
                            <div class="billing-cycle-radios mt-5">

                                <div
                                    class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-label-toggle show">
                                    <div class="input-checkbox">
                                        <span class="switch-chk-label label-left">Monthly</span>
                                        <input class="switch-input" type="checkbox" role="switch" id="toggle-1" checked
                                            onchange="this.checked ? this.closest('.inner-label-toggle').classList.add('show') : this.closest('.inner-label-toggle').classList.remove('show')">
                                        <span class="switch-chk-label label-right">Yearly</span>
                                    </div>
                                </div>

                            </div>
                            <!-- Pricing Plans Container -->
                            <div class="pricing-plans-container mt-5 billed-yearly">
                                <!-- Plan -->
                                @foreach ($servers as $key => $item)
                                    <div class="pricing-plan mb-5 me-3 {{ $key == 0 ? 'recommanded' : '' }}">
                                        @php
                                            $hargaAsli = $item->price * 12;
                                            $hargaDiskon = $item->annual_price;
                                            $diskon = ceil((($hargaAsli - $hargaDiskon) / $hargaAsli) * 100);
                                        @endphp
                                        <span class="badge badge-pill badge-warning show">{{ $diskon }}% Off</span>

                                        <div class="pricing-header-section">
                                            <div class="pricing-header">
                                                <h3>{{ $item->name }}</h3>
                                                <p>{{ $item->location }}</p>
                                            </div>

                                            <div class="pricing-header-pricing">
                                                <p class="pricing monthly-pricing">
                                                    {{ $item->price }}
                                                    <br><span class="sub-title monthly-pricing-label">Per month</span>
                                                </p>
                                                <p class="pricing yearly-pricing">
                                                    {{ $item->annual_price }}
                                                    <br><span class="sub-title monthly-pricing-label">Per Year</span>
                                                </p>

                                            </div>
                                        </div>

                                        <div class="pricing-plan-features mb-4">
                                            <ul>
                                                <li>
                                                    <span><i data-feather="check"></i></span> 1 Day Trial
                                                </li>
                                                <li>
                                                    <span><i data-feather="check"></i></span> Custom Username
                                                </li>
                                                <li>
                                                    <span><i data-feather="check"></i></span> Custom Password
                                                </li>
                                                <li>
                                                    <span><i data-feather="check"></i></span> 3 Port (80, 8728, 8291)
                                                </li>
                                                <li>
                                                    <span><i data-feather="check"></i></span> Api APP
                                                </li>
                                                <li>
                                                    <span><i data-feather="check"></i></span> Speedtest Support
                                                </li>
                                                <li>
                                                    <span><i data-feather="check"></i></span> Server
                                                    {{ $item->location }}
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0);" class="button btn btn-dark btn-block margin-top-20"
                                            onclick="open_modal('{{ $key }}')">Select</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <form id="formcreate" action="" method="POST">
        <div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus me-1 bs-tooltip"
                                title="Add Data"></i>Create VPN Trial</h5>
                        <button type="button" class="btn-close bs-tooltip" data-bs-dismiss="modal" aria-label="Close"
                            title="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="form-group col-md-12">
                                <label for="server"><i class="fas fa-server me-1 bs-tooltip" title="Server"></i>Server
                                    :</label>
                                <select class="form-control" name="server" id="server" style="width: 100%" disabled
                                    required>
                                    <option value="">Select Server</option>
                                    @foreach ($servers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->location }}
                                            ({{ $item->domain }})
                                        </option>
                                    @endforeach
                                </select>
                                <span id="err_server" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group col-md-12">
                                <label for="username"><i class="far fa-user me-1 bs-tooltip"
                                        title="Username Vpn"></i>Username Vpn :</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="username" class="form-control maxlength" id="username"
                                        placeholder="Please Enter Username" minlength="4" maxlength="50"
                                        aria-describedby="sufiks" oninput="setLowercase()" required>
                                    <span class="input-group-text" id="sufiks">@example.com</span>
                                </div>
                                <span id="err_username" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group col-md-12">
                                <label for="password"><i class="fas fa-fingerprint me-1 bs-tooltip"
                                        title="Password Vpn"></i>Password Vpn :</label>
                                <input type="text" name="password" class="form-control maxlength" id="password"
                                    placeholder="Please Enter Password" minlength="4" maxlength="50" required>
                                <span id="err_password" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1 bs-tooltip"
                                title="Save"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('jslib')
    <script src="{{ asset('backend/src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/select2/custom-select2.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endpush


@push('js')
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        function setLowercase() {
            var inputElement = document.getElementById('username');
            inputElement.value = inputElement.value.toLowerCase();
        }

        $('.maxlength').maxlength({
            placement: "top",
            alwaysShow: true
        });

        $("#server").select2({
            dropdownParent: $("#modalAdd"),
        });

        servers = @json($servers)

        function open_modal(key) {
            server = servers[key]
            $('#server').val(server.id).change()
            $('#sufiks').text(server.sufiks)
            $('#modalAdd').modal('show')
        }

        var getSwithchInput = document.querySelector('#toggle-1');
        var pricingContainer = document.querySelector('.pricing-plans-container')

        getSwithchInput.addEventListener('change', function() {
            var isChecked = getSwithchInput.checked;
            if (isChecked) {
                pricingContainer.classList.add('billed-yearly');

                pricingContainer.querySelectorAll('.badge').forEach(element => {
                    element.classList.add('show')
                });

            } else {
                pricingContainer.classList.remove('billed-yearly')
                pricingContainer.querySelectorAll('.badge').forEach(element => {
                    element.classList.remove('show')
                });
            }
        })

        $('#formcreate').submit(function(event) {
            event.preventDefault();
        }).validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            submitHandler: function(form) {
                ajax_setup();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('vpn.autocreate') }}",
                    data: {
                        username: $('#username').val().toLowerCase(),
                        password: $('#password').val().toLowerCase(),
                        server: $('#server').val(),
                    },
                    beforeSend: function() {
                        block();
                        clear_validate($('#formcreate'))
                    },
                    success: function(res) {
                        unblock();
                        btn_reset();
                        Swal.fire(
                            'Success!',
                            res.message,
                            'success'
                        )
                    },
                    error: function(xhr, status, error) {
                        unblock();
                        handleResponseForm(xhr)

                    }
                });
            }
        });

        function btn_reset() {
            clear_validate($('#formcreate'))
            $('#username').val('')
            $('#password').val('')
        }
    </script>
@endpush
