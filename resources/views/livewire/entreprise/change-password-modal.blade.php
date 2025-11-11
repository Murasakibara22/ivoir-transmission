<div>
    @if($showModal)
        <!-- Modal Backdrop -->
        <div class="fixed inset-0 z-50 overflow-y-auto" style="background: rgba(0, 0, 0, 0.75); backdrop-filter: blur(4px);">
            <div class="flex min-h-screen items-center justify-center p-4">

                <!-- Modal Content -->
                <div class="relative w-full max-w-2xl bg-slate-800 rounded-2xl shadow-2xl border border-slate-700 transform transition-all"
                     wire:click.stop>

                    <!-- Header -->
                    <div class="p-6 border-b border-slate-700 {{ $isFirstLogin ? 'bg-gradient-to-r from-orange-500 to-red-500' : 'bg-gradient-to-r from-blue-500 to-purple-500' }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">
                                        @if($isFirstLogin)
                                            🔐 Changement obligatoire du mot de passe
                                        @else
                                            Modifier mon mot de passe
                                        @endif
                                    </h3>
                                    <p class="text-sm text-white/80 mt-1">
                                        @if($isFirstLogin)
                                            Pour votre sécurité, veuillez définir un nouveau mot de passe
                                        @else
                                            Assurez-vous d'utiliser un mot de passe fort et unique
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if(!$isFirstLogin)
                                <button wire:click="closeModal"
                                        class="text-white/80 hover:text-white transition-colors p-2 hover:bg-white/10 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6">
                        @if($isFirstLogin)
                            <div class="mb-6 p-4 bg-orange-500/10 border border-orange-500/20 rounded-xl">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-orange-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    <p class="text-orange-300 text-sm">
                                        <strong>Première connexion détectée !</strong><br>
                                        Par mesure de sécurité, vous devez créer un nouveau mot de passe personnel avant de continuer.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if($errorMessage)
                            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-red-400 text-sm">{{ $errorMessage }}</span>
                                </div>
                            </div>
                        @endif

                        <form wire:submit.prevent="changePassword" class="space-y-6">
                            <!-- Ancien mot de passe -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Ancien mot de passe <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <input
                                        type="{{ $showAncienPassword ? 'text' : 'password' }}"
                                        wire:model="ancien_mdp"
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('ancien_mdp') border-red-500 @enderror"
                                        placeholder="Votre mot de passe actuel"
                                        {{ $isLoading ? 'disabled' : '' }}
                                    >
                                    <button
                                        type="button"
                                        wire:click="toggleAncienPassword"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-colors"
                                    >
                                        @if($showAncienPassword)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        @endif
                                    </button>
                                </div>
                                @error('ancien_mdp')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nouveau mot de passe -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Nouveau mot de passe <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <input
                                        type="{{ $showNouveauPassword ? 'text' : 'password' }}"
                                        wire:model.live="nouveau_mdp"
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('nouveau_mdp') border-red-500 @enderror"
                                        placeholder="Votre nouveau mot de passe"
                                        {{ $isLoading ? 'disabled' : '' }}
                                    >
                                    <button
                                        type="button"
                                        wire:click="toggleNouveauPassword"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-colors"
                                    >
                                        @if($showNouveauPassword)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        @endif
                                    </button>
                                </div>
                                @error('nouveau_mdp')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Critères de sécurité -->
                            <div class="p-4 bg-slate-700/50 rounded-xl border border-slate-600">
                                <h4 class="text-sm font-semibold text-white mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    Critères de sécurité
                                </h4>
                                <div class="space-y-2">
                                    <!-- Longueur minimale -->
                                    <div class="flex items-center text-sm transition-all duration-300 {{ $hasMinLength ? 'text-green-400' : 'text-gray-400' }}">
                                        <div class="w-5 h-5 rounded-full border-2 mr-3 flex items-center justify-center transition-all duration-300 {{ $hasMinLength ? 'border-green-400 bg-green-400' : 'border-gray-500' }}">
                                            @if($hasMinLength)
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <span>Au moins 10 caractères</span>
                                    </div>

                                    <!-- Majuscule -->
                                    <div class="flex items-center text-sm transition-all duration-300 {{ $hasUppercase ? 'text-green-400' : 'text-gray-400' }}">
                                        <div class="w-5 h-5 rounded-full border-2 mr-3 flex items-center justify-center transition-all duration-300 {{ $hasUppercase ? 'border-green-400 bg-green-400' : 'border-gray-500' }}">
                                            @if($hasUppercase)
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <span>Au moins une lettre majuscule (A-Z)</span>
                                    </div>

                                    <!-- Minuscule -->
                                    <div class="flex items-center text-sm transition-all duration-300 {{ $hasLowercase ? 'text-green-400' : 'text-gray-400' }}">
                                        <div class="w-5 h-5 rounded-full border-2 mr-3 flex items-center justify-center transition-all duration-300 {{ $hasLowercase ? 'border-green-400 bg-green-400' : 'border-gray-500' }}">
                                            @if($hasLowercase)
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <span>Au moins une lettre minuscule (a-z)</span>
                                    </div>

                                    <!-- Chiffre -->
                                    <div class="flex items-center text-sm transition-all duration-300 {{ $hasNumber ? 'text-green-400' : 'text-gray-400' }}">
                                        <div class="w-5 h-5 rounded-full border-2 mr-3 flex items-center justify-center transition-all duration-300 {{ $hasNumber ? 'border-green-400 bg-green-400' : 'border-gray-500' }}">
                                            @if($hasNumber)
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <span>Au moins un chiffre (0-9)</span>
                                    </div>

                                    <!-- Caractère spécial -->
                                    <div class="flex items-center text-sm transition-all duration-300 {{ $hasSpecialChar ? 'text-green-400' : 'text-gray-400' }}">
                                        <div class="w-5 h-5 rounded-full border-2 mr-3 flex items-center justify-center transition-all duration-300 {{ $hasSpecialChar ? 'border-green-400 bg-green-400' : 'border-gray-500' }}">
                                            @if($hasSpecialChar)
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <span>Au moins un caractère spécial (!@#$%^&*)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirmation mot de passe -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Confirmer le nouveau mot de passe <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <input
                                        type="{{ $showConfirmationPassword ? 'text' : 'password' }}"
                                        wire:model.live="confirmation_mdp"
                                        class="w-full px-4 py-3 bg-slate-700 border rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 transition-all @error('confirmation_mdp') border-red-500 @else {{ $passwordsMatch && $confirmation_mdp ? 'border-green-500 focus:ring-green-500' : 'border-slate-600 focus:ring-blue-500' }} @enderror"
                                        placeholder="Confirmez votre nouveau mot de passe"
                                        {{ $isLoading ? 'disabled' : '' }}
                                    >
                                    <button
                                        type="button"
                                        wire:click="toggleConfirmationPassword"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-colors"
                                    >
                                        @if($showConfirmationPassword)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        @endif
                                    </button>
                                </div>
                                @if($passwordsMatch && $confirmation_mdp)
                                    <p class="text-green-400 text-xs mt-1 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Les mots de passe correspondent
                                    </p>
                                @endif
                                @error('confirmation_mdp')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3 pt-4">
                                @if(!$isFirstLogin)
                                    <button
                                        type="button"
                                        wire:click="closeModal"
                                        class="flex-1 px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-xl transition-colors"
                                        {{ $isLoading ? 'disabled' : '' }}
                                    >
                                        Annuler
                                    </button>
                                @endif

                                <button
                                    type="submit"
                                    class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-medium rounded-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                                    {{ $isLoading || !$hasMinLength || !$hasUppercase || !$hasLowercase || !$hasNumber || !$hasSpecialChar || !$passwordsMatch ? 'disabled' : '' }}
                                >
                                    @if($isLoading)
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Modification...
                                    @else
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Valider le changement
                                    @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
// Écouter l'événement de changement de mot de passe
document.addEventListener('livewire:init', () => {
    Livewire.on('password-changed', () => {
        // Afficher une notification de succès
        console.log('Mot de passe changé avec succès !');

        // Recharger la page après 1 seconde
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    });
});
</script>
@endpush
