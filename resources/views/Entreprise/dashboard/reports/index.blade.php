{{-- resources/views/dashboard/rapports/index.blade.php --}}
@extends('Entreprise.layouts.dashboard')

@section('title', 'Rapports & Paiements')
@section('breadcrumb', 'Rapports')

@section('content')
<div class="space-y-6" data-dashboard-view="rapports">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-white">
                Rapports & Paiements
            </h1>
            <p class="text-slate-400 mt-1">
                Suivez vos dépenses et gérez vos paiements
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <button class="btn btn-secondary" onclick="exportRapport()">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Exporter PDF
            </button>
            <button class="btn btn-primary" onclick="openPaiementModal()">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Nouveau paiement
            </button>
        </div>
    </div>

    <!-- Stats Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card bg-blue-500/10 border-blue-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-blue-400">Total dépenses</p>
                    <p class="stat-value text-blue-400">2,450,000</p>
                    <p class="text-xs text-slate-500 mt-1">FCFA</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-green-500/10 border-green-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-green-400">Payé</p>
                    <p class="stat-value text-green-400">1,850,000</p>
                    <p class="text-xs text-slate-500 mt-1">FCFA</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-orange-500/10 border-orange-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-orange-400">En attente</p>
                    <p class="stat-value text-orange-400">600,000</p>
                    <p class="text-xs text-slate-500 mt-1">FCFA</p>
                </div>
                <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-purple-500/10 border-purple-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-purple-400">Ce mois</p>
                    <p class="stat-value text-purple-400">385,000</p>
                    <p class="text-xs text-slate-500 mt-1">FCFA</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Évolution des dépenses -->
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-white">Évolution des dépenses</h3>
                <select class="px-3 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>6 derniers mois</option>
                    <option>12 derniers mois</option>
                    <option>Cette année</option>
                </select>
            </div>

            <!-- Placeholder pour graphique -->
            <div class="chart-container h-64 bg-slate-700/30 rounded-xl flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-16 h-16 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <p class="text-slate-500 text-sm">Graphique des dépenses mensuelles</p>
                </div>
            </div>
        </div>

        <!-- Répartition par type -->
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-white">Répartition par type</h3>
                <button class="text-sm text-blue-400 hover:text-blue-300">Voir détails</button>
            </div>

            <!-- Placeholder pour graphique pie -->
            <div class="chart-container h-64 bg-slate-700/30 rounded-xl flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-16 h-16 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                    <p class="text-slate-500 text-sm">Répartition des dépenses par type</p>
                </div>
            </div>

            <!-- Legend -->
            <div class="grid grid-cols-2 gap-3 mt-4">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                    <span class="text-sm text-slate-400">Vidange moteur (45%)</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="text-sm text-slate-400">Révision (30%)</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                    <span class="text-sm text-slate-400">Vidange boîte (15%)</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                    <span class="text-sm text-slate-400">Autres (10%)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1 flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input
                        type="text"
                        placeholder="Rechercher une facture..."
                        class="w-full px-4 py-3 pl-12 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <select class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="paye">Payé</option>
                    <option value="attente">En attente</option>
                    <option value="retard">En retard</option>
                </select>

                <select class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Toutes les périodes</option>
                    <option value="mois">Ce mois</option>
                    <option value="trimestre">Ce trimestre</option>
                    <option value="annee">Cette année</option>
                </select>
            </div>

            <div class="flex bg-slate-700/50 rounded-xl p-1">
                <button class="view-toggle active px-4 py-2 rounded-lg transition-colors" data-view="factures">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </button>
                <button class="view-toggle px-4 py-2 rounded-lg transition-colors" data-view="vehicules">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Factures List View -->
    <div id="factures-view" class="space-y-4">

        <!-- Facture Card 1 - Payée -->
        <div class="card hover:shadow-xl transition-all">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-green-500/10 border-2 border-green-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="status-badge status-success">Payé</span>
                                <span class="text-sm text-slate-500">05 Oct 2025</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-1">Facture #FAC-2025-001</h3>
                            <p class="text-slate-400 text-sm mb-2">Vidange moteur - Mercedes Sprinter (AB-123-CD)</p>

                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                <span class="text-slate-500">Montant: <span class="text-white font-semibold">40,000 FCFA</span></span>
                                <span class="text-slate-500">Payé le: <span class="text-green-400">05 Oct 2025</span></span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="downloadFacture(1)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="viewFacture(1)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facture Card 2 - En attente -->
        <div class="card hover:shadow-xl transition-all">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-orange-500/10 border-2 border-orange-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="status-badge status-warning">En attente</span>
                                <span class="text-sm text-slate-500">12 Oct 2025</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-1">Facture #FAC-2025-002</h3>
                            <p class="text-slate-400 text-sm mb-2">Révision complète - BMW X3 (MN-456-OP)</p>

                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                <span class="text-slate-500">Montant: <span class="text-white font-semibold">50,000 FCFA</span></span>
                                <span class="text-slate-500">Échéance: <span class="text-orange-400">15 Oct 2025</span></span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-primary btn-sm" onclick="payerFacture(2)">
                                Payer
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="downloadFacture(2)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="viewFacture(2)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facture Card 3 - En retard -->
        <div class="card hover:shadow-xl transition-all border-l-4 border-red-500">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-red-500/10 border-2 border-red-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="status-badge status-urgent">En retard</span>
                                <span class="text-sm text-slate-500">25 Sep 2025</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-1">Facture #FAC-2025-000</h3>
                            <p class="text-slate-400 text-sm mb-2">Vidange boîte - Audi A4 (QR-789-ST)</p>

                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                <span class="text-slate-500">Montant: <span class="text-white font-semibold">25,000 FCFA</span></span>
                                <span class="text-slate-500">Échéance dépassée: <span class="text-red-400">30 Sep 2025</span></span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-primary btn-sm" onclick="payerFacture(3)">
                                Payer maintenant
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="downloadFacture(3)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="viewFacture(3)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dupliquer les cards ci-dessus pour ajouter plus de factures -->

    </div>

    <!-- Vehicules Cost View (Hidden by default) -->
    <div id="vehicules-view" class="hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

            <!-- Véhicule Cost Card 1 -->
            <div class="card">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 bg-slate-700/50 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white mb-1">Mercedes Sprinter</h3>
                        <p class="text-slate-400 text-sm mb-3">AB-123-CD</p>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Total dépensé</span>
                                <span class="text-white font-semibold">385,000 FCFA</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Nombre d'interventions</span>
                                <span class="text-white font-semibold">8</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Coût moyen</span>
                                <span class="text-white font-semibold">48,125 FCFA</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="btn btn-primary flex-1" onclick="createMassPlanning()">
                                Planifier tous les RDV
                            </button>
                            <button onclick="this.closest('.fixed').remove()" class="btn btn-secondary">
                                Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Véhicule Cost Card 2 -->
            <div class="card">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 bg-slate-700/50 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white mb-1">Mercedes Sprinter</h3>
                        <p class="text-slate-400 text-sm mb-3">AB-123-CD</p>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Total dépensé</span>
                                <span class="text-white font-semibold">385,000 FCFA</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Nombre d'interventions</span>
                                <span class="text-white font-semibold">8</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Coût moyen</span>
                                <span class="text-white font-semibold">48,125 FCFA</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="btn btn-primary flex-1" onclick="createMassPlanning()">
                                Planifier tous les RDV
                            </button>
                            <button onclick="this.closest('.fixed').remove()" class="btn btn-secondary">
                                Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush

@push('css')

<style>
    .card {
        @apply p-4 bg-slate-700/50 border border-slate-600/50 rounded-xl;
    }

    .card + .card {
        @apply mt-4;
    }

    .stat-card {
        @apply p-4 bg-slate-700/50 border border-slate-600/50 rounded-xl;
    }

    .stat-card + .stat-card {
        @apply mt-4;
    }

    .stats-grid {
        @apply grid grid-cols-1 md:grid-cols-2 gap-4;
    }
</style>

@endpush
