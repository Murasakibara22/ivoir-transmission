<div>
    <!-- Filters & Search -->
    <div class="card mb-6">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Rechercher par immatriculation, marque, modèle..."
                        class="w-full px-4 py-3 pl-12 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Filters -->
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Status Filter -->
                <select wire:model.live="statusFilter" class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="urgent">Urgent</option>
                    <option value="warning">À surveiller</option>
                    <option value="good">À jour</option>
                </select>

                <!-- Brand Filter -->
                <select wire:model.live="marqueFilter" class="px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Toutes les marques</option>
                    @foreach($marques as $marque)
                        <option value="{{ $marque }}">{{ $marque }}</option>
                    @endforeach
                </select>

                <!-- View Toggle -->
                <div class="flex bg-slate-700/50 rounded-xl p-1">
                    <button wire:click="setViewMode('grid')" class="view-toggle {{ $viewMode === 'grid' ? 'active' : '' }} px-3 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button wire:click="setViewMode('list')" class="view-toggle {{ $viewMode === 'list' ? 'active' : '' }} px-3 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="stat-card bg-red-500/10 border-red-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-red-400">Maintenance urgente</p>
                    <p class="stat-value text-red-400">{{ $stats['urgent'] }}</p>
                </div>
                <div class="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-orange-500/10 border-orange-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-orange-400">À surveiller</p>
                    <p class="stat-value text-orange-400">{{ $stats['a_surveiller'] }}</p>
                </div>
                <div class="w-10 h-10 bg-orange-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-green-500/10 border-green-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-green-400">À jour</p>
                    <p class="stat-value text-green-400">{{ $stats['a_jour'] }}</p>
                </div>
                <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-blue-500/10 border-blue-500/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label text-blue-400">Total flotte</p>
                    <p class="stat-value text-blue-400">{{ $stats['total'] }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading State -->
    <div wire:loading.delay class="text-center py-8">
        <div class="inline-flex items-center space-x-2 text-blue-400">
            <svg class="animate-spin h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Chargement...</span>
        </div>
    </div>

    <!-- Grid View -->
    @if($viewMode === 'grid')
    <div class="vehicles-grid" wire:loading.remove>
        @forelse($vehicules as $vehicule)
            @php
                $status = $this->getVehiculeStatus($vehicule);
                $statusMessage = $this->getStatusMessage($vehicule);
                $images = json_decode($vehicule->images, true) ?? [];
                $firstImage = !empty($images) ? $images[0] : null;
            @endphp

            <div class="card-vehicle">
                <div class="relative overflow-hidden rounded-xl mb-4">
                    <div class="absolute top-3 left-3 z-10">
                        <span class="{{ $this->getStatusBadgeClass($status) }}">
                            {{ $this->getStatusLabel($status) }}
                        </span>
                    </div>
                    <div class="absolute top-3 right-3 z-10">
                        <div class="w-8 h-8 bg-blue-600/90 backdrop-blur-sm rounded-full flex items-center justify-center cursor-pointer">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                    </div>
                    <div class="vehicle-360 relative h-100 overflow-hidden rounded-xl">
                        @if($firstImage)
                            <img src="{{ $firstImage }}" alt="{{ $vehicule->libelle }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center">
                                <svg class="w-24 h-24 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 w-4 h-1 bg-blue-400 rounded-full animate-pulse"></div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-white font-semibold text-lg">{{ $vehicule->libelle }}</h3>
                        <p class="text-slate-400 text-sm">{{ $vehicule->matricule }}</p>
                        <p class="text-xs text-slate-500 mt-1">
                            {{ $vehicule->year ?? 'N/A' }} • {{ number_format($vehicule->kilometrage_actuel) }} km
                        </p>
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <p class="text-xs text-slate-400">{{ $vehicule->carburant ?? 'N/A' }}</p>
                        </div>
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs text-slate-400">{{ $vehicule->type ?? 'N/A' }}</p>
                        </div>
                        <div class="text-center p-2 bg-slate-700/30 rounded-lg">
                            <svg class="w-4 h-4 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <p class="text-xs text-slate-400">{{ $vehicule->marque }}</p>
                        </div>
                    </div>

                    <div class="p-3 {{ $status === 'urgent' ? 'bg-red-500/10 border border-red-500/20' : ($status === 'warning' ? 'bg-orange-500/10 border border-orange-500/20' : 'bg-green-500/10 border border-green-500/20') }} rounded-lg">
                        <p class="{{ $statusMessage['class'] }} text-sm font-medium">{{ $statusMessage['text'] }}</p>
                    </div>


                   <div class="grid grid-cols-1 gap-2">
                        <button wire:click="$dispatch('show-reservation-modal', { vehiculeId: {{ $vehicule->id }} })"
                                class="btn btn-primary btn-sm w-full">
                            Réserver maintenance
                        </button>
                        <div class="grid grid-cols-3 gap-2">
                            <button wire:click="$dispatch('edit-vehicule', { vehiculeId: {{ $vehicule->id }} })"
                                    class="btn btn-secondary btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button wire:click="$dispatch('show-historique-modal', { vehiculeId: {{ $vehicule->id }} })"
                                    class="btn btn-secondary btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                            <button wire:click="$dispatch('show-vehicule-details', { vehiculeId: {{ $vehicule->id }} })"
                                    class="btn btn-secondary btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
                <p class="text-slate-400 text-lg">Aucun véhicule trouvé</p>
                <p class="text-slate-500 text-sm mt-2">Commencez par ajouter votre premier véhicule</p>
            </div>
        @endforelse
    </div>
    @endif

    <!-- List View -->
    @if($viewMode === 'list')
    <div class="space-y-4" wire:loading.remove>
        @forelse($vehicules as $vehicule)
            @php
                $status = $this->getVehiculeStatus($vehicule);
                $statusMessage = $this->getStatusMessage($vehicule);
            @endphp

            <div class="card">
                <div class="flex items-center p-6 space-x-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-700 to-slate-800 rounded-xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-{{ $status === 'urgent' ? 'red' : ($status === 'warning' ? 'orange' : 'green') }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </div>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-white font-semibold text-lg">{{ $vehicule->libelle }}</h3>
                                <p class="text-slate-400">{{ $vehicule->matricule }} • {{ $vehicule->year ?? 'N/A' }} • {{ number_format($vehicule->kilometrage_actuel) }} km</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span class="text-xs text-slate-500">{{ $vehicule->carburant ?? 'N/A' }} • {{ $vehicule->type ?? 'N/A' }} • {{ $vehicule->marque }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="{{ $this->getStatusBadgeClass($status) }}">
                                    {{ $this->getStatusLabel($status) }}
                                </span>
                                <div class="text-right">
                                    <p class="{{ $statusMessage['class'] }} text-sm font-medium">{{ $statusMessage['text'] }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="btn btn-primary btn-sm">Réserver</button>
                                    <button class="btn btn-secondary btn-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
                <p class="text-slate-400 text-lg">Aucun véhicule trouvé</p>
            </div>
        @endforelse
    </div>
    @endif

    <!-- Pagination -->
    <div class="mt-6">
        {{ $vehicules->links() }}
    </div>
</div>




@push('scripts')
<script>
    // View Toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const viewToggles = document.querySelectorAll('.view-toggle');
        const gridView = document.getElementById('grid-view');
        const listView = document.getElementById('list-view');

        viewToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const view = this.dataset.view;

                // Update active states
                viewToggles.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Toggle views
                if (view === 'grid') {
                    gridView.classList.remove('hidden');
                    listView.classList.add('hidden');
                } else {
                    gridView.classList.add('hidden');
                    listView.classList.remove('hidden');
                }
            });
        });

        // Vehicle card interactions
        const vehicleCards = document.querySelectorAll('.card-vehicle');
        vehicleCards.forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('.btn')) {
                    const vehicleId = this.dataset.vehicleId;
                    openVehicleDetails(vehicleId);
                }
            });
        });

        // Search functionality
        const searchInput = document.querySelector('[data-search="vehicles"]');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    performVehicleSearch(this.value);
                }, 300);
            });
        }

        // Filter functionality
        const filterSelects = document.querySelectorAll('select');
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                applyFilters();
            });
        });
    });

    // Functions
    function openVehicleDetails(vehicleId) {
        console.log('Opening vehicle details for:', vehicleId);
        showVehicleModal(vehicleId);
    }

    function showVehicleHistory(vehicleId) {
        console.log('Showing vehicle history for:', vehicleId);
        showHistoryModal(vehicleId);
    }

    function showVehicleModal(vehicleId) {
        // Create modal backdrop
        const backdrop = document.createElement('div');
    backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm';
        backdrop.innerHTML = `
            <div class="bg-slate-800 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white">Détails du véhicule</h2>
                        <button onclick="this.closest('.fixed').remove()" class="text-slate-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-6">
                        <!-- Vehicle Image -->
                        <div class="relative h-48 rounded-xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1558618644-fcd25c85cd64?w=600&h=300&fit=crop"
                                 alt="Vehicle" class="w-full h-full object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="px-2 py-1 bg-black/50 text-white text-sm rounded-lg">Vue 360°</span>
                            </div>
                        </div>

                        <!-- Vehicle Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-white font-semibold mb-3">Informations générales</h3>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Immatriculation</span>
                                        <span class="text-white">AB-123-CD</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Kilométrage</span>
                                        <span class="text-white">52,000 km</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Année</span>
                                        <span class="text-white">2019</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-white font-semibold mb-3">Maintenance</h3>
                                <div class="space-y-2">
                                    <div class="p-3 bg-red-500/10 border border-red-500/20 rounded-lg">
                                        <p class="text-red-400 text-sm font-medium">Vidange urgente</p>
                                        <p class="text-slate-400 text-xs">Retard: 2,000 km</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3">
                            <button class="btn btn-primary flex-1">Réserver maintenance</button>
                            <button onclick="showVehicleHistory(${vehicleId}); this.closest('.fixed').remove();"
                                    class="btn btn-secondary">Voir historique</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(backdrop);
    }

    function showHistoryModal(vehicleId) {
        const backdrop = document.createElement('div');
        backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm';
        backdrop.innerHTML = `
            <div class="bg-slate-800 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white">Historique de maintenance</h2>
                        <button onclick="this.closest('.fixed').remove()" class="text-slate-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <!-- Timeline -->
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-3 h-3 bg-green-500 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-white font-medium">Vidange moteur</h4>
                                        <span class="text-slate-400 text-sm">15 Jan 2025</span>
                                    </div>
                                    <p class="text-slate-400 text-sm">43,000 km • Ivoire Transmission</p>
                                    <p class="text-green-400 text-xs mt-1">Terminé</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-3 h-3 bg-green-500 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-white font-medium">Révision complète</h4>
                                        <span class="text-slate-400 text-sm">12 Déc 2024</span>
                                    </div>
                                    <p class="text-slate-400 text-sm">40,000 km • Ivoire Transmission</p>
                                    <p class="text-green-400 text-xs mt-1">Terminé</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(backdrop);
    }

    function openAddVehicleModal() {
        console.log('Opening add vehicle modal');
        // TODO: Implement add vehicle modal
    }

    function performVehicleSearch(query) {
        console.log('Searching vehicles:', query);
        // TODO: Implement search functionality
    }

    function applyFilters() {
        console.log('Applying filters');
        // TODO: Implement filter functionality
    }

    // Vehicle card hover effects
    document.querySelectorAll('.card-vehicle').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // 360° view simulation
    document.querySelectorAll('.vehicle-360').forEach(container => {
        container.addEventListener('click', function() {
            const icon = this.querySelector('svg');
            if (icon) {
                icon.style.transform = 'rotateY(360deg)';
                icon.style.transition = 'transform 1s ease-in-out';

                setTimeout(() => {
                    icon.style.transform = 'rotateY(0deg)';
                }, 1000);
            }
        });
    });
</script>




@endpush
