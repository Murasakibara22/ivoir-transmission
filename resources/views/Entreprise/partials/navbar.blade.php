{{-- resources/views/dashboard/partials/navbar.blade.php --}}
<div class="flex items-center justify-between">
    <!-- Left: Mobile menu toggle + breadcrumb -->
    <div class="flex items-center">
        <!-- Mobile menu toggle -->
        <button class="lg:hidden p-2 text-slate-400 hover:text-white rounded-lg" id="mobile-menu-toggle">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <!-- Breadcrumb -->
        <nav class="hidden sm:flex ml-4 lg:ml-0">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('entreprise.dashboard.index') }}" class="text-slate-400 hover:text-white transition-colors">
                        Dashboard
                    </a>
                </li>
                @if(!request()->routeIs('entreprise.dashboard.index'))
                    <li class="text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </li>
                    <li class="text-white">
                        @yield('breadcrumb', 'Page actuelle')
                    </li>
                @endif
            </ol>
        </nav>
    </div>

    <!-- Right: Search + notifications + user menu -->
    <div class="flex items-center space-x-4">

        <!-- Search (desktop only) -->
        <div class="hidden lg:block relative">
            <input
                type="text"
                placeholder="Rechercher véhicule, RDV..."
                class="w-64 px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                data-search="global"
            >
            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        <!-- Notifications -->
        <div class="dropdown">
            <button class="p-2 text-slate-400 hover:text-white rounded-lg relative" id="notifications-toggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-3.5-3.5a7 7 0 10-4.95 4.95L15 17zm-3.586 0L9 19.414V21a2 2 0 01-2 2H5a2 2 0 01-2-2v-1.586L9.414 15H5a7 7 0 110-14h4.414L3 7.414V6a2 2 0 012-2h2a2 2 0 012 2v1.414L14.586 1H19a7 7 0 110 14h-4.414L17 17.414V19a2 2 0 01-2 2h-2a2 2 0 01-2-2v-1.586L11.414 17z"/>
                </svg>
                <!-- Notification badge -->
                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                    3
                </span>
            </button>

            <!-- Notifications dropdown -->
            <div class="dropdown-menu notifications-dropdown" id="notifications-dropdown">
                <div class="user-info">
                    <div class="flex items-center justify-between">
                        <h3 class="text-white font-semibold">Notifications</h3>
                        <button class="text-blue-400 text-sm hover:text-blue-300">
                            Tout marquer lu
                        </button>
                    </div>
                </div>

                <div class="max-h-96 overflow-y-auto">
                    <!-- Notification 1 -->
                    <div class="notification-item">
                        <div class="flex">
                            <div class="notification-dot urgent"></div>
                            <div class="flex-1">
                                <p class="text-white text-sm font-medium">Maintenance urgente</p>
                                <p class="text-slate-400 text-xs mt-1">Mercedes Sprinter - Vidange dépassée</p>
                                <p class="text-slate-500 text-xs mt-1">Il y a 2 heures</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notification 2 -->
                    <div class="notification-item">
                        <div class="flex">
                            <div class="notification-dot info"></div>
                            <div class="flex-1">
                                <p class="text-white text-sm font-medium">RDV confirmé</p>
                                <p class="text-slate-400 text-xs mt-1">Demain 9h00 - Diagnostic Peugeot Expert</p>
                                <p class="text-slate-500 text-xs mt-1">Il y a 4 heures</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notification 3 -->
                    <div class="notification-item">
                        <div class="flex">
                            <div class="notification-dot success"></div>
                            <div class="flex-1">
                                <p class="text-white text-sm font-medium">Nouveau véhicule ajouté</p>
                                <p class="text-slate-400 text-xs mt-1">BMW X3 - MN-456-OP ajouté avec succès</p>
                                <p class="text-slate-500 text-xs mt-1">Hier</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 border-t border-slate-700">
                    <a href="#" class="block text-center text-blue-400 hover:text-blue-300 text-sm font-medium">
                        Voir toutes les notifications
                    </a>
                </div>
            </div>
        </div>

        <!-- User menu -->
        <div class="dropdown">
            <button class="flex items-center space-x-3 p-2 text-slate-400 hover:text-white rounded-lg" id="user-menu-toggle">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <span class="text-white text-sm font-medium">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </span>
                </div>
                <div class="hidden sm:block text-left">
                    <p class="text-white text-sm font-medium">{{ auth()->user()->name ?? 'Utilisateur' }}</p>
                    <p class="text-slate-400 text-xs">{{ auth()->user()->company ?? 'Entreprise' }}</p>
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- User dropdown -->
            <div class="dropdown-menu user-dropdown" id="user-dropdown">
                <div class="user-info">
                    <p class="text-white font-medium">{{ auth()->user()->name ?? 'Utilisateur' }}</p>
                    <p class="text-slate-400 text-sm">{{ auth()->user()->email ?? 'email@exemple.com' }}</p>
                </div>

                <div class="p-2">
                    <a href="#" class="dropdown-item">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Mon profil
                    </a>

                    <a href="#" class="dropdown-item">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Paramètres
                    </a>

                    <a href="#" class="dropdown-item">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Aide & Support
                    </a>
                </div>

                <div class="p-2 border-t border-slate-700">
                    <form method="POST" action="{{ route('deconnexion') }}">
                        @csrf
                        <button type="submit" class="dropdown-item danger w-full text-left">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle dropdowns avec les nouvelles classes
        const notificationsToggle = document.getElementById('notifications-toggle');
        const notificationsDropdown = document.getElementById('notifications-dropdown');
        const userToggle = document.getElementById('user-menu-toggle');
        const userDropdown = document.getElementById('user-dropdown');

        // Vérifier que les éléments existent
        if (!notificationsToggle || !notificationsDropdown || !userToggle || !userDropdown) {
            return;
        }

        // Fonction pour fermer tous les dropdowns
        function closeAllDropdowns() {
            notificationsDropdown.classList.remove('show');
            userDropdown.classList.remove('show');
        }

        // Toggle notifications dropdown
        notificationsToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = notificationsDropdown.classList.contains('show');
            closeAllDropdowns();
            if (!isOpen) {
                notificationsDropdown.classList.add('show');
            }
        });

        // Toggle user dropdown
        userToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = userDropdown.classList.contains('show');
            closeAllDropdowns();
            if (!isOpen) {
                userDropdown.classList.add('show');
            }
        });

        // Fermer les dropdowns en cliquant à l'extérieur
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                closeAllDropdowns();
            }
        });

        // Fermer avec la touche Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAllDropdowns();
            }
        });

        // Empêcher la fermeture quand on clique dans le dropdown
        notificationsDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        userDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
</script>
