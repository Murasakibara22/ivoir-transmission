<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>IVOIRE TRANSMISSION - @stack('title') </title>
    <meta name="description" content="AutoService is a responsive Template best suitable for mechanic auto shop, car repair, auto mechanic, car service, auto repair shop, mechanic workshop, auto service, automotive, batteries, tire or wheel shop.">
    <meta name="keywords" content="car repair, auto service, car service, automotive, mechanic auto shop, automotive, mechanic workshop">
    <meta name="author" content="https://ivoiretransmission.com">
    <meta name="user-id" content="{{auth()->id()}}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/style.css')}}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/icon/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/assets/icon/apple-touch-icon-158-precomposed.png')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->


</head>

<body class="page header-fixed no-sidebar site-layout-full-width header-style-3 menu-has-search menu-has-cart">

<div id="wrapper" class="animsition">
<div id="page" class="clearfix">

        @include('Frontend/partials/header')

            @yield('content')

        @include('Frontend/partials/footer')





    </div><!-- /#page -->
</div><!-- /#wrapper -->

<a id="scroll-top"></a>

<!-- Javascript -->
<script src="{{ asset('frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/plugins.js')}}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/animsition.js')}}"></script>
<script src="{{ asset('frontend/assets/js/countto.js')}}"></script>
<script src="{{ asset('frontend/assets/js/cubeportfolio.js')}}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/magnific.popup.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/equalize.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/shortcodes.js')}}"></script>
<script src="{{ asset('frontend/assets/js/main.js')}}"></script>

<!-- Revolution Slider -->
<script src="{{ asset('frontend/includes/rev-slider/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{ asset('frontend/includes/rev-slider/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/rev-slider.js')}}"></script>
<!-- Load Extensions only on Local File Systems ! The following part can be removed on Server for On Demand Loading -->
<script src="{{ asset('frontend/includes/rev-slider/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{ asset('frontend/includes/rev-slider/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{ asset('frontend/includes/rev-slider/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{ asset('frontend/includes/rev-slider/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{ asset('frontend/includes/rev-slider/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{ asset('frontend/includes/rev-slider/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{ asset('frontend/includes/rev-slider/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{ asset('frontend/includes/rev-slider/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{ asset('frontend/includes/rev-slider/js/extensions/revolution.extension.video.min.js')}}"></script>

</body>
</html>


