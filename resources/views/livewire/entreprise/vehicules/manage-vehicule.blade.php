<div>
    <!-- Modal Add Vehicle - Livewire Version -->
    @if($showModal)
    <div class="fixed inset-0  flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm " style="z-index: 9999; background-color: rgba(0,0,0,0.5);">
        <div class="bg-slate-800 rounded-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">


            <div class="sticky top-0 bg-slate-800 border-b border-slate-700 p-6 z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white">
                            {{ $editMode ? 'Modifier le véhicule' : 'Nouveau véhicule' }}
                        </h2>
                        <p class="text-slate-400 text-sm mt-1">
                            {{ $editMode ? 'Modifiez les informations du véhicule' : 'Ajoutez un véhicule à votre flotte' }}
                        </p>
                    </div>
                    <button wire:click="closeModal" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-6 space-y-6">



                   <!-- ⭐ LOADING OVERLAY - INTÉGRER ICI ⭐ -->
            <div wire:loading wire:target="save,nextStep,prevStep,images"
                class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm z-50 flex items-center justify-center rounded-2xl">
                <div class="text-center">
                    <!-- Spinner animé -->
                    <div class="relative inline-flex">
                        <div class="w-16 h-16 border-4 border-slate-600 border-t-blue-500 rounded-full animate-spin"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Texte dynamique -->
                    <div class="mt-4 space-y-1">
                        <p class="text-white font-medium text-lg" wire:loading wire:target="save">
                            Enregistrement en cours...
                        </p>
                        <p class="text-white font-medium text-lg" wire:loading wire:target="nextStep,prevStep">
                            Chargement...
                        </p>
                        <p class="text-white font-medium text-lg" wire:loading wire:target="images">
                            Téléchargement des images...
                        </p>
                        <p class="text-slate-400 text-sm">Veuillez patienter</p>
                    </div>

                    <!-- Barre de progression -->
                    <div class="mt-4 w-48 h-1 bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 animate-progress"></div>
                    </div>
                </div>
            </div>
            <!-- FIN LOADING -->




                <!-- Progress Steps -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center flex-1">
                        <div class="step-item {{ $currentStep >= 1 ? 'active' : '' }} flex items-center">
                            <div class="step-circle w-8 h-8 rounded-full {{ $currentStep > 1 ? 'bg-green-500' : ($currentStep == 1 ? 'bg-blue-500' : 'bg-slate-700') }} text-white flex items-center justify-center font-semibold">
                                @if($currentStep > 1) ✓ @else 1 @endif
                            </div>
                            <span class="ml-2 text-sm font-medium {{ $currentStep >= 1 ? 'text-white' : 'text-slate-400' }}">Informations</span>
                        </div>
                        <div class="flex-1 h-1 {{ $currentStep > 1 ? 'bg-green-500' : 'bg-slate-700' }} mx-2"></div>
                        <div class="step-item {{ $currentStep >= 2 ? 'active' : '' }} flex items-center">
                            <div class="step-circle w-8 h-8 rounded-full {{ $currentStep > 2 ? 'bg-green-500' : ($currentStep == 2 ? 'bg-blue-500' : 'bg-slate-700') }} {{ $currentStep >= 2 ? 'text-white' : 'text-slate-400' }} flex items-center justify-center font-semibold">
                                @if($currentStep > 2) ✓ @else 2 @endif
                            </div>
                            <span class="ml-2 text-sm font-medium {{ $currentStep >= 2 ? 'text-white' : 'text-slate-400' }}">Caractéristiques</span>
                        </div>
                        <div class="flex-1 h-1 {{ $currentStep > 2 ? 'bg-green-500' : 'bg-slate-700' }} mx-2"></div>
                        <div class="step-item {{ $currentStep == 3 ? 'active' : '' }} flex items-center">
                            <div class="step-circle w-8 h-8 rounded-full {{ $currentStep == 3 ? 'bg-blue-500 text-white' : 'bg-slate-700 text-slate-400' }} flex items-center justify-center font-semibold">3</div>
                            <span class="ml-2 text-sm font-medium {{ $currentStep == 3 ? 'text-white' : 'text-slate-400' }}">Entretien</span>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Informations générales -->
                @if($currentStep === 1)
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                Libellé du véhicule <span class="text-red-400">*</span>
                            </label>
                            <input type="text" wire:model="libelle"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('libelle') border-red-500 @enderror"
                                placeholder="Ex: Mercedes Sprinter Utilitaire">
                            @error('libelle') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                Immatriculation <span class="text-red-400">*</span>
                            </label>
                            <input type="text" wire:model="matricule"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('matricule') border-red-500 @enderror"
                                placeholder="AB-123-CD">
                            @error('matricule') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                Numéro de chassis <span class="text-red-400">*</span>
                            </label>
                            <input type="text" wire:model="chassis"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('chassis') border-red-500 @enderror"
                                placeholder="VF1AB000123456789">
                            @error('chassis') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                Marque <span class="text-red-400">*</span>
                            </label>
                            <select wire:model="marque"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('marque') border-red-500 @enderror">
                                <option value="">Sélectionner une marque</option>
                                <option value="Mercedes">Mercedes</option>
                                <option value="BMW">BMW</option>
                                <option value="Audi">Audi</option>
                                <option value="Renault">Renault</option>
                                <option value="Peugeot">Peugeot</option>
                                <option value="Ford">Ford</option>
                                <option value="Toyota">Toyota</option>
                            </select>
                            @error('marque') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Modèle</label>
                            <input type="text" wire:model="modele"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Ex: Sprinter 314 CDI">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Année</label>
                            <input type="number" wire:model="year" min="1990" max="2025"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="2019">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" wire:click="nextStep" class="btn btn-primary">
                            Suivant
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endif

                <!-- Step 2: Caractéristiques -->
                @if($currentStep === 2)
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Type de véhicule</label>
                            <select wire:model="type"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionner un type</option>
                                <option value="Utilitaire">Utilitaire</option>
                                <option value="Berline">Berline</option>
                                <option value="SUV">SUV</option>
                                <option value="Camion">Camion</option>
                                <option value="Minibus">Minibus</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Carburant</label>
                            <select wire:model="carburant"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionner un carburant</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Essence">Essence</option>
                                <option value="Hybride">Hybride</option>
                                <option value="Électrique">Électrique</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Couleur</label>
                            <input type="text" wire:model="couleur"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Blanc">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Kilométrage actuel</label>
                            <input type="number" wire:model="kilometrage_actuel" min="0"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="50000">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Date de mise en circulation</label>
                            <input type="date" wire:model="date_mise_circulation"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Description / Notes</label>
                            <textarea wire:model="description" rows="3"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Ajoutez des notes ou informations complémentaires..."></textarea>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" wire:click="prevStep" class="btn btn-secondary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Précédent
                        </button>
                        <button type="button" wire:click="nextStep" class="btn btn-primary">
                            Suivant
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endif

                <!-- Step 3: Entretien -->
                @if($currentStep === 3)
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Date de prochaine visite</label>
                            <input type="date" wire:model="date_prochaine_visite"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Coût de vidange estimé (FCFA)</label>
                            <input type="number" wire:model="cout_vidange_estime" min="0"
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="50000">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Photos du véhicule</label>

                            <!-- Images existantes -->
                            @if($editMode && !empty($existingImages))
                            <div class="mb-4">
                                <p class="text-sm text-slate-400 mb-2">Images actuelles</p>
                                <div class="grid grid-cols-4 gap-3">
                                    @foreach($existingImages as $index => $image)
                                    <div class="relative group">
                                        <img src="{{ $image }}" class="w-full h-20 object-cover rounded-lg">
                                        <button type="button" wire:click="removeExistingImage({{ $index }})"
                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Upload nouvelles images -->
                            <div class="border-2 border-dashed border-slate-600 rounded-xl p-6 text-center hover:border-blue-500 transition-colors">
                                <input type="file" wire:model="images" multiple accept="image/*" class="hidden" id="vehicleImages">
                                <label for="vehicleImages" class="cursor-pointer">
                                    <svg class="w-12 h-12 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-slate-400 mb-1">Cliquez pour ajouter {{ $editMode ? 'de nouvelles' : 'des' }} photos</p>
                                    <p class="text-slate-500 text-sm">PNG, JPG jusqu'à 5MB</p>
                                </label>
                            </div>
                            @error('images.*') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror

                            @if(!empty($images))
                            <div class="grid grid-cols-4 gap-3 mt-4">
                                @foreach($images as $index => $image)
                                <div class="relative group">
                                    <img src="{{ $image->temporaryUrl() }}" class="w-full h-20 object-cover rounded-lg">
                                    <button type="button" wire:click="removeImage({{ $index }})"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" wire:click="prevStep" class="btn btn-secondary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Précédent
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span wire:loading.remove wire:target="save">
                                {{ $editMode ? 'Modifier' : 'Enregistrer' }} le véhicule
                            </span>
                            <span wire:loading wire:target="save">{{ $editMode ? 'Modification' : 'Enregistrement' }}...</span>
                        </button>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>
    @endif












    <!-- Modal Détails Véhicule -->
@if($showDetailsModal && $selectedVehicule)
<div class="fixed inset-0 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"  style="z-index: 9999; background-color: rgba(0,0,0,0.5);">
    <div class="bg-slate-800 rounded-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-slate-800 border-b border-slate-700 p-6 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">Détails du véhicule</h2>
                    <p class="text-slate-400 text-sm mt-1">{{ $selectedVehicule->libelle }}</p>
                </div>
                <button wire:click="closeDetailsModal" class="text-slate-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Images du véhicule -->
            @php
                $images = json_decode($selectedVehicule->images, true) ?? [];
            @endphp
            @if(!empty($images))
            <div class="relative h-64 rounded-xl overflow-hidden">
                <img src="{{ $images[0] }}" alt="{{ $selectedVehicule->libelle }}" class="w-full h-full object-cover">
                @if(count($images) > 1)
                <div class="absolute bottom-4 right-4 bg-black/50 text-white px-3 py-1 rounded-lg text-sm">
                    +{{ count($images) - 1 }} photos
                </div>
                @endif
            </div>
            @else
            <div class="h-64 bg-gradient-to-br from-slate-700 to-slate-800 rounded-xl flex items-center justify-center">
                <svg class="w-32 h-32 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
            @endif

            <!-- Informations principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-white font-semibold mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informations générales
                        </h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between py-2 border-b border-slate-700">
                                <span class="text-slate-400">Immatriculation</span>
                                <span class="text-white font-medium">{{ $selectedVehicule->matricule }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-slate-700">
                                <span class="text-slate-400">Chassis</span>
                                <span class="text-white font-mono text-xs">{{ $selectedVehicule->chassis }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-slate-700">
                                <span class="text-slate-400">Marque</span>
                                <span class="text-white">{{ $selectedVehicule->marque }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-slate-700">
                                <span class="text-slate-400">Modèle</span>
                                <span class="text-white">{{ $selectedVehicule->modele ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-slate-700">
                                <span class="text-slate-400">Année</span>
                                <span class="text-white">{{ $selectedVehicule->year ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-slate-700">
                                <span class="text-slate-400">Type</span>
                                <span class="text-white">{{ $selectedVehicule->type ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-slate-400">Carburant</span>
                                <span class="text-white">{{ $selectedVehicule->carburant ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-white font-semibold mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Maintenance
                        </h3>
                        <div class="space-y-3">
                            <div class="p-4 rounded-xl {{ $this->getVehiculeStatus($selectedVehicule) === 'urgent' ? 'bg-red-500/10 border border-red-500/20' : ($this->getVehiculeStatus($selectedVehicule) === 'warning' ? 'bg-orange-500/10 border border-orange-500/20' : 'bg-green-500/10 border border-green-500/20') }}">
                                <p class="{{ $this->getVehiculeStatus($selectedVehicule) === 'urgent' ? 'text-red-400' : ($this->getVehiculeStatus($selectedVehicule) === 'warning' ? 'text-orange-400' : 'text-green-400') }} text-sm font-medium">
                                    Statut: {{ $this->getVehiculeStatus($selectedVehicule) === 'urgent' ? 'Urgent' : ($this->getVehiculeStatus($selectedVehicule) === 'warning' ? 'À surveiller' : 'À jour') }}
                                </p>
                                @if($selectedVehicule->date_prochaine_visite)
                                <p class="text-slate-400 text-xs mt-1">
                                    Prochaine visite: {{ \Carbon\Carbon::parse($selectedVehicule->date_prochaine_visite)->format('d/m/Y') }}
                                </p>
                                @endif
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between py-2 border-b border-slate-700">
                                    <span class="text-slate-400">Kilométrage actuel</span>
                                    <span class="text-white">{{ number_format($selectedVehicule->kilometrage_actuel) }} km</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-slate-700">
                                    <span class="text-slate-400">Coût vidange estimé</span>
                                    <span class="text-white">{{ number_format($selectedVehicule->cout_vidange_estime) }} FCFA</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-slate-400">Date mise en circulation</span>
                                    <span class="text-white">{{ $selectedVehicule->date_mise_circulation ? \Carbon\Carbon::parse($selectedVehicule->date_mise_circulation)->format('d/m/Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($selectedVehicule->description)
            <div>
                <h3 class="text-white font-semibold mb-2">Description</h3>
                <p class="text-slate-400 text-sm">{{ $selectedVehicule->description }}</p>
            </div>
            @endif

            <!-- Historique des entretiens -->
            <div>
                <h3 class="text-white font-semibold mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Historique de maintenance
                </h3>
                @if($selectedVehicule->historique_entretiens && $selectedVehicule->historique_entretiens->count() > 0)
                <div class="space-y-3">
                    @foreach($selectedVehicule->historique_entretiens->take(5) as $entretien)
                    <div class="flex items-start space-x-3 p-3 bg-slate-700/30 rounded-lg">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="text-white font-medium text-sm">{{ $entretien->type_entretient }}</h4>
                                <span class="text-slate-400 text-xs">{{ \Carbon\Carbon::parse($entretien->date_entretient)->format('d/m/Y') }}</span>
                            </div>
                            <p class="text-slate-400 text-xs mt-1">{{ $entretien->kilometrage_intervention ? number_format($entretien->kilometrage_intervention) . ' km' : '' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-slate-400 text-sm">Aucun historique d'entretien</p>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex gap-3 pt-4 border-t border-slate-700">
                <button wire:click="$dispatch('show-reservation-modal', { vehiculeId: {{ $selectedVehicule->id }} })"
                        class="btn btn-primary flex-1">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Réserver maintenance
                </button>
                <button wire:click="$dispatch('edit-vehicule', { vehiculeId: {{ $selectedVehicule->id }} })"
                        class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal Réservation -->
@if($showReservationModal && $selectedVehicule)
<div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-slate-800 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-slate-800 border-b border-slate-700 p-6 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">Réserver une maintenance</h2>
                    <p class="text-slate-400 text-sm mt-1">{{ $selectedVehicule->libelle }} - {{ $selectedVehicule->matricule }}</p>
                </div>
                <button wire:click="closeReservationModal" class="text-slate-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <form wire:submit.prevent="saveReservation" class="p-6 space-y-6">
            <!-- Date et heure -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Date <span class="text-red-400">*</span>
                    </label>
                    <input type="date" wire:model="reservation_date"
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('reservation_date') border-red-500 @enderror">
                    @error('reservation_date') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Heure <span class="text-red-400">*</span>
                    </label>
                    <input type="time" wire:model="reservation_time"
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('reservation_time') border-red-500 @enderror">
                    @error('reservation_time') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Catégorie de service -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    Type de service <span class="text-red-400">*</span>
                </label>
                <select wire:model="reservation_categorie_service_id"
                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('reservation_categorie_service_id') border-red-500 @enderror">
                    <option value="">Sélectionner un service</option>
                    @foreach($categories_services as $category)
                        <option value="{{ $category->id }}">{{ $category->libelle }}</option>
                    @endforeach
                </select>
                @error('reservation_categorie_service_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Type de maintenance -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    Type de maintenance <span class="text-red-400">*</span>
                </label>
                <select wire:model="reservation_type_maintenance"
                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('reservation_type_maintenance') border-red-500 @enderror">
                    <option value="">Sélectionner un type</option>
                    <option value="PREVENTIVE">Préventive</option>
                    <option value="CORRECTIVE">Corrective</option>
                    <option value="URGENTE">Urgente</option>
                </select>
                @error('reservation_type_maintenance') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Description / Notes</label>
                <textarea wire:model="reservation_description" rows="3"
                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Décrivez le problème ou les services souhaités..."></textarea>
            </div>

            <!-- Info véhicule -->
            <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <p class="text-blue-400 text-sm font-medium">Informations du véhicule</p>
                        <p class="text-slate-300 text-sm mt-1">
                            Kilométrage actuel: {{ number_format($selectedVehicule->kilometrage_actuel) }} km
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3 pt-4 border-t border-slate-700">
                <button type="button" wire:click="closeReservationModal" class="btn btn-secondary flex-1">
                    Annuler
                </button>
                <button type="submit" class="btn btn-primary flex-1">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span wire:loading.remove wire:target="saveReservation">Confirmer la réservation</span>
                    <span wire:loading wire:target="saveReservation">Confirmation...</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endif


</div>



@push('css')
<style>
    @keyframes progress {
        0% { width: 0%; }
        50% { width: 70%; }
        100% { width: 100%; }
    }

    .animate-progress {
        animation: progress 1.5s ease-in-out infinite;
    }
</style>
@endpush
