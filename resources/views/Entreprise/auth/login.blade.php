<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - Ivoire Transmission</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('entreprise/assets/css/auth.css') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="h-full">
    <div class="min-h-screen gradient-bg relative flex items-center justify-center mobile-safe-area">
        <!-- Floating background elements -->
        <div class="floating-elements"></div>

        <!-- Login Container -->
        <div class="w-full max-w-md px-4">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Ivoire Transmission</h1>
                <p class="text-gray-400 text-sm">Espace Entreprise</p>
            </div>

            <!-- Login Card -->
            <div class="card-glass rounded-3xl p-8 shadow-2xl">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-white mb-2">Connexion</h2>
                    <p class="text-gray-400 text-sm">Accédez à votre tableau de bord</p>
                </div>

                <livewire:entreprise.auth.login />

                <!-- Footer -->
                <div class="mt-6 pt-6 border-t border-white/10">
                    <p class="text-center text-sm text-gray-400">
                        Pas encore de compte ?
                        <a href="#" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">
                            Contactez-nous
                        </a>
                    </p>
                </div>
            </div>

            <!-- Mobile App Hint -->
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">
                    Ajoutez cette page à votre écran d'accueil pour une expérience optimale
                </p>
            </div>
        </div>
    </div>

    @stack('scripts')
     @livewireScripts
    <script src="{{ asset('entreprise/assets/js/auth.js') }}" type="text/javascript"> </script>
</body>
</html>
