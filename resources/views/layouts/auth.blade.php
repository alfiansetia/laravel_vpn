<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/font-icons/fontawesome-free/css/all.min.css') }}">

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css">
    @stack('css')
</head>

<body class="form">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>
    @guest
    @else
        <form action="{{ route('logout') }}" method="POST" id="form_logout">
            @csrf
        </form>
    @endguest
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/font-icons/feather/feather.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    @stack('js')
    <script>
        function pw() {
            var togglePassword = document.getElementById("toggle-password");
            var formContent = document.getElementsByClassName('form-content')[0];
            var getFormContentHeight = formContent.clientHeight;
            var formImage = document.getElementsByClassName('form-image')[0];
            if (formImage) {
                var setFormImageHeight = formImage.style.height = getFormContentHeight + 'px';
            }
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

        }

        function con_pw() {
            var y = document.getElementById("password_confirm");
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
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
                    }
                },
                messages: {
                    'term[]': {
                        required: "plase check our term and privacy."
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.field-wrapper').append(error);
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
