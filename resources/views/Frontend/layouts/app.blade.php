<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>IVOIRE TRANSMISSION - Vidange moteur & boîte, diagnostic auto, garages et réservation en ligne  - @stack('title')</title>

    <!-- Encodage et langue -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="fr-FR">

    <!-- SEO de base -->
    <meta name="description" content="Ivoire Transmission (IVT) est la plateforme de référence en Côte d’Ivoire pour la vidange moteur et boîte, le diagnostic auto, la prise de rendez-vous en ligne et la mise en relation avec des garages partenaires.">
    <meta name="keywords" content="vidange moteur Abidjan, vidange boîte Côte d’Ivoire, diagnostic auto Abidjan, garages auto, entretien voiture, réservation vidange en ligne CI, Ivoire Transmission">
    <meta name="author" content="Ivoire Transmission" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
    <meta name="copyright" content="© Ivoire Transmission">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Open Graph (Facebook, WhatsApp, LinkedIn...) -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Ivoire Transmission">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:title" content="Ivoire Transmission - Vidange moteur & boîte, diagnostic auto et réservation en ligne">
    <meta property="og:description" content="Simplifiez l’entretien de votre voiture en Côte d’Ivoire : diagnostic auto, garages partenaires, réservation de vidange moteur et boîte en ligne avec Ivoire Transmission.">
    <meta property="og:image" content="{{ asset('logo.jpg') }}">
    <meta property="og:image:alt" content="Ivoire Transmission - Logo officiel">
    <meta property="og:url" content="https://ivoire-transmission.ci/">
    <meta property="og:country-name" content="Côte d’Ivoire">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ivoire Transmission - Vidange moteur & boîte, diagnostic auto et garages en Côte d’Ivoire">
    <meta name="twitter:description" content="Réservez facilement vos services auto en ligne : vidange moteur et boîte, diagnostic auto, garages partenaires en Côte d’Ivoire avec Ivoire Transmission.">
    <meta name="twitter:image" content="{{ asset('logo.jpg') }}">

    <!-- Informations géographiques -->
    <meta name="geo.region" content="CI-AB">
    <meta name="geo.country" content="CI">
    <meta name="country" content="CI">

    <!-- Technique -->
    <meta name="generator" content="Laravel">
    <meta name="user-id" content="{{auth()->id()}}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/style.css')}}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('apple-touch-icon.png')}}">

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


