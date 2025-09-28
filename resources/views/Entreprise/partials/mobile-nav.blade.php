{{-- resources/views/dashboard/partials/mobile-nav.blade.php --}}
<div class="mobile-nav">
    <a href="{{ route('entreprise.dashboard.index') }}" class="mobile-nav-item {{ request()->routeIs('entreprise.dashboard.index') ? 'active' : '' }}" data-view="dashboard">
        <svg class="mobile-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v4H8V5z"/>
        </svg>
        <span class="mobile-nav-label">Accueil</span>
    </a>

    <a href="{{ route('entreprise.vehicules.index') }}" class="mobile-nav-item {{ request()->routeIs('entreprise.vehicules.*') ? 'active' : '' }}" data-view="vehicules">
        <svg class="mobile-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
        <span class="mobile-nav-label">Véhicules</span>
    </a>

    <a href="{{ route('entreprise.maintenance.index') }}" class="mobile-nav-item {{ request()->routeIs('entreprise.maintenance.*') ? 'active' : '' }}" data-view="planning">
        <svg class="mobile-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span class="mobile-nav-label">Planning</span>
    </a>

    <a href="{{ route('entreprise.reports.index') }}" class="mobile-nav-item {{ request()->routeIs('entreprise.reports.*') ? 'active' : '' }}" data-view="reports">
        <svg class="mobile-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        <span class="mobile-nav-label">Rapports</span>
    </a>
</div>
