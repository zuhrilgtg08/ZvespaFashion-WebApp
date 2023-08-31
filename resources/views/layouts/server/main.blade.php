<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard Managements</title>
        <!-- Custom fonts for this template-->
        <link href="{{ asset('assets/dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/dashboard/css/fontFamilyNunito.css') }}" rel="stylesheet"/>
        <!-- Custom styles for this template-->
        <link href="{{ asset('assets/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet"/>
        <!-- Favicon -->
        <link href="{{ asset('assets/customer/img/vespa-icon.png') }}" rel="icon" />
        @stack('style')
    </head>

    <body id="page-top">
        <div id="wrapper">
                @include('layouts.server.partials.sidebar')

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('layouts.server.partials.navbar')

                    <div class="container-fluid">
                        @yield('main-content')
                    </div>
                </div>
                    @include('layouts.server.partials.footer')
            </div>
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        {{-- <script type="text/javascript" src="{{ asset('assets/dashboard/vendor/jquery/jquery-3.6.0.min.js') }}"></script> --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
        <script src="{{ asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets/dashboard/js/sb-admin-2.min.js') }}"></script>
        @stack('script')
    </body>
</html>