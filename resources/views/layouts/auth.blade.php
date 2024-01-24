<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    <title>{{ $title }} | {{ $company->name }} - {{ $company->slogan }} </title>
    <link rel="icon" type="image/x-icon" href="{{ $company->logo_light }}" />

    <script>
        var light_logo = "{{ $company->logo_light }}";
        var dark_logo = "{{ $company->logo_dark }}";
    </script>

    <link href="{{ asset('backend/layouts/modern-light-menu/css/light/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/layouts/modern-light-menu/css/dark/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <script src="{{ asset('backend/layouts/modern-light-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('backend/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/layouts/modern-light-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/assets/css/light/authentication/auth-cover.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/layouts/modern-light-menu/css/dark/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/authentication/auth-cover.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('backend/src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('backend/src/assets/css/light/elements/tooltip.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/elements/tooltip.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    @stack('csslib')
    @stack('css')

</head>

<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            @yield('content')
        </div>

    </div>

    <form action="{{ route('logout') }}" method="POST" id="form_logout">
        @csrf
    </form>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('backend/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('backend/src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/font-icons/feather/feather.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    @stack('jslib')
    @stack('js')

    <script>
        tooltip()

        function tooltip() {
            var bsTooltip = document.querySelectorAll('.bs-tooltip')
            for (let index = 0; index < bsTooltip.length; index++) {
                var tooltip = new bootstrap.Tooltip(bsTooltip[index])
            }
        }

        function pw() {
            var x = document.getElementById("password");
            var toggle = document.getElementById("toggle-password");
            if (x.type === "password") {
                toggle.innerHTML = "<i data-feather='eye'></i>"
                x.type = "text";
            } else {
                toggle.innerHTML = "<i data-feather='eye-off'></i>"
                x.type = "password";
            }
            feather.replace()
        }

        function pw_con() {
            var y = document.getElementById("password_confirmation");
            var toggle = document.getElementById("toggle-password2");
            if (y.type === "password") {
                toggle.innerHTML = "<i data-feather='eye'></i>"
                y.type = "text";
            } else {
                toggle.innerHTML = "<i data-feather='eye-off'></i>"
                y.type = "password";
            }
            feather.replace()
        }

        $(document).ready(function() {
            feather.replace();

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $('form').submit(function(event) {
                // event.preventDefault();
                $('button[type="submit"]').prop('disabled', true);
            }).validate({
                rules: {
                    'term[]': {
                        required: true
                    },
                },
                messages: {
                    'term[]': {
                        required: "plase check our term and privacy."
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    $('button[type="submit"]').prop('disabled', false);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).addClass('is-valid');
                }
            });
        })
    </script>


</body>

</html>
