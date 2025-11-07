@if($showModal)
<div class="fixed inset-0 z-[9999] overflow-y-auto animate-fade-in"  style="background-color: rgba(0, 0, 0, 0.85);">
    <div class="fixed inset-0"></div>

    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-slate-800 rounded-2xl shadow-2xl w-full max-w-md border border-slate-700/50 animate-slide-up">

            <!-- Header -->
            <div class="p-6 border-b border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-red-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Changement de mot de passe requis</h3>
                        <p class="text-sm text-slate-400 mt-1">Pour des raisons de sécurité</p>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <form wire:submit.prevent="changePassword" class="p-6 space-y-5">

                <!-- Ancien mot de passe -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Ancien mot de passe <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="password"
                        wire:model="ancien_mdp"
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Entrez votre ancien mot de passe"
                    >
                    @error('ancien_mdp')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nouveau mot de passe -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Nouveau mot de passe <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="password"
                        wire:model.live="nouveau_mdp"
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Entrez votre nouveau mot de passe"
                    >
                    @error('nouveau_mdp')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Critères de sécurité -->
                <div class="p-4 bg-slate-700/30 rounded-xl space-y-2">
                    <p class="text-sm font-medium text-slate-300 mb-3">Le mot de passe doit contenir :</p>

                    <div class="flex items-center gap-2 text-sm {{ $hasMinLength ? 'text-green-400' : 'text-slate-400' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($hasMinLength)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @endif
                        </svg>
                        <span>Au moins 10 caractères</span>
                    </div>

                    <div class="flex items-center gap-2 text-sm {{ $hasUppercase ? 'text-green-400' : 'text-slate-400' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($hasUppercase)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @endif
                        </svg>
                        <span>Au moins une lettre majuscule (A-Z)</span>
                    </div>

                    <div class="flex items-center gap-2 text-sm {{ $hasLowercase ? 'text-green-400' : 'text-slate-400' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($hasLowercase)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @endif
                        </svg>
                        <span>Au moins une lettre minuscule (a-z)</span>
                    </div>

                    <div class="flex items-center gap-2 text-sm {{ $hasNumber ? 'text-green-400' : 'text-slate-400' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($hasNumber)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @endif
                        </svg>
                        <span>Au moins un chiffre (0-9)</span>
                    </div>

                    <div class="flex items-center gap-2 text-sm {{ $hasSpecialChar ? 'text-green-400' : 'text-slate-400' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($hasSpecialChar)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @endif
                        </svg>
                        <span>Au moins un caractère spécial (!@#$%...)</span>
                    </div>
                </div>

                <!-- Confirmation -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Confirmer le mot de passe <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="password"
                        wire:model="confirmation_mdp"
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Confirmez votre nouveau mot de passe"
                    >
                    @error('confirmation_mdp')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full py-3 px-4 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-800 disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Changer le mot de passe</span>
                    <span wire:loading>
                        <svg class="inline w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Enregistrement...
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>
@endif

@push('styles')

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

@endpush

