@if($showDetailsModal && $selectedItem)
<div class="fixed inset-0 z-50 overflow-y-auto animate-fade-in">

    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" wire:click="closeDetailsModal"></div>

    <!-- Modal -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-slate-800 rounded-2xl shadow-2xl w-full max-w-3xl border border-slate-700/50 animate-slide-up">

            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Détails de la facture</h3>
                        <p class="text-sm text-slate-400">{{ $selectedItem->ref }}</p>
                    </div>
                </div>
                <button wire:click="closeDetailsModal" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6 max-h-[calc(100vh-200px)] overflow-y-auto">

                <!-- Status Badge -->
                <div class="flex items-center justify-between">
                    <div>
                        @if($selectedItem->status_paiement === 'PAYE')
                        <span class="status-badge status-success text-base">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Payée
                        </span>
                        @elseif($selectedItem->status_paiement === 'PENDING')
                        <span class="status-badge status-warning text-base">En attente</span>
                        @elseif($selectedItem->status_paiement === 'OVERDUE')
                        <span class="status-badge status-urgent text-base">En retard</span>
                        @else
                        <span class="status-badge bg-slate-700/50 text-slate-400 text-base">Annulée</span>
                        @endif
                    </div>

                    <!-- Montant -->
                    <div class="text-right">
                        <p class="text-3xl font-bold text-white">{{ number_format($selectedItem->montant_ttc) }}</p>
                        <p class="text-sm text-slate-400">FCFA TTC</p>
                    </div>
                </div>

                <!-- Informations principales -->
                <div class="grid grid-cols-2 gap-4 p-4 bg-slate-700/30 rounded-xl">
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Date d'émission</p>
                        <p class="text-white font-medium">{{ \Carbon\Carbon::parse($selectedItem->date_emission)->format('d/m/Y') }}</p>
                    </div>
                    @if($selectedItem->date_echeance)
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Date d'échéance</p>
                        <p class="text-white font-medium">{{ \Carbon\Carbon::parse($selectedItem->date_echeance)->format('d/m/Y') }}</p>
                    </div>
                    @endif
                    @if($selectedItem->vehicule)
                    <div class="col-span-2">
                        <p class="text-sm text-slate-400 mb-1">Véhicule</p>
                        <p class="text-white font-medium">{{ $selectedItem->vehicule->libelle }} ({{ $selectedItem->vehicule->matricule }})</p>
                    </div>
                    @endif
                </div>

                <!-- Description -->
                @if($selectedItem->description)
                <div>
                    <h4 class="text-sm font-semibold text-slate-400 mb-2">Description</h4>
                    <p class="text-white">{{ $selectedItem->description }}</p>
                </div>
                @endif

                <!-- Détails du montant -->
                <div>
                    <h4 class="text-sm font-semibold text-slate-400 mb-3">Détail du montant</h4>
                    <div class="space-y-2 p-4 bg-slate-700/30 rounded-xl">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Montant HT</span>
                            <span class="text-white font-medium">{{ number_format($selectedItem->montant) }} FCFA</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">TVA</span>
                            <span class="text-white font-medium">{{ number_format($selectedItem->tva) }} FCFA</span>
                        </div>
                        <div class="border-t border-slate-600/50 pt-2 mt-2">
                            <div class="flex justify-between">
                                <span class="text-white font-semibold">Total TTC</span>
                                <span class="text-white font-bold text-lg">{{ number_format($selectedItem->montant_ttc) }} FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations de paiement si payé -->
                @if($selectedItem->status_paiement === 'PAYE')
                <div>
                    <h4 class="text-sm font-semibold text-slate-400 mb-3">Informations de paiement</h4>
                    <div class="p-4 bg-green-500/10 border border-green-500/20 rounded-xl space-y-2">
                        @if($selectedItem->moyen_paiement)
                        <div class="flex justify-between text-sm">
                            <span class="text-green-400">Moyen de paiement</span>
                            <span class="text-white font-medium">{{ $selectedItem->moyen_paiement }}</span>
                        </div>
                        @endif
                        @if($selectedItem->reference_paiement)
                        <div class="flex justify-between text-sm">
                            <span class="text-green-400">Référence</span>
                            <span class="text-white font-mono text-xs">{{ $selectedItem->reference_paiement }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Lié à -->
                @if($selectedItem->contrat)
                <div>
                    <h4 class="text-sm font-semibold text-slate-400 mb-2">Contrat associé</h4>
                    <div class="flex items-center gap-3 p-3 bg-slate-700/30 rounded-xl">
                        <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-medium">{{ $selectedItem->contrat->libelle }}</p>
                            <p class="text-sm text-slate-400">{{ $selectedItem->contrat->frequence_entretien }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 p-6 border-t border-slate-700/50">
                @if($selectedItem->status_paiement === 'PENDING' || $selectedItem->status_paiement === 'OVERDUE')
                <button wire:click="openPaiementModal({{ $selectedItem->id }}); closeDetailsModal()" class="btn btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Effectuer le paiement
                </button>
                @endif
                <button wire:click="downloadFacture({{ $selectedItem->id }})" class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Télécharger PDF
                </button>
                <button wire:click="closeDetailsModal" class="btn btn-secondary">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(1rem) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.2s ease-out;
    }

    .animate-slide-up {
        animation: slide-up 0.3s ease-out;
    }
</style>
@endif
