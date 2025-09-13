<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/IVOIRE TRANSMISSION/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Jun 2023 15:30:56 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Dashboard | IVOIRE TRANSMISSION - @stack('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="fr-FR">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="user-id" content="{{auth()->id()}}">

    <!-- SEO Général -->
    <meta name="description" content="Tableau de bord de gestion de IVOIRE TRANSMISSION. Suivez les ventes, les commandes, les stocks et optimisez la gestion de votre boutique de mèches en Côte d'Ivoire.">
    <meta name="keywords" content="tableau de bord, gestion boutique, administration, suivi des ventes, commandes, stocks, IVOIRE TRANSMISSION, Côte d'Ivoire">
    <meta name="author" content="IVOIRE TRANSMISSION">
    <meta name="copyright" content="by IVOIRE TRANSMISSION">
    <meta name="robots" content="noindex, nofollow">
    <meta name="generator" content="IVOIRE TRANSMISSION">

    <!-- Open Graph (Facebook, WhatsApp) -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr-FR">
    <meta property="og:site_name" content="IVOIRE TRANSMISSION - Tableau de Bord">
    <meta property="og:title" content="IVOIRE TRANSMISSION - Tableau de Bord Administratif">
    <meta property="og:description" content="Gérez facilement les ventes, les commandes et les stocks de votre boutique IVOIRE TRANSMISSION. Interface intuitive pour optimiser la gestion de votre commerce.">
    <meta property="og:url" content="https://twinshair-ci.com/dashboard/home">
    <meta property="og:image" content="https://twinshair-ci.com/public/frontend/assets/logo.jpeg">
    <meta property="og:image:alt" content="IVOIRE TRANSMISSION - Interface de Gestion">
    <meta property="og:country-name" content="Côte d'Ivoire">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="IVOIRE TRANSMISSION - Tableau de Bord">
    <meta name="twitter:description" content="Accédez au tableau de bord de gestion de votre boutique IVOIRE TRANSMISSION et optimisez vos ventes en Côte d'Ivoire.">
    <meta name="twitter:image" content="https://twinshair-ci.com/images/dashboard.jpg">
    <meta name="twitter:site" content="@TwinsHairCI">

    <!-- Géolocalisation -->
    <meta name="geo.country" content="CI">
    <meta name="country" content="CI">

    <meta content="Themesbrand" name="joackim_clby" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/logo.jpeg') }}">

    <!-- jsvectormap css -->
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        /* Overlay pour griser complètement le modal et désactiver les inputs */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7); /* Assure que le fond est bien grisé et opaque */
            z-index: 10; /* S'assure que l'overlay est bien au-dessus des inputs */
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .overlay .spinner {
            pointer-events: all; /* Active les interactions uniquement pour le spinner si nécessaire */
        }

        /* Spinner pour indiquer le chargement */
        .spinner {
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top: 5px solid #fff;
            border-radius: 50%;
            margin-inline: auto;
            margin-block: auto;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">



        @include('Dashboard/partials/header')

        <div class="vertical-overlay"></div>


        @include('Dashboard/partials/navbar')

        <div class="main-content">

            @yield('content')

            @include('Dashboard/partials/footer')

        </div>




    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>


 <!-- JAVASCRIPT -->
 <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
 <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
 <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
 <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
 <script src="{{ asset('assets/js/plugins.js') }}"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


 <script>
    function printPageAsPDF() {
        const { jsPDF } = window.jspdf;

        // Créer un nouvel objet jsPDF
        const doc = new jsPDF();

        // Ajouter le contenu de la page actuelle à PDF
        doc.html(document.body, {
            callback: function (doc) {
                // Ouvre le PDF dans une nouvelle fenêtre pour l'impression
                doc.autoPrint();
                window.open(doc.output('bloburl'), '_blank');
            },
            margin: [10, 10, 10, 10],  // Définit les marges
            x: 10,
            y: 10
        });
    }
</script>


 <!-- apexcharts -->
 <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <!-- Vector map-->
  <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
  <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
 <!-- Swiper Js -->
 <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Sweet Alerts js -->
  <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

  <!-- Sweet alert init js-->
  <script src="{{ asset('assets/js/pages/sweetalerts.init.js') }}"></script>
  <script src="{{ asset('assets/js/NotificationSweet.js') }}"></script>

   <!-- ecommerce product details init -->
   <script src="{{ asset('assets/js/pages/ecommerce-product-details.init.js') }}"></script>

 <!-- CRM js -->
  <!-- Dashboard init -->
 <script src="{{ asset('assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

 <!-- App js -->
 <script src="{{ asset('assets/js/app.js') }}"></script>

@stack('scripts')
</body>


</html>
