<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ZVespa - WebApp</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

        <!-- Favicon -->
        <link href="{{ asset('assets/customer/img/vespa-icon.png') }}" rel="icon"/>

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="{{ asset('assets/customer/vendor/fontFamily/fontFamilyPoppins.css') }}" rel="stylesheet" />

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('assets/customer/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('assets/customer/css/style.css') }}" rel="stylesheet" />

        @yield('styles')
    </head>

    <body>
        <!-- Header -->
        @include('layouts.client.partials.header')
        <!-- Header End -->

        <!-- Content -->
            @yield('master-content')
            @include('sweetalert::alert')
        <!-- End Content -->

        <!-- Footer --!>
            @include('layouts.client.partials.footer')
        <!-- End Footer --!>

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up text-white"></i></a>

        <!-- JavaScript Libraries -->
        <script src="{{ asset('assets/customer/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('assets/customer/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/customer/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('assets/customer/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/customer/vendor/font-Awesome/fontAwesome_all.min.js') }}"></script>

        <!-- Contact Javascript File -->
        <script src="{{ asset('assets/customer/mail/jqBootstrapValidation.min.js') }}"></script>
        <script src="{{ asset('assets/customer/mail/contact.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('assets/customer/js/main.js') }}"></script>
        @yield('script')
    </body>
</html>