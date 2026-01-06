@if($showPaiementModal && $selectedFacture)
<div class="fixed inset-0 z-50 overflow-y-auto animate-fade-in">

    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" wire:click="closePaiementModal"></div>

    <!-- Modal -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-slate-800 rounded-2xl shadow-2xl w-full max-w-2xl border border-slate-700/50 animate-slide-up">

            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Effectuer un paiement</h3>
                        <p class="text-sm text-slate-400">Facture {{ $selectedFacture->ref }}</p>
                    </div>
                </div>
                <button wire:click="closePaiementModal" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <form wire:submit.prevent="effectuerPaiement" class="p-6 space-y-6">

                <!-- Recap Facture -->
                <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm text-blue-400">Montant de la facture</span>
                        <span class="text-2xl font-bold text-white">{{ number_format($selectedFacture->montant_ttc) }} FCFA</span>
                    </div>
                    @if($selectedFacture->date_echeance)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-400">Date d'échéance</span>
                        <span class="text-white">{{ \Carbon\Carbon::parse($selectedFacture->date_echeance)->format('d/m/Y') }}</span>
                    </div>
                    @endif
                </div>

                <!-- Montant à payer -->
                {{-- <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Montant à payer <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            wire:model="montant_paiement"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Entrer le montant"
                            step="0.01"
                            min="0"
                        >
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400">
                            FCFA
                        </div>
                    </div>
                    @error('montant_paiement')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Moyen de paiement -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Moyen de paiement <span class="text-red-400">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="payment-method {{ $moyen_paiement === 'VIREMENT' ? 'active' : '' }}">
                            <input type="radio" wire:model.live="moyen_paiement" value="VIREMENT" class="hidden">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                                <span>Virement</span>
                            </div>
                        </label>

                        <label class="payment-method {{ $moyen_paiement === 'CHEQUE' ? 'active' : '' }}">
                            <input type="radio" wire:model.live="moyen_paiement" value="CHEQUE" class="hidden">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span>Chèque</span>
                            </div>
                        </label>

                        <label class="payment-method {{ $moyen_paiement === 'ESPECES' ? 'active' : '' }}">
                            <input type="radio" wire:model.live="moyen_paiement" value="ESPECES" class="hidden">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>Espèces</span>
                            </div>
                        </label>

                        <label class="payment-method {{ $moyen_paiement === 'CARTE' ? 'active' : '' }}">
                            <input type="radio" wire:model.live="moyen_paiement" value="CARTE" class="hidden">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                <span>Carte</span>
                            </div>
                        </label>

                        <label class="payment-method col-span-2 {{ $moyen_paiement === 'MOBILE_MONEY' ? 'active' : '' }}">
                            <input type="radio" wire:model.live="moyen_paiement" value="MOBILE_MONEY" class="hidden">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <span>Mobile Money</span>
                            </div>
                        </label>
                    </div>
                    @error('moyen_paiement')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                @if($moyen_paiement !== 'ESPECES')
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Numéro de débit <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            wire:model="contact_paiement"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Ex: 00 00 00 00 00 "
                            maxlength="10"
                        >
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400">
                            FCFA
                        </div>
                    </div>
                    @error('contact_paiement')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                @endif

                <!-- Référence de paiement (optionnel) -->
                {{-- <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Référence de paiement (optionnel)
                    </label>
                    <input
                        type="text"
                        wire:model="reference_paiement"
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Ex: Numéro de transaction"
                    >
                    @error('reference_paiement')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Note (optionnel) -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Note (optionnel)
                    </label>
                    <textarea
                        wire:model="note_paiement"
                        rows="3"
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"
                        placeholder="Ajoutez une note concernant ce paiement..."
                    ></textarea>
                    @error('note_paiement')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-700/50">
                    <button type="button" wire:click="closePaiementModal" class="btn btn-secondary">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Confirmer le paiement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .payment-method {
        padding: 1rem;
        border: 2px solid rgba(71, 85, 105, 0.3);
        border-radius: 0.75rem;
        background: rgba(30, 41, 59, 0.5);
        cursor: pointer;
        transition: all 0.2s;
        display: block;
    }

    .payment-method:hover {
        border-color: rgba(34, 197, 94, 0.3);
        background: rgba(34, 197, 94, 0.05);
    }

    .payment-method.active {
        border-color: rgb(34, 197, 94);
        background: rgba(34, 197, 94, 0.1);
    }

    .payment-method div {
        color: rgb(148, 163, 184);
        transition: color 0.2s;
    }

    .payment-method.active div {
        color: rgb(74, 222, 128);
    }

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
