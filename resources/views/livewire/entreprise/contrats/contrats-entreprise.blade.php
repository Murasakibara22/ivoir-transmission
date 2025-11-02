<div >

        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-white">
                    Mes Contrats de Maintenance
                </h1>
                <p class="text-slate-400 mt-1">
                    Gérez vos contrats et planifiez vos entretiens
                </p>
            </div>
        </div>

        <!-- Alert si contrats en attente -->
        @if($stats['en_attente'] > 0)
        <div class="bg-orange-500/10 border border-orange-500/20 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-orange-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1-1.964-1-2.732 0L3.732 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-400 mb-1">Action requise !</h3>
                    <p class="text-slate-300 text-sm">Vous avez {{ $stats['en_attente'] }} contrat(s) en attente de validation.</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Stats Summary -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="stat-card bg-blue-500/10 border-blue-500/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-label text-blue-400">Total Contrats</p>
                        <p class="stat-value text-blue-400">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-green-500/10 border-green-500/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-label text-green-400">Contrats Actifs</p>
                        <p class="stat-value text-green-400">{{ $stats['actifs'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-orange-500/10 border-orange-500/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-label text-orange-400">En Attente</p>
                        <p class="stat-value text-orange-400">{{ $stats['en_attente'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-orange-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-red-500/10 border-red-500/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-label text-red-400">Expirés</p>
                        <p class="stat-value text-red-400">{{ $stats['expires'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mt-6 mb-3">
            <div class="flex flex-col lg:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Rechercher un contrat..."
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <select wire:model.live="statusFilter"
                        class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="DRAFT">Brouillon</option>
                    <option value="PENDING">En attente validation</option>
                    <option value="ACTIVE">Actif</option>
                    <option value="EXPIRED">Expiré</option>
                    <option value="CANCELLED">Annulé</option>
                </select>
                <button wire:click="$set('search', ''); $set('statusFilter', '')"
                        class="btn btn-secondary">
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

        <!-- Contrats List -->
        <div wire:loading.remove class="space-y-4">
            @forelse($contrats as $contrat)
            <div class="card hover:shadow-xl transition-all duration-300">
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Icon & Main Info -->
                    <div class="flex-1">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500/20 to-blue-600/20 rounded-xl flex items-center justify-center flex-shrink-0 border border-blue-500/30">
                                <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h3 class="text-xl font-bold text-white mb-2">{{ $contrat->libelle }}</h3>
                                @if($contrat->description)
                                    <p class="text-slate-400 text-sm mb-3 line-clamp-2">{{ $contrat->description }}</p>
                                @endif

                                <!-- Badges -->
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="status-badge bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $contrat->frequence_entretien }}
                                    </span>
                                    <span class="status-badge bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                        </svg>
                                        {{ $contrat->nombre_vehicules }} véhicules
                                    </span>
                                    <span class="status-badge bg-slate-500/10 text-slate-400 border border-slate-500/20">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $contrat->duree_contrat_mois }} mois
                                    </span>
                                </div>

                                <!-- Date Range -->
                                <div class="flex items-center gap-2 text-sm text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Du {{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status & Actions -->
                    <div class="lg:border-l lg:border-slate-700/50 lg:pl-6 flex flex-col justify-between items-end gap-4">
                        <!-- Status Badge -->
                        <div>
                            @if($contrat->status === 'ACTIVE')
                                <span class="status-badge status-success">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Actif
                                </span>
                            @elseif($contrat->status === 'PENDING')
                                <span class="status-badge status-warning">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    En attente validation
                                </span>
                            @elseif($contrat->status === 'DRAFT')
                                <span class="status-badge bg-slate-500/10 text-slate-400 border border-slate-500/20">Brouillon</span>
                            @elseif($contrat->status === 'EXPIRED')
                                <span class="status-badge status-urgent">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Expiré
                                </span>
                            @else
                                <span class="status-badge bg-slate-700/50 text-slate-400 border border-slate-600/50">Annulé</span>
                            @endif
                        </div>

                        <!-- Price -->
                        <div class="text-right">
                            <p class="text-3xl font-bold text-white mb-1">{{ number_format($contrat->montant_entretien) }}</p>
                            <p class="text-sm text-slate-400">FCFA / entretien</p>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            @if($contrat->status === 'PENDING')
                                <button wire:click="openConfirmModal({{ $contrat->id }})"
                                        class="btn btn-primary btn-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Confirmer
                                </button>
                            @endif
                            <button wire:click="openDetailsModal({{ $contrat->id }})"
                                    class="btn btn-secondary btn-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Détails
                            </button>
                            <button wire:click="downloadContrat({{ $contrat->id }})"
                                    class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors text-slate-400 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="card text-center py-16">
                <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Aucun contrat trouvé</h3>
                <p class="text-slate-400">Vous n'avez pas encore de contrat de maintenance.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($contrats->hasPages())
        <div class="flex justify-center">
            {{ $contrats->links() }}
        </div>
        @endif



    <!-- Modals -->
    @include('livewire.entreprise.contrats.modals.details-contrat')
    @include('livewire.entreprise.contrats.modals.confirm-contrat')
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
        font-size: 2rem;
        font-weight: 700;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
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

    .card {
        background: rgba(30, 41, 59, 0.5);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(71, 85, 105, 0.3);
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        border-color: rgba(71, 85, 105, 0.5);
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
