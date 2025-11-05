<div>
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-white">
                Rapports & Paiements
            </h1>
            <p class="text-slate-400 mt-1">
                Suivez vos dépenses et gérez vos paiements
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <button wire:click="exportRapport" class="btn btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Exporter PDF
            </button>
        </div>
    </div>

    <!-- Stats Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="stat-card bg-blue-500/10 border-blue-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-blue-400">Total {{ $activeTab === 'factures' ? 'factures' : 'paiements' }}</p>
                    <p class="stat-value text-blue-400">{{ number_format($stats['total']) }}</p>
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
                    <p class="stat-value text-green-400">{{ number_format($stats['paye']) }}</p>
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
                    <p class="stat-value text-orange-400">{{ number_format($stats['attente']) }}</p>
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
                    <p class="stat-value text-purple-400">{{ number_format($stats['ce_mois']) }}</p>
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

    {{-- Graphs --}}

    @include('livewire.entreprise.reports.partials.charts', [
        'depensesChartData' => $this->depensesChartData,
        'repartitionChartData' => $this->repartitionChartData,
        'repartitionData' => $this->repartitionData
    ])

    <!-- Tabs -->
    <div class="card mb-6">
        <div class="flex border-b border-slate-700/50">
            <button
                wire:click="switchTab('factures')"
                class="tab-button {{ $activeTab === 'factures' ? 'active' : '' }}">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Factures
            </button>
            <button
                wire:click="switchTab('paiements')"
                class="tab-button {{ $activeTab === 'paiements' ? 'active' : '' }}">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Paiements
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-6">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1 flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Rechercher..."
                        class="w-full px-4 py-3 pl-12 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                @if($activeTab === 'factures')
                <select wire:model.live="statusFilter" class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="PENDING">En attente</option>
                    <option value="PAID">Payé</option>
                    <option value="OVERDUE">En retard</option>
                    <option value="CANCELLED">Annulé</option>
                </select>
                @else
                <select wire:model.live="statusFilter" class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="INITIATED">Initié</option>
                    <option value="PENDING">En attente</option>
                    <option value="PAID">Payé</option>
                    <option value="FAILED">Échoué</option>
                </select>
                @endif

                <select wire:model.live="periodFilter" class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Toutes les périodes</option>
                    <option value="mois">Ce mois</option>
                    <option value="trimestre">Ce trimestre</option>
                    <option value="annee">Cette année</option>
                </select>
            </div>

            <button wire:click="$set('search', ''); $set('statusFilter', ''); $set('periodFilter', '')" class="btn btn-secondary whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Réinitialiser
            </button>
        </div>
    </div>

    <!-- Loading State -->
    <div wire:loading.delay class="flex justify-center py-12">
        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-blue-500 border-r-transparent"></div>
    </div>

    <!-- Content -->
    <div wire:loading.remove>
        @if($activeTab === 'factures')
            @include('livewire.entreprise.reports.partials.factures-list')
        @else
            @include('livewire.entreprise.reports.partials.paiements-list')
        @endif
    </div>

    <!-- Modals -->
    @if($activeTab === 'factures')
        @include('livewire.entreprise.reports.modals.details-facture')
        @include('livewire.entreprise.reports.modals.paiement-facture')
    @else
        @include('livewire.entreprise.reports.modals.details-paiement')
    @endif
</div>

@push('styles')
<style>
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
        font-size: 1.875rem;
        font-weight: 700;
    }

    .tab-button {
        flex: 1;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgb(148, 163, 184);
        font-weight: 500;
        transition: all 0.2s;
        border-bottom: 2px solid transparent;
    }

    .tab-button:hover {
        color: rgb(203, 213, 225);
        background: rgba(51, 65, 85, 0.3);
    }

    .tab-button.active {
        color: rgb(59, 130, 246);
        border-bottom-color: rgb(59, 130, 246);
        background: rgba(59, 130, 246, 0.05);
    }

    .card {
        background: rgba(30, 41, 59, 0.5);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(71, 85, 105, 0.3);
        border-radius: 1rem;
        padding: 1.5rem;
    }
</style>
@endpush
