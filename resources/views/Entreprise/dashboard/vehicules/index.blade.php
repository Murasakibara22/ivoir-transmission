
@extends('Entreprise.layouts.dashboard')


@section('title', 'Véhicules')
@section('breadcrumb', 'Véhicules')


@section('content')
<div class="space-y-6" data-dashboard-view="vehicles">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-white">
                Gestion des véhicules
            </h1>
            <p class="text-slate-400 mt-1">
                @livewire('entreprise.vehicules.manage-vehicule')
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <button class="btn btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Exporter
            </button>
            <button class="btn btn-primary" onclick="Livewire.dispatch('open-modal')">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nouveau véhicule
            </button>
        </div>
    </div>

    <!-- Liste dynamique Livewire -->
    @livewire('entreprise.vehicules.vehicules-list')
</div>
@endsection


@push('styles')

<style>
    .vehicles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .view-toggle.active {
        background-color: rgba(59, 130, 246, 0.8);
        color: white;
    }

    .view-toggle:not(.active) {
        color: rgb(148, 163, 184);
    }

    .view-toggle:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .card-vehicle {
        transition: all 0.3s ease;
        min-height: 500px;
        display: flex;
        flex-direction: column;
        padding: 0.5rem;
    }

    .card-vehicle:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    .vehicle-360 {
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .vehicle-360:hover {
        background: linear-gradient(135deg,
            rgba(59, 130, 246, 0.1) 0%,
            rgba(59, 130, 246, 0.05) 100%);
    }

    .vehicle-360 img {
        transition: transform 0.3s ease;
    }

    .vehicle-360:hover img {
        transform: scale(1.05);
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-urgent {
        background-color: rgba(239, 68, 68, 0.1);
        color: rgb(248, 113, 113);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .status-warning {
        background-color: rgba(245, 158, 11, 0.1);
        color: rgb(251, 191, 36);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-success {
        background-color: rgba(34, 197, 94, 0.1);
        color: rgb(74, 222, 128);
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .stat-card {
        padding: 1.5rem;
        border-radius: 1rem;
        border: 1px solid;
        background-color: rgba(30, 41, 59, 0.5);
    }

    .stat-label {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .vehicles-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .card-vehicle {
            min-height: auto;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 640px) {
        .dashboard-main {
            padding: 1rem;
            padding-bottom: 6rem;
        }

        .card {
            padding: 1rem;
        }

        .card-vehicle {
            padding: 1rem;
        }
    }

    @media (max-width: 768px) {
        .fixed.inset-0 {
            z-index: 60; /* Plus élevé que la nav mobile */
        }

        body.modal-open {
            overflow: hidden; /* Empêche le scroll quand modal ouverte */
        }
    }
</style>

@endpush

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
