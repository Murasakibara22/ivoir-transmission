<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/default/auth-signin-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Jun 2023 15:34:51 GMT -->
<head>

    <meta charset="utf-8" />
    <title>IVOIRE TRANSMISSION | @stack('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tableau de bord IVOIRE TRANSMISSION" name="description" />
    <meta content="joackim_clby" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{secure_asset('icologIVOIRE TRANSMISSION.jpg')}}">

    <!-- Layout config Js -->
    <script src="{{secure_asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{secure_asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{secure_asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{secure_asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{secure_asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    @stack('styles')

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>

       <livewire:auth.login />


    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{secure_asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{secure_asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{secure_asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{secure_asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{secure_asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{secure_asset('assets/js/plugins.js') }}"></script>

    <!-- password-addon init -->
    <script src="{{secure_asset('assets/js/pages/password-addon.init.js') }}"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/auth-signin-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Jun 2023 15:34:51 GMT -->
</html>
