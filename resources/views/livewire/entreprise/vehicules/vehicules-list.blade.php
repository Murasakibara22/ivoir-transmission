<div>




    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Gestion des véhicules</h1>
                    <p class="text-slate-400">{{ $stats['total'] }} véhicules dans votre flotte</p>
                </div>

                <div class="flex items-center gap-3">
                    <button class="px-4 py-2 bg-slate-700/50 hover:bg-slate-700 text-white rounded-lg transition-all">
                        <i class="fas fa-download mr-2"></i>
                        Exporter
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters & Search Bar -->
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl border border-slate-700/50 p-6 mb-6">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Rechercher par immatriculation, marque, modèle..."
                            class="w-full pl-12 pr-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        >
                    </div>
                </div>

                <!-- Status Filter -->
                <select
                    wire:model.live="statusFilter"
                    class="px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                >
                    <option value="">Tous les statuts</option>
                    <option value="urgent">Maintenance urgente</option>
                    <option value="warning">À surveiller</option>
                    <option value="good">À jour</option>
                </select>

                <!-- Marque Filter -->
                <select
                    wire:model.live="marqueFilter"
                    class="px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                >
                    <option value="">Toutes les marques</option>
                    @foreach($marques as $marque)
                        <option value="{{ $marque }}">{{ $marque }}</option>
                    @endforeach
                </select>

                <!-- View Mode Toggle -->
                <div class="flex items-center gap-2 bg-slate-900/50 border border-slate-700 rounded-xl p-1">
                    <button
                        wire:click="setViewMode('grid')"
                        class="px-3 py-2 rounded-lg transition-all {{ $viewMode === 'grid' ? 'bg-purple-500 text-white' : 'text-slate-400 hover:text-white' }}"
                    >
                        <i class="fas fa-th"></i>
                    </button>
                    <button
                        wire:click="setViewMode('list')"
                        class="px-3 py-2 rounded-lg transition-all {{ $viewMode === 'list' ? 'bg-purple-500 text-white' : 'text-slate-400 hover:text-white' }}"
                    >
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Maintenance Urgente -->
            <div class="relative overflow-hidden rounded-2xl border border-red-500/20 bg-gradient-to-br from-red-500/10 to-transparent p-6 backdrop-blur-sm">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/10 rounded-full blur-3xl"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-red-400 text-sm font-medium uppercase tracking-wider">Maintenance Urgente</span>
                        <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-4xl font-bold text-white mb-1">{{ $stats['urgent'] }}</div>
                </div>
            </div>

            <!-- À Surveiller -->
            <div class="relative overflow-hidden rounded-2xl border border-orange-500/20 bg-gradient-to-br from-orange-500/10 to-transparent p-6 backdrop-blur-sm">
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/10 rounded-full blur-3xl"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-orange-400 text-sm font-medium uppercase tracking-wider">À Surveiller</span>
                        <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-4xl font-bold text-white mb-1">{{ $stats['a_surveiller'] }}</div>
                </div>
            </div>

            <!-- À Jour -->
            <div class="relative overflow-hidden rounded-2xl border border-green-500/20 bg-gradient-to-br from-green-500/10 to-transparent p-6 backdrop-blur-sm">
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full blur-3xl"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-green-400 text-sm font-medium uppercase tracking-wider">À Jour</span>
                        <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-4xl font-bold text-white mb-1">{{ $stats['a_jour'] }}</div>
                </div>
            </div>

            <!-- Total Flotte -->
            <div class="relative overflow-hidden rounded-2xl border border-blue-500/20 bg-gradient-to-br from-blue-500/10 to-transparent p-6 backdrop-blur-sm">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-blue-400 text-sm font-medium uppercase tracking-wider">Total Flotte</span>
                        <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                             <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-4xl font-bold text-white mb-1">{{ $stats['total'] }}</div>
                </div>
            </div>
        </div>

        <!-- Vehicules Grid/List -->
        @if($viewMode === 'grid')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($vehicules as $vehicule)
                    @php
                        $status = $this->getVehiculeStatus($vehicule);
                        $statusMessage = $this->getStatusMessage($vehicule);
                        $badgeClass = $this->getStatusBadgeClass($status);
                        $statusLabel = $this->getStatusLabel($status);
                    @endphp

                    <div class="group relative bg-slate-800/50 backdrop-blur-sm rounded-2xl border border-slate-700/50 overflow-hidden hover:border-purple-500/50 transition-all duration-300">
                        <!-- Status Badge -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="{{ $badgeClass }} px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider">
                                {{ $statusLabel }}
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="absolute top-4 right-4 z-10 flex gap-2">
                            <button
                                wire:click="showDetails({{ $vehicule->id }})"
                                class="w-10 h-10 bg-slate-900/80 backdrop-blur-sm border border-slate-700 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:border-purple-500 transition-all"
                                title="Voir les détails"
                            >
                                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button
                                wire:click="showHistorique({{ $vehicule->id }})"
                                class="w-10 h-10 bg-slate-900/80 backdrop-blur-sm border border-slate-700 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:border-purple-500 transition-all"
                                title="Voir l'historique"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Vehicle Image -->
                        <div class="relative h-48 bg-slate-900/50 overflow-hidden">
                            @if($vehicule->images && count(json_decode($vehicule->images)) > 0)
                                <img
                                    src="{{ json_decode($vehicule->images)[0] }}"
                                    alt="{{ $vehicule->libelle }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-car text-6xl text-slate-700"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
                        </div>

                        <!-- Vehicle Info -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-1">{{ $vehicule->libelle }}</h3>
                            <p class="text-slate-400 text-sm mb-4">{{ $vehicule->matricule }}</p>

                            <!-- Details Grid -->
                            <div class="grid grid-cols-3 gap-3 mb-4">
                                <div class="bg-slate-900/50 rounded-lg p-3 text-center border border-slate-700/50">
                                    <i class="fas fa-bolt text-slate-400 mb-1"></i>
                                    <p class="text-xs text-slate-500">{{ $vehicule->carburant ?? 'N/A' }}</p>
                                </div>
                                <div class="bg-slate-900/50 rounded-lg p-3 text-center border border-slate-700/50">
                                    <i class="fas fa-calendar text-slate-400 mb-1"></i>
                                    <p class="text-xs text-slate-500">{{ $vehicule->year ?? 'N/A' }}</p>
                                </div>
                                <div class="bg-slate-900/50 rounded-lg p-3 text-center border border-slate-700/50">
                                    <i class="fas fa-tag text-slate-400 mb-1"></i>
                                    <p class="text-xs text-slate-500">{{ $vehicule->type ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <!-- Status Message -->
                            <div class="bg-slate-900/50 rounded-lg p-3 border border-slate-700/50">
                                <p class="text-sm {{ $statusMessage['class'] }}">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    {{ $statusMessage['text'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-car text-6xl text-slate-700 mb-4"></i>
                        <p class="text-slate-400">Aucun véhicule trouvé</p>
                    </div>
                @endforelse
            </div>
        @else
            <!-- List View -->
            <div class="space-y-4">
                @forelse($vehicules as $vehicule)
                    @php
                        $status = $this->getVehiculeStatus($vehicule);
                        $statusMessage = $this->getStatusMessage($vehicule);
                        $badgeClass = $this->getStatusBadgeClass($status);
                        $statusLabel = $this->getStatusLabel($status);
                    @endphp

                    <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl border border-slate-700/50 p-6 hover:border-purple-500/50 transition-all">
                        <div class="flex items-center gap-6">
                            <!-- Vehicle Image -->
                            <div class="w-32 h-24 bg-slate-900/50 rounded-lg overflow-hidden flex-shrink-0">
                                @if($vehicule->images && count(json_decode($vehicule->images)) > 0)
                                    <img
                                        src="{{ json_decode($vehicule->images)[0] }}"
                                        alt="{{ $vehicule->libelle }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-car text-3xl text-slate-700"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Vehicle Info -->
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h3 class="text-xl font-bold text-white">{{ $vehicule->libelle }}</h3>
                                        <p class="text-slate-400">{{ $vehicule->matricule }}</p>
                                    </div>
                                    <span class="{{ $badgeClass }} px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider">
                                        {{ $statusLabel }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-6 text-sm text-slate-400 mb-3">
                                    <span><i class="fas fa-industry mr-2"></i>{{ $vehicule->marque }}</span>
                                    <span><i class="fas fa-car-side mr-2"></i>{{ $vehicule->modele }}</span>
                                    <span><i class="fas fa-bolt mr-2"></i>{{ $vehicule->carburant }}</span>
                                    <span><i class="fas fa-calendar mr-2"></i>{{ $vehicule->year }}</span>
                                </div>

                                <p class="text-sm {{ $statusMessage['class'] }}">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    {{ $statusMessage['text'] }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2 flex-shrink-0">
                                <button
                                    wire:click="showDetails({{ $vehicule->id }})"
                                    class="w-10 h-10 bg-slate-900/80 backdrop-blur-sm border border-slate-700 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:border-purple-500 transition-all"
                                    title="Voir les détails"
                                >
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button
                                    wire:click="showHistorique({{ $vehicule->id }})"
                                    class="w-10 h-10 bg-slate-900/80 backdrop-blur-sm border border-slate-700 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:border-purple-500 transition-all"
                                    title="Voir l'historique"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <i class="fas fa-car text-6xl text-slate-700 mb-4"></i>
                        <p class="text-slate-400">Aucun véhicule trouvé</p>
                    </div>
                @endforelse
            </div>
        @endif

        <!-- Pagination -->
        <div class="mt-8">
            {{ $vehicules->links() }}
        </div>
    </div>

    <!-- Modal Détails -->
    @if($showDetailModal && $selectedVehicule)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" wire:click="closeModals">
            <div class="bg-slate-800 rounded-2xl border border-slate-700 w-full max-w-4xl max-h-[90vh] overflow-y-auto" wire:click.stop>
                <!-- Modal Header -->
                <div class="sticky top-0 bg-slate-800 border-b border-slate-700 p-6 flex items-center justify-between z-10">
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ $selectedVehicule->libelle }}</h2>
                        <p class="text-slate-400">{{ $selectedVehicule->matricule }}</p>
                    </div>
                    <button wire:click="closeModals" class="w-10 h-10 bg-slate-700 hover:bg-slate-600 rounded-lg flex items-center justify-center text-white transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6">
                    <!-- Images Gallery -->
                    @if($selectedVehicule->images && count(json_decode($selectedVehicule->images)) > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-white mb-4">Photos du véhicule</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach(json_decode($selectedVehicule->images) as $image)
                                    <img src="{{ $image }}" alt="Photo" class="w-full h-48 object-cover rounded-lg">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Vehicle Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm text-slate-400">Marque</label>
                                <p class="text-white font-semibold">{{ $selectedVehicule->marque ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-slate-400">Modèle</label>
                                <p class="text-white font-semibold">{{ $selectedVehicule->modele ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-slate-400">Type</label>
                                <p class="text-white font-semibold">{{ $selectedVehicule->type ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-slate-400">Année</label>
                                <p class="text-white font-semibold">{{ $selectedVehicule->year ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="text-sm text-slate-400">Châssis</label>
                                <p class="text-white font-semibold">{{ $selectedVehicule->chassis ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-slate-400">Carburant</label>
                                <p class="text-white font-semibold">{{ $selectedVehicule->carburant ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-slate-400">Couleur</label>
                                <p class="text-white font-semibold">{{ $selectedVehicule->couleur ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-slate-400">Kilométrage actuel</label>
                                <p class="text-white font-semibold">{{ number_format($selectedVehicule->kilometrage_actuel) }} km</p>
                            </div>
                        </div>
                    </div>

                    @if($selectedVehicule->description)
                        <div class="mt-6">
                            <label class="text-sm text-slate-400">Description</label>
                            <p class="text-white mt-2">{{ $selectedVehicule->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Historique -->
    @if($showHistoriqueModal && $selectedVehicule)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" wire:click="closeModals">
            <div class="bg-slate-800 rounded-2xl border border-slate-700 w-full max-w-6xl max-h-[90vh] overflow-y-auto" wire:click.stop>
                <!-- Modal Header -->
                <div class="sticky top-0 bg-slate-800 border-b border-slate-700 p-6 flex items-center justify-between z-10">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Historique d'entretien</h2>
                        <p class="text-slate-400">{{ $selectedVehicule->libelle }} - {{ $selectedVehicule->matricule }}</p>
                    </div>
                    <button wire:click="closeModals" class="w-10 h-10 bg-slate-700 hover:bg-slate-600 rounded-lg flex items-center justify-center text-white transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6">
                    @if($selectedVehicule->historiqueEntretiens && $selectedVehicule->historiqueEntretiens->count() > 0)
                        <div class="space-y-4">
                            @foreach($selectedVehicule->historiqueEntretiens as $entretien)
                                <div class="bg-slate-900/50 rounded-xl border border-slate-700 p-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h4 class="text-lg font-semibold text-white">{{ $entretien->type_entretient }}</h4>
                                            <p class="text-sm text-slate-400">{{ \Carbon\Carbon::parse($entretien->date_entretient)->format('d M Y') }}</p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase
                                            {{ $entretien->status === 'DONE' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : '' }}
                                            {{ $entretien->status === 'PENDING' ? 'bg-orange-500/20 text-orange-400 border border-orange-500/30' : '' }}
                                            {{ $entretien->status === 'IN_PROGRESS' ? 'bg-blue-500/20 text-blue-400 border border-blue-500/30' : '' }}
                                        ">
                                            {{ $entretien->status }}
                                        </span>
                                    </div>

                                    @if($entretien->description)
                                        <p class="text-slate-300 mb-4">{{ $entretien->description }}</p>
                                    @endif

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                        @if($entretien->kilometrage_intervention)
                                            <div>
                                                <span class="text-slate-400">Kilométrage:</span>
                                                <p class="text-white font-semibold">{{ number_format($entretien->kilometrage_intervention) }} km</p>
                                            </div>
                                        @endif
                                        @if($entretien->prochain_entretien_km)
                                            <div>
                                                <span class="text-slate-400">Prochain (km):</span>
                                                <p class="text-white font-semibold">{{ number_format($entretien->prochain_entretien_km) }} km</p>
                                            </div>
                                        @endif
                                        @if($entretien->prochain_entretien_date)
                                            <div>
                                                <span class="text-slate-400">Prochain (date):</span>
                                                <p class="text-white font-semibold">{{ \Carbon\Carbon::parse($entretien->prochain_entretien_date)->format('d M Y') }}</p>
                                            </div>
                                        @endif
                                        @if($entretien->cout_pieces || $entretien->cout_main_oeuvre)
                                            <div>
                                                <span class="text-slate-400">Coût total:</span>
                                                <p class="text-white font-semibold">{{ number_format($entretien->cout_pieces + $entretien->cout_main_oeuvre) }} FCFA</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-history text-6xl text-slate-700 mb-4"></i>
                            <p class="text-slate-400">Aucun historique d'entretien disponible</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>



</div>




@push('styles')
<style>

<style>
.status-badge {
    @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider border;
}

.status-urgent {
    @apply bg-red-500/20 text-red-400 border-red-500/30;
}

.status-warning {
    @apply bg-orange-500/20 text-orange-400 border-orange-500/30;
}

.status-success {
    @apply bg-green-500/20 text-green-400 border-green-500/30;
}
</style>
</style>
@endpush
