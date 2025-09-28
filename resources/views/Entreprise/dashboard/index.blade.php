{{-- resources/views/dashboard/index.blade.php --}}
@extends('Entreprise.layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6" data-dashboard-view="dashboard">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-white">
                Bonjour, {{ auth()->guard('entreprise')->user()->name ?? 'Utilisateur' }}
            </h1>
            <p class="text-slate-400 mt-1">
                Voici un aperçu de votre flotte automobile
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <button class="btn btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Rapport
            </button>
            <button class="btn btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nouveau véhicule
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <!-- Total Véhicules -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Total véhicules</p>
                    <p class="stat-value">24</p>
                    <p class="stat-change positive">+2 ce mois</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Alertes Urgentes -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Alertes urgentes</p>
                    <p class="stat-value text-red-400">3</p>
                    <p class="stat-change negative">Maintenance requise</p>
                </div>
                <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- RDV cette semaine -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">RDV cette semaine</p>
                    <p class="stat-value text-green-400">7</p>
                    <p class="stat-change positive">+3 vs semaine passée</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Coût maintenance -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Coût ce mois</p>
                    <p class="stat-value">245,000 F</p>
                    <p class="stat-change positive">-12% vs mois passé</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertes Urgentes Section -->
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-white flex items-center">
                <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                Alertes urgentes
            </h2>
            <a href="{{ route('entreprise.vehicules.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                Voir tout
            </a>
        </div>

        <div class="space-y-4">
            <!-- Alerte 1 -->
            <div class="flex items-center p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-white font-medium">Mercedes Sprinter - AB-123-CD</h3>
                    <p class="text-red-400 text-sm">Vidange moteur urgente - Dépassé de 2,000 km</p>
                    <p class="text-slate-400 text-xs mt-1">Dernière vidange: 15 Jan 2025</p>
                </div>
                <button class="btn btn-primary btn-sm">
                    Réserver
                </button>
            </div>

            <!-- Alerte 2 -->
            <div class="flex items-center p-4 bg-orange-500/10 border border-orange-500/20 rounded-xl">
                <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-white font-medium">Renault Master - EF-456-GH</h3>
                    <p class="text-orange-400 text-sm">Vidange de boîte dans 5 jours</p>
                    <p class="text-slate-400 text-xs mt-1">Prévue pour: 3 Fév 2025</p>
                </div>
                <button class="btn btn-secondary btn-sm">
                    Planifier
                </button>
            </div>

            <!-- Alerte 3 -->
            <div class="flex items-center p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl">
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-white font-medium">Peugeot Expert - IJ-789-KL</h3>
                    <p class="text-yellow-400 text-sm">Diagnostic électrique recommandé</p>
                    <p class="text-slate-400 text-xs mt-1">Problème détecté: 20 Jan 2025</p>
                </div>
                <button class="btn btn-secondary btn-sm">
                    Diagnostiquer
                </button>
            </div>
        </div>
    </div>

    <!-- Planning Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Prochains RDV -->
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Prochains rendez-vous
                </h2>
                <a href="{{ route('entreprise.maintenance.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                    Planning complet
                </a>
            </div>

            <div class="space-y-3">
                <!-- RDV Aujourd'hui -->
                <div class="flex items-center p-3 bg-blue-500/10 border border-blue-500/20 rounded-lg">
                    <div class="w-2 h-2 bg-blue-400 rounded-full mr-3"></div>
                    <div class="flex-1">
                        <p class="text-white text-sm font-medium">Aujourd'hui 09h00</p>
                        <p class="text-slate-400 text-xs">Vidange - Mercedes Sprinter</p>
                    </div>
                    <span class="status-badge status-info">Confirmé</span>
                </div>

                <!-- RDV Demain -->
                <div class="flex items-center p-3 bg-slate-700/30 rounded-lg">
                    <div class="w-2 h-2 bg-slate-400 rounded-full mr-3"></div>
                    <div class="flex-1">
                        <p class="text-white text-sm font-medium">Demain 14h30</p>
                        <p class="text-slate-400 text-xs">Diagnostic - Peugeot Expert</p>
                    </div>
                    <span class="status-badge status-warning">En attente</span>
                </div>

                <!-- RDV Cette semaine -->
                <div class="flex items-center p-3 bg-slate-700/30 rounded-lg">
                    <div class="w-2 h-2 bg-slate-400 rounded-full mr-3"></div>
                    <div class="flex-1">
                        <p class="text-white text-sm font-medium">Vendredi 10h15</p>
                        <p class="text-slate-400 text-xs">Révision complète - Renault Master</p>
                    </div>
                    <span class="status-badge status-success">Planifié</span>
                </div>
            </div>
        </div>

        <!-- Véhicules récents -->
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                    Véhicules récents
                </h2>
                <a href="{{ route('entreprise.vehicules.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                    Voir tous
                </a>
            </div>

            <div class="space-y-4">
                <!-- Véhicule 1 -->
                <div class="flex items-center p-4 bg-slate-700/30 rounded-xl hover:bg-slate-700/50 transition-colors cursor-pointer">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-white font-medium">BMW X3 - MN-456-OP</h3>
                        <p class="text-slate-400 text-sm">Ajouté le 25 Jan 2025</p>
                        <div class="flex items-center mt-1">
                            <span class="status-badge status-success">À jour</span>
                            <span class="text-slate-400 text-xs ml-2">45,000 km</span>
                        </div>
                    </div>
                </div>

                <!-- Véhicule 2 -->
                <div class="flex items-center p-4 bg-slate-700/30 rounded-xl hover:bg-slate-700/50 transition-colors cursor-pointer">
                    <div class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-white font-medium">Audi A4 - QR-789-ST</h3>
                        <p class="text-slate-400 text-sm">Ajouté le 20 Jan 2025</p>
                        <div class="flex items-center mt-1">
                            <span class="status-badge status-warning">Bientôt</span>
                            <span class="text-slate-400 text-xs ml-2">38,500 km</span>
                        </div>
                    </div>
                </div>

                <!-- Véhicule 3 -->
                <div class="flex items-center p-4 bg-slate-700/30 rounded-xl hover:bg-slate-700/50 transition-colors cursor-pointer">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-white font-medium">Ford Transit - UV-012-WX</h3>
                        <p class="text-slate-400 text-sm">Ajouté le 18 Jan 2025</p>
                        <div class="flex items-center mt-1">
                            <span class="status-badge status-urgent">Urgent</span>
                            <span class="text-slate-400 text-xs ml-2">52,300 km</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <h2 class="text-xl font-semibold text-white mb-6">Actions rapides</h2>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Ajouter véhicule -->
            <button class="flex flex-col items-center p-6 bg-blue-500/10 border border-blue-500/20 rounded-xl hover:bg-blue-500/20 transition-colors group">
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <span class="text-white font-medium text-sm">Ajouter véhicule</span>
            </button>

            <!-- Réserver maintenance -->
            <button class="flex flex-col items-center p-6 bg-green-500/10 border border-green-500/20 rounded-xl hover:bg-green-500/20 transition-colors group">
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-white font-medium text-sm">Réserver maintenance</span>
            </button>

            <!-- Voir rapports -->
            <button class="flex flex-col items-center p-6 bg-purple-500/10 border border-purple-500/20 rounded-xl hover:bg-purple-500/20 transition-colors group">
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <span class="text-white font-medium text-sm">Voir rapports</span>
            </button>

            <!-- Gérer équipe -->
            <button class="flex flex-col items-center p-6 bg-orange-500/10 border border-orange-500/20 rounded-xl hover:bg-orange-500/20 transition-colors group">
                <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
                <span class="text-white font-medium text-sm">Gérer équipe</span>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Animations d'entrée pour les cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stat-card, .card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush
