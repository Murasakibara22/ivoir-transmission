<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-white">Mon Profil</h1>
            <p class="text-slate-400 mt-1">Gérez vos informations personnelles et paramètres</p>
        </div>
    </div>

    <!-- Profile Header Card -->
    <div class="card">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
            <!-- Logo -->
            <div class="relative group">
                <div class="w-32 h-32 rounded-2xl overflow-hidden bg-slate-700/50 border-2 border-slate-600/50">
                    @if($logo)
                        <img src="{{ $logo }}" alt="Logo" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Logo Actions -->
                <div class="absolute inset-0 bg-black/60 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                    <label for="logo-upload" class="cursor-pointer w-10 h-10 bg-blue-500 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <input type="file" id="logo-upload" wire:model="newLogo" accept="image/*" class="hidden">
                    </label>

                    @if($logo)
                        <button wire:click="removeLogo" class="w-10 h-10 bg-red-500 hover:bg-red-600 rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Company Info -->
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-white mb-1">{{ $name }}</h2>
                <p class="text-slate-400 mb-3">{{ $type }}</p>

                <div class="flex flex-wrap gap-4 text-sm">
                    <div class="flex items-center text-slate-300">
                        <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $phone }}
                    </div>

                    @if($email)
                        <div class="flex items-center text-slate-300">
                            <svg class="w-4 h-4 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $email }}
                        </div>
                    @endif

                    @if($city)
                        <div class="flex items-center text-slate-300">
                            <svg class="w-4 h-4 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $city }}, {{ $country }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upload Progress -->
        @if($newLogo)
            <div class="mt-4 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-blue-400 text-sm">Nouveau logo sélectionné</span>
                    <button wire:click="updateLogo" class="btn btn-primary btn-sm">
                        Enregistrer
                    </button>
                </div>
                <div wire:loading wire:target="newLogo" class="text-xs text-slate-400">
                    Chargement en cours...
                </div>
            </div>
        @endif
    </div>

    <!-- General Information -->
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-white flex items-center">
                <svg class="w-5 h-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Informations générales
            </h2>

            @if(!$editingGeneral)
                <button wire:click="toggleEditGeneral" class="btn btn-secondary btn-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </button>
            @endif
        </div>

        @if($editingGeneral)
            <!-- Edit Mode -->
            <form wire:submit.prevent="updateGeneral" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Nom de l'entreprise *</label>
                        <input type="text" wire:model="name" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Téléphone *</label>
                        <input type="text" wire:model="phone" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('phone') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                        <input type="email" wire:model="email" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Type d'entreprise *</label>
                        <select wire:model="type" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="FREE">Gratuit</option>
                            <option value="SARL">SARL</option>
                            <option value="SA">SA</option>
                            <option value="SAS">SAS</option>
                            <option value="SASU">SASU</option>
                            <option value="EI">Entreprise Individuelle</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Adresse</label>
                        <input type="text" wire:model="address_line" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Ville</label>
                        <input type="text" wire:model="city" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Pays</label>
                        <input type="text" wire:model="country" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Enregistrer
                    </button>
                    <button type="button" wire:click="toggleEditGeneral" class="btn btn-secondary">Annuler</button>
                </div>
            </form>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Nom de l'entreprise</p>
                        <p class="text-white font-medium">{{ $name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Téléphone</p>
                        <p class="text-white font-medium">{{ $phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Email</p>
                        <p class="text-white font-medium">{{ $email ?: 'Non renseigné' }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Type d'entreprise</p>
                        <p class="text-white font-medium">{{ $type }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Ville</p>
                        <p class="text-white font-medium">{{ $city ?: 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Pays</p>
                        <p class="text-white font-medium">{{ $country ?: 'Non renseigné' }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Security -->
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-white flex items-center">
                <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Sécurité
            </h2>

            @if(!$editingPassword)
                <button wire:click="toggleEditPassword" class="btn btn-secondary btn-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Changer le mot de passe
                </button>
            @endif
        </div>

        @if($editingPassword)
            <form wire:submit.prevent="updatePassword" class="space-y-6">
                <div class="max-w-2xl space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Mot de passe actuel *</label>
                        <input type="password" wire:model="current_password" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('current_password') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Nouveau mot de passe *</label>
                        <input type="password" wire:model="new_password" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('new_password') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Confirmer le nouveau mot de passe *</label>
                        <input type="password" wire:model="new_password_confirmation" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Mettre à jour
                    </button>
                    <button type="button" wire:click="toggleEditPassword" class="btn btn-secondary">Annuler</button>
                </div>
            </form>
        @else
            <div class="flex items-center p-4 bg-green-500/10 border border-green-500/20 rounded-xl">
                <svg class="w-10 h-10 text-green-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <div>
                    <p class="text-white font-medium">Votre compte est sécurisé</p>
                    <p class="text-slate-400 text-sm">Cliquez sur "Changer le mot de passe" pour le modifier</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Account Stats -->
    <div class="card">
        <h2 class="text-xl font-semibold text-white mb-6 flex items-center">
            <svg class="w-5 h-5 text-purple-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Statistiques du compte
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                <p class="text-sm text-blue-400 mb-1">Véhicules</p>
                <p class="text-2xl font-bold text-white">{{ auth('entreprise')->user()->vehicules()->count() }}</p>
            </div>

            <div class="p-4 bg-green-500/10 border border-green-500/20 rounded-xl">
                <p class="text-sm text-green-400 mb-1">Contrats</p>
                <p class="text-2xl font-bold text-white">{{ auth('entreprise')->user()->contrats()->count() }}</p>
            </div>

            <div class="p-4 bg-purple-500/10 border border-purple-500/20 rounded-xl">
                <p class="text-sm text-purple-400 mb-1">Entretiens</p>
                <p class="text-2xl font-bold text-white">{{ auth('entreprise')->user()->entretiens()->count() }}</p>
            </div>

            <div class="p-4 bg-orange-500/10 border border-orange-500/20 rounded-xl">
                <p class="text-sm text-orange-400 mb-1">Statut</p>
                <p class="text-lg font-bold text-white">{{ auth('entreprise')->user()->status }}</p>
            </div>
        </div>
    </div>
</div>
