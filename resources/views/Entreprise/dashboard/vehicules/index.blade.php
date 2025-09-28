
@extends('Entreprise.layouts.dashboard')


@section('title', 'Véhicules')
@section('breadcrumb', 'Véhicules')

@section('content')
<div class="space-y-6" data-dashboard-view="vehicles">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-white">
                Gestion des véhicules
            </h1>
            <p class="text-slate-400 mt-1">
                {{ $totalVehicles ?? 24 }} véhicules dans votre flotte
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <button class="btn btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Exporter
            </button>
            <button class="btn btn-primary" onclick="openAddVehicleModal()">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nouveau véhicule
            </button>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="card">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Rechercher par immatriculation, marque, modèle..."
                        class="w-full px-4 py-3 pl-12 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        data-search="vehicles"
                    >
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Filters -->
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Status Filter -->
                <select class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="urgent">Urgent</option>
                    <option value="warning">À surveiller</option>
                    <option value="good">À jour</option>
                </select>

                <!-- Brand Filter -->
                <select class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Toutes les marques</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="bmw">BMW</option>
                    <option value="audi">Audi</option>
                    <option value="renault">Renault</option>
                    <option value="peugeot">Peugeot</option>
                </select>

                <!-- View Toggle -->
                <div class="flex bg-slate-700/50 rounded-xl p-1">
                    <button class="view-toggle active px-3 py-2 rounded-lg transition-colors" data-view="grid">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button class="view-toggle px-3 py-2 rounded-lg transition-colors" data-view="list">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card bg-red-500/10 border-red-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-red-400">Maintenance urgente</p>
                    <p class="stat-value text-red-400">3</p>
                </div>
                <div class="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-orange-500/10 border-orange-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-orange-400">À surveiller</p>
                    <p class="stat-value text-orange-400">7</p>
                </div>
                <div class="w-10 h-10 bg-orange-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-green-500/10 border-green-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-green-400">À jour</p>
                    <p class="stat-value text-green-400">14</p>
                </div>
                <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-blue-500/10 border-blue-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-blue-400">Total flotte</p>
                    <p class="stat-value text-blue-400">24</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicles Container -->
    <div id="vehicles-container">
        <!-- Grid View -->
        <div id="grid-view" class="vehicles-grid">

            <!-- Vehicle Card 1 - Urgent (Mercedes Sprinter) -->
            <div class="card-vehicle" data-vehicle-id="1">
                <div class="relative overflow-hidden rounded-xl mb-4">
                    <div class="absolute top-3 left-3 z-10">
                        <span class="status-badge status-urgent">Urgent</span>
                    </div>
                    <div class="absolute top-3 right-3 z-10">
                        <div class="w-8 h-8 bg-blue-600/90 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                    </div>
                    <div class="vehicle-360 relative h-48 overflow-hidden rounded-xl">
                        <img
                            src="https://images.unsplash.com/photo-1558618644-fcd25c85cd64?w=400&h=300&fit=crop&crop=center"
                            alt="Mercedes Sprinter"
                            class="w-full h-full object-cover"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center" style="display: none;">
                            <svg class="w-24 h-24 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </div>
                        <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 w-4 h-1 bg-blue-400 rounded-full animate-pulse"></div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-white font-semibold text-lg">Mercedes Sprinter</h3>
                        <p class="text-slate-400 text-sm">AB-123-CD</p>
                        <p class="text-xs text-slate-500 mt-1">2019 • 52,000 km</p>
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Diesel</p>
                        </div>
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Auto</p>
                        </div>
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <p class="text-xs text-slate-400">Cargo</p>
                        </div>
                    </div>

                    <div class="p-3 bg-red-500/10 border border-red-500/20 rounded-lg">
                        <p class="text-red-400 text-sm font-medium">Vidange moteur dépassée</p>
                        <p class="text-slate-400 text-xs mt-1">Retard: 2,000 km</p>
                    </div>

                    <div class="grid grid-cols-1 gap-2">
                        <button class="btn btn-primary btn-sm w-full">
                            Réserver maintenance
                        </button>
                        <div class="grid grid-cols-2 gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="showVehicleHistory(1)">
                                Voir historique
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="openVehicleDetails(1)">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Détails
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle Card 2 - Warning (BMW X3) -->
            <div class="card-vehicle" data-vehicle-id="2">
                <div class="relative overflow-hidden rounded-xl mb-4">
                    <div class="absolute top-3 left-3 z-10">
                        <span class="status-badge status-warning">Bientôt</span>
                    </div>
                    <div class="absolute top-3 right-3 z-10">
                        <div class="w-8 h-8 bg-blue-600/90 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                    </div>
                    <div class="vehicle-360 relative h-48 overflow-hidden rounded-xl">
                        <img
                            src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=400&h=300&fit=crop&crop=center"
                            alt="BMW X3"
                            class="w-full h-full object-cover"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center" style="display: none;">
                            <svg class="w-24 h-24 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </div>
                        <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 w-4 h-1 bg-blue-400 rounded-full animate-pulse"></div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-white font-semibold text-lg">BMW X3</h3>
                        <p class="text-slate-400 text-sm">MN-456-OP</p>
                        <p class="text-xs text-slate-500 mt-1">2020 • 45,000 km</p>
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Essence</p>
                        </div>
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Auto</p>
                        </div>
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Clim</p>
                        </div>
                    </div>

                    <div class="p-3 bg-orange-500/10 border border-orange-500/20 rounded-lg">
                        <p class="text-orange-400 text-sm font-medium">Vidange de boîte dans 5 jours</p>
                        <p class="text-slate-400 text-xs mt-1">Prévue: 3 Fév 2025</p>
                    </div>

                    <div class="grid grid-cols-1 gap-2">
                        <button class="btn btn-secondary btn-sm w-full">
                            Planifier maintenance
                        </button>
                        <div class="grid grid-cols-2 gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="showVehicleHistory(2)">
                                Voir historique
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="openVehicleDetails(2)">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Détails
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle Card 3 - Success (Audi A4) -->
            <div class="card-vehicle" data-vehicle-id="3">
                <div class="relative overflow-hidden rounded-xl mb-4">
                    <div class="absolute top-3 left-3 z-10">
                        <span class="status-badge status-success">À jour</span>
                    </div>
                    <div class="absolute top-3 right-3 z-10">
                        <div class="w-8 h-8 bg-blue-600/90 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                    </div>
                    <div class="vehicle-360 relative h-48 overflow-hidden rounded-xl">
                        <img
                            src="https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=400&h=300&fit=crop&crop=center"
                            alt="Audi A4"
                            class="w-full h-full object-cover"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center" style="display: none;">
                            <svg class="w-24 h-24 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </div>
                        <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 w-4 h-1 bg-blue-400 rounded-full animate-pulse"></div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-white font-semibold text-lg">Audi A4</h3>
                        <p class="text-slate-400 text-sm">QR-789-ST</p>
                        <p class="text-xs text-slate-500 mt-1">2021 • 38,500 km</p>
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Hybride</p>
                        </div>
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Auto</p>
                        </div>
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                            </svg>
                            <p class="text-xs text-slate-400">Audio</p>
                        </div>
                    </div>

                    <div class="p-3 bg-green-500/10 border border-green-500/20 rounded-lg">
                        <p class="text-green-400 text-sm font-medium">Maintenance à jour</p>
                        <p class="text-slate-400 text-xs mt-1">Prochaine: 15 Avr 2025</p>
                    </div>

                    <div class="grid grid-cols-1 gap-2">
                        <button class="btn btn-secondary btn-sm w-full">
                            Maintenance préventive
                        </button>
                        <div class="grid grid-cols-2 gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="showVehicleHistory(3)">
                                Voir historique
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="openVehicleDetails(3)">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Détails
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DUPLIQUEZ LES CARDS CI-DESSUS POUR AJOUTER PLUS DE VÉHICULES -->
            <!-- Changez juste: data-vehicle-id, images, noms, immatriculations, statuts -->

        </div>

        <!-- List View (Hidden by default) -->
        <div id="list-view" class="space-y-4 hidden">
            <!-- List Item 1 -->
            <div class="card">
                <div class="flex items-center p-6 space-x-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-700 to-slate-800 rounded-xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </div>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-white font-semibold text-lg">Mercedes Sprinter</h3>
                                <p class="text-slate-400">AB-123-CD • 2019 • 52,000 km</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span class="text-xs text-slate-500">Diesel • Auto • Cargo</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="status-badge status-urgent">Urgent</span>
                                <div class="text-right">
                                    <p class="text-red-400 text-sm font-medium">Vidange dépassée</p>
                                    <p class="text-slate-400 text-xs">Retard: 2,000 km</p>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="btn btn-primary btn-sm">Réserver</button>
                                    <button class="btn btn-secondary btn-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Item 2 -->
            <div class="card">
                <div class="flex items-center p-6 space-x-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-700 to-slate-800 rounded-xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </div>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-white font-semibold text-lg">BMW X3</h3>
                                <p class="text-slate-400">MN-456-OP • 2020 • 45,000 km</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span class="text-xs text-slate-500">Essence • Auto • Clim</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="status-badge status-warning">Bientôt</span>
                                <div class="text-right">
                                    <p class="text-orange-400 text-sm font-medium">Dans 5 jours</p>
                                    <p class="text-slate-400 text-xs">Prévue: 3 Fév</p>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="btn btn-secondary btn-sm">Planifier</button>
                                    <button class="btn btn-secondary btn-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Item 3 -->
            <div class="card">
                <div class="flex items-center p-6 space-x-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-700 to-slate-800 rounded-xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </div>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-white font-semibold text-lg">Audi A4</h3>
                                <p class="text-slate-400">QR-789-ST • 2021 • 38,500 km</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span class="text-xs text-slate-500">Hybride • Auto • Audio</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="status-badge status-success">À jour</span>
                                <div class="text-right">
                                    <p class="text-green-400 text-sm font-medium">Maintenance à jour</p>
                                    <p class="text-slate-400 text-xs">Prochaine: 15 Avr</p>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="btn btn-secondary btn-sm">Voir détails</button>
                                    <button class="btn btn-secondary btn-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DUPLIQUEZ LES LIST ITEMS CI-DESSUS POUR AJOUTER PLUS DE VÉHICULES -->

        </div>
    </div>

    <!-- Pagination -->
    <div class="card">
        <div class="flex items-center justify-between p-6">
            <div class="flex items-center space-x-2">
                <p class="text-slate-400 text-sm">Affichage de</p>
                <select class="px-2 py-1 bg-slate-700/50 border border-slate-600/50 rounded text-white text-sm">
                    <option>12</option>
                    <option>24</option>
                    <option>48</option>
                </select>
                <p class="text-slate-400 text-sm">véhicules sur 24</p>
            </div>

            <div class="flex items-center space-x-2">
                <button class="p-2 text-slate-400 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors" disabled>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <div class="flex items-center space-x-1">
                    <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm">1</button>
                    <button class="px-3 py-2 text-slate-400 hover:text-white hover:bg-slate-700/50 rounded-lg text-sm transition-colors">2</button>
                    <button class="px-3 py-2 text-slate-400 hover:text-white hover:bg-slate-700/50 rounded-lg text-sm transition-colors">3</button>
                </div>

                <button class="p-2 text-slate-400 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection


