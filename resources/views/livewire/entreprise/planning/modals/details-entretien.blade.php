{{-- resources/views/livewire/entreprise/planning/modals/details-entretien.blade.php --}}
@if($showDetailsModal && $selectedEntretien)
<div class="fixed inset-0 z-50 overflow-y-auto animate-fade-in">
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" wire:click="closeDetailsModal"></div>

    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-slate-800 rounded-2xl shadow-2xl w-full max-w-4xl border border-slate-700/50 animate-slide-up">
            <div class="flex items-center justify-between p-6 border-b border-slate-700/50">
                <div>
                    <h3 class="text-xl font-bold text-white">Détails de l'entretien #{{ $selectedEntretien->numero_entretien }}</h3>
                    <p class="text-sm text-slate-400 mt-1">{{ $selectedEntretien->contrat->libelle }}</p>
                </div>
                <button wire:click="closeDetailsModal" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-6 max-h-[calc(100vh-200px)] overflow-y-auto">
                <!-- Info générale -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="p-4 bg-slate-700/30 rounded-xl">
                        <p class="text-sm text-slate-400 mb-1">Date prévue</p>
                        <p class="text-white font-semibold">{{ \Carbon\Carbon::parse($selectedEntretien->date_prevue)->format('d/m/Y') }}</p>
                    </div>
                    <div class="p-4 bg-slate-700/30 rounded-xl">
                        <p class="text-sm text-slate-400 mb-1">Coût prévu</p>
                        <p class="text-white font-semibold">{{ number_format($selectedEntretien->cout_prevu) }} FCFA</p>
                    </div>
                    <div class="p-4 bg-slate-700/30 rounded-xl">
                        <p class="text-sm text-slate-400 mb-1">Statut</p>
                        <span class="status-badge {{ $this->getStatusBadge($selectedEntretien->status) }}">
                            {{ $this->getStatusLabel($selectedEntretien->status) }}
                        </span>
                    </div>
                </div>

                <!-- Liste des véhicules -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Véhicules concernés ({{ $selectedEntretien->historique_entretiens->count() }})</h4>
                    <div class="space-y-3">
                        @foreach($selectedEntretien->historique_entretiens as $historique)
                        <div class="p-4 bg-slate-700/30 rounded-xl">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">{{ $historique->vehicule->libelle }}</p>
                                        <p class="text-sm text-slate-400">{{ $historique->vehicule->matricule }}</p>
                                    </div>
                                </div>
                                <span class="status-badge {{ $this->getStatusBadge($historique->status) }}">
                                    {{ $this->getStatusLabel($historique->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 p-6 border-t border-slate-700/50">
                <button wire:click="closeDetailsModal" class="btn btn-secondary">Fermer</button>
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
        from { opacity: 0; transform: translateY(1rem) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-fade-in { animation: fade-in 0.2s ease-out; }
    .animate-slide-up { animation: slide-up 0.3s ease-out; }
</style>
@endif
