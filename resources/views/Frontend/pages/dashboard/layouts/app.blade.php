<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#4A5C8C">
    <title>GaragePro - Accueil</title>
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/style.css') }}">
</head>
<body>

    {{-- Header --}}
    @include('Frontend.pages.dashboard.partials.header')

    {{-- Main Content --}}
    <main class="pwa-content">

       @yield('content')

    </main>

    {{-- Footer (Bottom Nav) --}}
    @include('Frontend.pages.dashboard.partials.footer')


    @stack('srcipts')


    


</body>
</html>
