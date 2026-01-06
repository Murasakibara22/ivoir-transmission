<!-- Modal Confirmation Contrat -->
@if($showConfirmModal && $contratToConfirm)
<div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.75);">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" wire:click="closeConfirmModal">
            <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
        </div>

        <!-- Modal Panel -->
        <div class="inline-block align-bottom bg-slate-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-700">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-600/20 to-green-500/20 px-6 py-4 border-b border-slate-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center border border-green-500/30">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Confirmation du contrat</h3>
                            <p class="text-sm text-slate-400 mt-1">Validez ou refusez ce contrat de maintenance</p>
                        </div>
                    </div>
                    <button wire:click="closeConfirmModal" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Body -->
            <div class="px-6 py-6">
                <!-- Récapitulatif du contrat -->
                <div class="bg-slate-700/30 rounded-xl p-6 mb-6 border border-slate-600/50">
                    <h4 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Récapitulatif du contrat
                    </h4>

                    <div class="space-y-3">
                        <div class="flex justify-between items-start py-2">
                            <span class="text-slate-400 text-sm">Libellé</span>
                            <span class="text-white font-semibold text-right max-w-xs">{{ $contratToConfirm->libelle }}</span>
                        </div>

                        @if($contratToConfirm->description)
                        <div class="flex justify-between items-start py-2 border-t border-slate-600/30">
                            <span class="text-slate-400 text-sm">Description</span>
                            <span class="text-slate-300 text-sm text-right max-w-xs">{{ $contratToConfirm->description }}</span>
                        </div>
                        @endif

                        <div class="grid grid-cols-2 gap-4 pt-3 border-t border-slate-600/30">
                            <div class="bg-slate-800/50 rounded-lg p-3">
                                <p class="text-slate-400 text-xs mb-1">Fréquence</p>
                                <p class="text-white font-semibold">{{ $contratToConfirm->frequence_entretien }}</p>
                            </div>
                            <div class="bg-slate-800/50 rounded-lg p-3">
                                <p class="text-slate-400 text-xs mb-1">Durée</p>
                                <p class="text-white font-semibold">{{ $contratToConfirm->duree_contrat_mois }} mois</p>
                            </div>
                            <div class="bg-slate-800/50 rounded-lg p-3">
                                <p class="text-slate-400 text-xs mb-1">Véhicules</p>
                                <p class="text-white font-semibold">{{ $contratToConfirm->nombre_vehicules }}</p>
                            </div>
                            <div class="bg-slate-800/50 rounded-lg p-3">
                                <p class="text-slate-400 text-xs mb-1">Montant/entretien</p>
                                <p class="text-green-400 font-bold">{{ number_format($contratToConfirm->montant_entretien) }} FCFA</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center py-3 border-t border-slate-600/30">
                            <span class="text-slate-400 text-sm">Période</span>
                            <span class="text-white font-semibold">
                                {{ \Carbon\Carbon::parse($contratToConfirm->date_debut)->format('d/m/Y') }}
                                <span class="text-slate-500 mx-2">→</span>
                                {{ \Carbon\Carbon::parse($contratToConfirm->date_fin)->format('d/m/Y') }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center py-3 border-t border-slate-600/30">
                            <span class="text-slate-400 text-sm">Premier entretien</span>
                            <span class="text-white font-semibold">{{ \Carbon\Carbon::parse($contratToConfirm->date_premier_entretien)->format('d/m/Y') }}</span>
                        </div>

                        <!-- Coût total estimé -->
                        <div class="bg-gradient-to-r from-green-500/10 to-green-600/10 border border-green-500/30 rounded-lg p-4 mt-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-green-400 text-sm font-semibold mb-1">Coût total estimé</p>
                                    <p class="text-xs text-slate-400">
                                        @php
                                            $nbEntretiens = 0;
                                            switch($contratToConfirm->frequence_entretien) {
                                                case 'MENSUEL':
                                                    $nbEntretiens = $contratToConfirm->duree_contrat_mois;
                                                    break;
                                                case 'TRIMESTRIEL':
                                                    $nbEntretiens = ceil($contratToConfirm->duree_contrat_mois / 3);
                                                    break;
                                                case 'SEMESTRIEL':
                                                    $nbEntretiens = ceil($contratToConfirm->duree_contrat_mois / 6);
                                                    break;
                                                case 'ANNUEL':
                                                    $nbEntretiens = ceil($contratToConfirm->duree_contrat_mois / 12);
                                                    break;
                                            }
                                        @endphp
                                        {{ $nbEntretiens }} entretiens × {{ number_format($contratToConfirm->montant_entretien) }} FCFA
                                    </p>
                                </div>
                                <p class="text-3xl font-bold text-green-400">{{ number_format($nbEntretiens * $contratToConfirm->montant_entretien) }} <span class="text-base text-slate-400">FCFA</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alert d'information -->
                <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-blue-400 mb-1">Information importante</h4>
                            <p class="text-slate-300 text-sm">
                                En confirmant ce contrat, vous acceptez les termes et conditions. Les entretiens seront planifiés automatiquement selon la fréquence définie.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Note / Commentaire -->
                <div class="mb-6">
                    <label class="block text-white font-semibold mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Note ou commentaire
                        <span class="text-slate-400 font-normal text-sm">(Optionnel)</span>
                    </label>
                    <textarea wire:model="confirmation_note"
                              rows="3"
                              placeholder="Ajoutez un commentaire (optionnel pour confirmation, obligatoire pour refus)..."
                              class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                    @error('confirmation_note')
                        <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-slate-700/30 px-6 py-4 border-t border-slate-700 flex flex-wrap gap-3 justify-end">
                <button wire:click="closeConfirmModal" class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Annuler
                </button>

                <button wire:click="refuserContrat"
                        wire:loading.attr="disabled"
                        class="px-6 py-3 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-xl font-semibold transition-all duration-200 border border-red-500/30 hover:border-red-500/50 flex items-center gap-2">
                    <span wire:loading.remove wire:target="refuserContrat">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    <span wire:loading wire:target="refuserContrat">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                    <span wire:loading.remove wire:target="refuserContrat">Refuser</span>
                    <span wire:loading wire:target="refuserContrat">Refus...</span>
                </button>

                <button wire:click="confirmerContrat"
                        wire:loading.attr="disabled"
                        class="btn btn-primary">
                    <span wire:loading.remove wire:target="confirmerContrat" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Confirmer le contrat
                    </span>
                    <span wire:loading wire:target="confirmerContrat" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Confirmation...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif
