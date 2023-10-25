@extends('layouts.template')

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-8 mb-2">
            <blockquote class="blockquote">
                <div class="widget-heading">
                    <h5 class="">Informasi VPN</h5>
                </div>
                <ul class="list-icon">
                    <li>
                        <i data-feather="arrow-right"></i>
                        <span class="d-inline">VPN Remote berfungsi untuk remote perangkat anda dari luar jaringan.</span>
                    </li>
                    <li>
                        <i data-feather="arrow-right"></i>
                        <span class="d-inline">Ini dapat digunakan sebagai alternative dari tidak tersedianya ip public pada
                            isp anda.</span>
                    </li>
                    <li>
                        <i data-feather="arrow-right"></i>
                        <span class="d-inline">1 Akun VPN bisa digunakan untuk beberapa remote port (Contact Admin jika
                            ingin nambah Port).</span>
                    </li>
                    <li>
                        <i data-feather="arrow-right"></i>
                        <span class="d-inline">Koneksi VPN ini bisa menggunakan protokol PPTP, L2TP, SSTP & OpenVPN.</span>
                    </li>
                    <li>
                        <i data-feather="arrow-right"></i>
                        <span class="d-inline">Masa trial berlaku selama 1 Hari</span>
                    </li>
                    <li>
                        <i data-feather="arrow-right"></i>
                        <span class="d-inline">1 User Hanya Bisa create 1 akun VPN Trial. Untuk Menambah akun VPN maka
                            silahkan lakukan pembayaran akun trial tsb.</span>
                    </li>
                    <li>
                        <i data-feather="arrow-right"></i>
                        <span class="d-inline">1 User Hanya Mendapat 1 Free Akun. Untuk Menambah akun VPN silahkan Pilih
                            Server berbayar.</span>
                    </li>
                </ul>
            </blockquote>

            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form id="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row mb-2">
                            <div class="form-group col-12">
                                <label for="server"><i class="fas fa-server mr-1" data-toggle="tooltip"
                                        title="Option Server"></i>Server :</label>
                                <select name="server" id="server" class="form-control" style="width: 100%;" required>
                                    <option value="">Please Select Server</option>
                                </select>
                                <span id="err_server" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <div class="form-group col-md-6">

                                <label for="username"><i class="far fa-user mr-1" data-toggle="tooltip"
                                        title="Username Vpn"></i>Username Vpn :</label>
                                <div class="input-group">
                                    <input type="text" name="username" class="form-control maxlength"
                                        aria-describedby="basic-addon2" id="username" placeholder="Please Enter Username"
                                        minlength="4" maxlength="50" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="sufiks">@kacangan.net</span>
                                    </div>
                                </div>
                                <span id="err_username" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password"><i class="fas fa-fingerprint mr-1" data-toggle="tooltip"
                                        title="Password Vpn"></i>Password Vpn :</label>
                                <input type="text" name="password" class="form-control maxlength" id="password"
                                    placeholder="Please Enter Password" minlength="4" maxlength="50" required>
                                <span id="err_password" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <button type="reset" id="reset" class="btn btn-warning ml-auto"><i
                                    class="fas fa-undo mr-1" data-toggle="tooltip" title="Reset"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"
                                    data-toggle="tooltip" title="Save"></i>Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
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
                        <span class="d-inline">Harap diperhatikan kembali data yang anda isi sebelum order vpn !!!</span>
                    </li>
                </ul>
            </blockquote>
        </div>
    </div>
@endsection

@push('jslib')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            var select = $("#server").select2({
                ajax: {
                    delay: 1000,
                    url: "{{ route('server.index') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: `${item.name} ${item.price === 0 || item.type === 'free' ? ('Free ' + ' ' + item.time_free + ' Bulan'): ('Rp.'+item.price)} ${item.location} ${item.is_active === 'no' ? "<Nonactive>" : "<Active>"}`,
                                    id: item.id,
                                    sufiks: item.sufiks,
                                    // disabled: item.is_active === 'no' ? true : false,
                                }
                            })
                        };
                    },
                }
            }).on('change', function() {
                let data = $(this).select2('data');
                $('#sufiks').text(data[0].sufiks);
                $('#input_sufiks').val(data[0].sufiks);
            });

            $('#reset').click(function() {
                $('#form .error.invalid-feedback').each(function(i) {
                    $(this).hide();
                });
                $('#form input.is-invalid').each(function(i) {
                    $(this).removeClass('is-invalid');
                });
                $('#server').val('').change();
            })

            $('#form').submit(function(event) {
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
                submitHandler: function(formArray) {
                    let form = $(formArray).serializeArray()
                    let d = {
                        name: 'username',
                        value: $('#username').val() + $('#sufiks').text(),
                    };
                    form[1] = d;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('vpn.autocreate') }}",
                        data: form,
                        beforeSend: function() {
                            block();
                            $('button[type="submit"]').prop('disabled', true);
                            console.log('loading bro');
                            $('#form .error.invalid-feedback').each(function(i) {
                                $(this).hide();
                            });
                            $('#form input.is-invalid').each(function(i) {
                                $(this).removeClass('is-invalid');
                            });
                        },
                        success: function(res) {
                            unblock();
                            $('button[type="submit"]').prop('disabled', false);
                            $('#reset').click();
                            swal(
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
        });
    </script>
@endpush
