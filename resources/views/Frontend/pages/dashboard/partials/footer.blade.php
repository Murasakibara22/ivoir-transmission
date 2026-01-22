{{-- resources/views/partials/footer.blade.php --}}

<nav class="bottom-nav">
    {{-- Accueil --}}
    <a href="{{ route('espace_user.home')}}" class="nav-item {{ request()->routeIs('espace_user.home') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        <span class="nav-label">Accueil</span>
    </a>

    {{-- Rdv --}}
    <a href="{{ route('espace_user.rdv') }}" class="nav-item {{ request()->routeIs('espace_user.rdv') ? 'active' : '' }} ">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <span class="nav-label">Rdv</span>
    </a>

    {{-- FAB Réserver (Bouton central) --}}
    <button class="nav-fab" onclick="window.location.href='{{ route('espace_user.reservation') }}'">
        <svg class="fab-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span class="fab-label">Réserver</span>
    </button>

    {{-- Paiements --}}
    <a href="{{ route('espace_user.paiement')}}" class="nav-item {{ request()->routeIs('espace_user.paiement') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
        </svg>
        <span class="nav-label">Paiem.</span>
    </a>

    {{-- Profil --}}
    <a href="{{ route('espace_user.profile') }}" class="nav-item {{ request()->routeIs('espace_user.profile') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <span class="nav-label">Profil</span>
    </a>
</nav>