@push('styles')

<style>
    .vehicles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .view-toggle.active {
        background-color: rgba(59, 130, 246, 0.8);
        color: white;
    }

    .view-toggle:not(.active) {
        color: rgb(148, 163, 184);
    }

    .view-toggle:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .card-vehicle {
        transition: all 0.3s ease;
        min-height: 500px;
        display: flex;
        flex-direction: column;
    }

    .card-vehicle:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    .vehicle-360 {
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .vehicle-360:hover {
        background: linear-gradient(135deg,
            rgba(59, 130, 246, 0.1) 0%,
            rgba(59, 130, 246, 0.05) 100%);
    }

    .vehicle-360 img {
        transition: transform 0.3s ease;
    }

    .vehicle-360:hover img {
        transform: scale(1.05);
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-urgent {
        background-color: rgba(239, 68, 68, 0.1);
        color: rgb(248, 113, 113);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .status-warning {
        background-color: rgba(245, 158, 11, 0.1);
        color: rgb(251, 191, 36);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-success {
        background-color: rgba(34, 197, 94, 0.1);
        color: rgb(74, 222, 128);
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .stat-card {
        padding: 1.5rem;
        border-radius: 1rem;
        border: 1px solid;
        background-color: rgba(30, 41, 59, 0.5);
    }

    .stat-label {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .vehicles-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .card-vehicle {
            min-height: auto;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 640px) {
        .dashboard-main {
            padding: 1rem;
            padding-bottom: 6rem;
        }

        .card {
            padding: 1rem;
        }

        .card-vehicle {
            padding: 1rem;
        }
    }

    @media (max-width: 768px) {
        .fixed.inset-0 {
            z-index: 60; /* Plus élevé que la nav mobile */
        }

        body.modal-open {
            overflow: hidden; /* Empêche le scroll quand modal ouverte */
        }
    }
</style>

@endpush

@push('scripts')
<script>
    // View Toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const viewToggles = document.querySelectorAll('.view-toggle');
        const gridView = document.getElementById('grid-view');
        const listView = document.getElementById('list-view');

        viewToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const view = this.dataset.view;

                // Update active states
                viewToggles.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Toggle views
                if (view === 'grid') {
                    gridView.classList.remove('hidden');
                    listView.classList.add('hidden');
                } else {
                    gridView.classList.add('hidden');
                    listView.classList.remove('hidden');
                }
            });
        });

        // Vehicle card interactions
        const vehicleCards = document.querySelectorAll('.card-vehicle');
        vehicleCards.forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('.btn')) {
                    const vehicleId = this.dataset.vehicleId;
                    openVehicleDetails(vehicleId);
                }
            });
        });

        // Search functionality
        const searchInput = document.querySelector('[data-search="vehicles"]');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    performVehicleSearch(this.value);
                }, 300);
            });
        }

        // Filter functionality
        const filterSelects = document.querySelectorAll('select');
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                applyFilters();
            });
        });
    });

    // Functions
    function openVehicleDetails(vehicleId) {
        console.log('Opening vehicle details for:', vehicleId);
        showVehicleModal(vehicleId);
    }

    function showVehicleHistory(vehicleId) {
        console.log('Showing vehicle history for:', vehicleId);
        showHistoryModal(vehicleId);
    }

    function showVehicleModal(vehicleId) {
        // Create modal backdrop
        const backdrop = document.createElement('div');
backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm';
        backdrop.innerHTML = `
            <div class="bg-slate-800 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white">Détails du véhicule</h2>
                        <button onclick="this.closest('.fixed').remove()" class="text-slate-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-6">
                        <!-- Vehicle Image -->
                        <div class="relative h-48 rounded-xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1558618644-fcd25c85cd64?w=600&h=300&fit=crop"
                                 alt="Vehicle" class="w-full h-full object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="px-2 py-1 bg-black/50 text-white text-sm rounded-lg">Vue 360°</span>
                            </div>
                        </div>

                        <!-- Vehicle Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-white font-semibold mb-3">Informations générales</h3>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Immatriculation</span>
                                        <span class="text-white">AB-123-CD</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Kilométrage</span>
                                        <span class="text-white">52,000 km</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Année</span>
                                        <span class="text-white">2019</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-white font-semibold mb-3">Maintenance</h3>
                                <div class="space-y-2">
                                    <div class="p-3 bg-red-500/10 border border-red-500/20 rounded-lg">
                                        <p class="text-red-400 text-sm font-medium">Vidange urgente</p>
                                        <p class="text-slate-400 text-xs">Retard: 2,000 km</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3">
                            <button class="btn btn-primary flex-1">Réserver maintenance</button>
                            <button onclick="showVehicleHistory(${vehicleId}); this.closest('.fixed').remove();"
                                    class="btn btn-secondary">Voir historique</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(backdrop);
    }

    function showHistoryModal(vehicleId) {
        const backdrop = document.createElement('div');
        backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm';
        backdrop.innerHTML = `
            <div class="bg-slate-800 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white">Historique de maintenance</h2>
                        <button onclick="this.closest('.fixed').remove()" class="text-slate-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <!-- Timeline -->
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-3 h-3 bg-green-500 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-white font-medium">Vidange moteur</h4>
                                        <span class="text-slate-400 text-sm">15 Jan 2025</span>
                                    </div>
                                    <p class="text-slate-400 text-sm">43,000 km • Ivoire Transmission</p>
                                    <p class="text-green-400 text-xs mt-1">Terminé</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-3 h-3 bg-green-500 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-white font-medium">Révision complète</h4>
                                        <span class="text-slate-400 text-sm">12 Déc 2024</span>
                                    </div>
                                    <p class="text-slate-400 text-sm">40,000 km • Ivoire Transmission</p>
                                    <p class="text-green-400 text-xs mt-1">Terminé</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(backdrop);
    }

    function openAddVehicleModal() {
        console.log('Opening add vehicle modal');
        // TODO: Implement add vehicle modal
    }

    function performVehicleSearch(query) {
        console.log('Searching vehicles:', query);
        // TODO: Implement search functionality
    }

    function applyFilters() {
        console.log('Applying filters');
        // TODO: Implement filter functionality
    }

    // Vehicle card hover effects
    document.querySelectorAll('.card-vehicle').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // 360° view simulation
    document.querySelectorAll('.vehicle-360').forEach(container => {
        container.addEventListener('click', function() {
            const icon = this.querySelector('svg');
            if (icon) {
                icon.style.transform = 'rotateY(360deg)';
                icon.style.transition = 'transform 1s ease-in-out';

                setTimeout(() => {
                    icon.style.transform = 'rotateY(0deg)';
                }, 1000);
            }
        });
    });
</script>

@endpush
