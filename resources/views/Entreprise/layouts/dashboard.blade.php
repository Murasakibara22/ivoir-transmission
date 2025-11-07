<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Entreprise') - Ivoire Transmission</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('entreprise/assets/css/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- PWA Meta -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#2563eb">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/icons/icon-192x192.png') }}">

    @livewireStyles

    @stack('styles')
</head>
<body class="h-full bg-slate-900">
    <div class="dashboard-container">

        <!-- Desktop Sidebar -->
        <aside class="dashboard-sidebar hide-mobile fixed inset-y-0 left-0 z-50 w-64 bg-slate-800/90 backdrop-blur-xl border-r border-slate-700/50">
            @include('Entreprise.partials.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="dashboard-main lg:ml-64">
            <!-- Top Navigation -->
            <header class="dashboard-header bg-slate-800/90 backdrop-blur-xl border-b border-slate-700/50 px-4 py-3 lg:px-6">
                @include('Entreprise.partials.navbar')
            </header>


            <!-- Page Content -->
            <main class="p-4 lg:p-6">
                @yield('content')
            </main>
        </div>

        <!-- Mobile Bottom Navigation -->
        <nav class="dashboard-sidebar show-mobile fixed bottom-0 inset-x-0 z-50 bg-slate-800/95 backdrop-blur-xl border-t border-slate-700/50">
            @include('Entreprise.partials.mobile-nav')
        </nav>
    </div>


    {{-- @livewire('entreprise.change-password-modal') --}}

    @livewireScripts
    <!-- Scripts -->
    <script src="{{ asset('entreprise/assets/js/dashboard.js') }}"></script>
    @stack('scripts')
</body>
</html>
