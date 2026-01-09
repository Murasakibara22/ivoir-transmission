{{-- resources/views/partials/header.blade.php --}}

<header class="pwa-header">
    <div class="header-content">
        {{-- Logo --}}
        <div class="header-logo">
            <img src="{{ asset('images/logo.png') }}" alt="GaragePro">
        </div>

        {{-- Actions droite --}}
        <div class="header-actions">
            <div class="header-user-info">
                <span class="header-user-name">Jean Dupont</span>
            </div>

            {{-- Notification Bell --}}
            <button class="notification-btn" aria-label="Notifications">
                <svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="notification-badge">3</span>
            </button>

            {{-- User Avatar --}}
            <div class="user-avatar-placeholder">
                JD
            </div>
        </div>
    </div>
</header>
