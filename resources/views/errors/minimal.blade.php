<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/error/style-400.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>

<body class="error404 text-center">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mr-auto mt-5 text-md-left text-center">
                <a href="{{ route('home') }}" class="ml-md-5">
                    <img alt="image-404" src="{{ asset('assets/img/logo/logo2.svg') }}" class="theme-logo">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number">@yield('code')</h1>
            <p class="mini-text">Ooops!</p>
            <p class="error-text mb-4 mt-1">@yield('message')</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-5">Go Back</a>
            <a href="https://api.whatsapp.com/send/?phone={{ env('CONTACT_WA_ERROR') }}&text=Halo, Saya Ingin Mengkonfirmasi bahwa terjadi Error Di Server. Terima Kasih."
                class="btn btn-info mt-5" target="_blank">Chat Admin</a>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>

</html>
