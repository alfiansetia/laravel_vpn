<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="keywords"
        content="vpn, vpn remote, vpn remote mikrotik, remote diluar jaringan, remote device diluar jaringan, solusi ip publik, solusi ip publik dinamis, ip publik indihome, solusi ip publik indihome, cloud hosting, web hosting, hosting, vpn remote murah">
    <meta name="description"
        content="KCNET Merupakan layanan Tunneling yang bisa digunakan untuk kebutuhan jaringan seperti vpn remote device, ddns, & cloud hosting. Solusi untuk ip publik dinamis">
    <meta name="author" content="Mexious Teknologi Indonesia">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | {{ $company->name }} - {{ $company->slogan }} </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/default/favicon.ico') }}" />

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

    <link rel="stylesheet" href="{{ asset('backend/src/plugins/src/font-icons/fontawesome-free/css/all.min.css') }}">

    <link href="{{ asset('backend/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/layouts/modern-light-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/layouts/modern-light-menu/css/dark/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('backend/src/assets/css/light/elements/tooltip.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/elements/tooltip.css') }}" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    @stack('csslib')
    @stack('css')
    <!--  END CUSTOM STYLE FILE  -->

</head>

<body>

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('components.backend.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('components.backend.sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="middle-content container-xxl p-0">

                    @yield('content')

                </div>
            </div>

            <!--  BEGIN FOOTER  -->
            @include('components.backend.footer')
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <form action="{{ route('logout') }}" method="POST" id="form_logout">
        @csrf
    </form>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('backend/src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('backend/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/layouts/modern-light-menu/app.js') }}"></script>
    <script src="{{ asset('backend/src/assets/js/custom.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/font-icons/feather/feather.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src//blockui/jquery.blockUI.min.js') }}"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    @stack('jslib')
    @stack('js')

    @if (session()->has('success'))
        <script>
            Swal.fire(
                'Success',
                "{{ session('success') }}",
                'success'
            )
        </script>
    @elseif(session()->has('error'))
        <script>
            Swal.fire(
                'Failed!',
                "{{ session('error') }}",
                'error'
            )
        </script>
    @endif

    <script>
        feather.replace();

        function unblock() {
            $('button').prop('disabled', false);
            $.unblockUI();
        }

        function block() {
            $('button').prop('disabled', true);
            $.blockUI({
                message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
                fadeIn: 800,
                // timeout: 2000, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#1b2024',
                    opacity: 0.8,
                    zIndex: 1200,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    color: '#fff',
                    zIndex: 1201,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        }

        function logout_() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logout!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                confirmButtonAriaLabel: 'Thumbs up, Yes!',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                cancelButtonAriaLabel: 'Thumbs down',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                padding: '2em',
                customClass: 'animated tada',
                showClass: {
                    popup: `animated tada`
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form_logout').submit();
                }
            })
        }

        function tooltip() {
            var bsTooltip = document.querySelectorAll('.bs-tooltip')
            for (let index = 0; index < bsTooltip.length; index++) {
                var tooltip = new bootstrap.Tooltip(bsTooltip[index])
            }
        }

        function redirect(url) {
            block()
            window.location.href = url;
        }
        // $(document).ready(function(){
        //     console.clear();
        // })

        $('.bs-tooltip').on("mouseleave", function() {
            $(this).tooltip("hide");
        })
    </script>
</body>

</html>
