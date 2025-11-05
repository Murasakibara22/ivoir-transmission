<div class="space-y-4">
    @forelse($factures as $facture)
    <div class="card hover:shadow-xl transition-all">
        <div class="flex items-start gap-4">
            <!-- Icon -->
            <div class="flex-shrink-0">
                <div class="w-16 h-16
                    {{ $facture->status_paiement === 'PAID' ? 'bg-green-500/10 border-green-500/20' : '' }}
                    {{ $facture->status_paiement === 'PENDING' ? 'bg-orange-500/10 border-orange-500/20' : '' }}
                    {{ $facture->status_paiement === 'OVERDUE' ? 'bg-red-500/10 border-red-500/20' : '' }}
                    border-2 rounded-xl flex items-center justify-center">
                    @if($facture->status_paiement === 'PAID')
                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @elseif($facture->status_paiement === 'PENDING')
                    <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @else
                    <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-4 mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            @if($facture->status_paiement === 'PAID')
                            <span class="status-badge status-success">Payé</span>
                            @elseif($facture->status_paiement === 'PENDING')
                            <span class="status-badge status-warning">En attente</span>
                            @elseif($facture->status_paiement === 'OVERDUE')
                            <span class="status-badge status-urgent">En retard</span>
                            @else
                            <span class="status-badge bg-slate-700/50 text-slate-400">Annulé</span>
                            @endif
                            <span class="text-sm text-slate-500">
                                {{ \Carbon\Carbon::parse($facture->date_emission)->format('d M Y') }}
                            </span>
                        </div>

                        <h3 class="text-lg font-semibold text-white mb-1">{{ $facture->ref }}</h3>
                        <p class="text-slate-400 text-sm mb-2">
                            {{ $facture->libelle }}
                            @if($facture->vehicule)
                            - {{ $facture->vehicule->libelle }} ({{ $facture->vehicule->matricule }})
                            @endif
                        </p>

                        <div class="flex flex-wrap items-center gap-4 text-sm">
                            <span class="text-slate-500">
                                Montant: <span class="text-white font-semibold">{{ number_format($facture->montant_ttc) }} FCFA</span>
                            </span>
                            {{-- @if($facture->status_paiement === 'PAID' && $facture->moyen_paiement) --}}
                            <span class="text-slate-500">
                               @if($facture->moyen_paiement) Moyen: @endif <span class="text-green-400">{{ $facture->moyen_paiement }}</span>
                            </span>
                            {{-- @endif --}}
                            @if($facture->date_echeance)
                            <span class="text-slate-500">
                                Échéance:
                                <span class="{{ \Carbon\Carbon::parse($facture->date_echeance)->isPast() && $facture->status_paiement !== 'PAID' ? 'text-red-400' : 'text-slate-300' }}">
                                    {{ \Carbon\Carbon::parse($facture->date_echeance)->format('d M Y') }}
                                </span>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        @if($facture->status_paiement === 'PENDING' || $facture->status_paiement === 'OVERDUE')
                        <button wire:click="openPaiementModal({{ $facture->id }})" class="btn btn-primary btn-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Payer
                        </button>
                        @endif

                        <button wire:click="downloadFacture({{ $facture->id }})" class="btn btn-secondary btn-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </button>

                        <button wire:click="openDetailsFacture({{ $facture->id }})" class="btn btn-secondary btn-sm">
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
    @empty
    <!-- Empty State -->
    <div class="card text-center py-16">
        <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-white mb-2">Aucune facture trouvée</h3>
        <p class="text-slate-400">Aucune facture ne correspond à vos critères de recherche.</p>
    </div>
    @endforelse

    <!-- Pagination -->
    @if($factures->hasPages())
    <div class="flex justify-center mt-6">
        {{ $factures->links() }}
    </div>
    @endif
</div>

<style>
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
</style>
