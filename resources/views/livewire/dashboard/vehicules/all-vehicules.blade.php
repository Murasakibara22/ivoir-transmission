<div>
    <div class="page-content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tous les véhicules</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">Véhicules</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Véhicules</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">{{ $stats['total'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                        <i class="ri-car-line text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Véhicules Actifs</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0 text-success">{{ $stats['actifs'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                        <i class="ri-checkbox-circle-line text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Inactifs</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0 text-danger">{{ $stats['inactifs'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger-subtle rounded fs-3">
                                        <i class="ri-close-circle-line text-danger"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Marques</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0 text-info">{{ $stats['marques'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                        <i class="ri-price-tag-3-line text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Liste des véhicules</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button wire:click="exportVehicules" class="btn btn-soft-secondary">
                                            <i class="ri-file-download-line align-bottom me-1"></i>
                                            Exporter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body border-bottom">
                            <div class="row g-3">
                                <!-- Search -->
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="search-box">
                                        <input type="text" wire:model.live.debounce.300ms="search"
                                               class="form-control search"
                                               placeholder="Rechercher véhicule, matricule, chassis...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>

                                <!-- Filtre Entreprise -->
                                <div class="col-xxl-2 col-sm-6">
                                    <select wire:model.live="entrepriseFilter" class="form-select">
                                        <option value="">Toutes les entreprises</option>
                                        @foreach($entreprises as $entreprise)
                                            <option value="{{ $entreprise->id }}">{{ $entreprise->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filtre Marque -->
                                <div class="col-xxl-2 col-sm-6">
                                    <select wire:model.live="marqueFilter" class="form-select">
                                        <option value="">Toutes les marques</option>
                                        @foreach($marques as $marque)
                                            <option value="{{ $marque }}">{{ $marque }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filtre Statut -->
                                <div class="col-xxl-2 col-sm-6">
                                    <select wire:model.live="statusFilter" class="form-select">
                                        <option value="">Tous les statuts</option>
                                        <option value="ACTIVATED">Actif</option>
                                        <option value="INACTIVATED">Inactif</option>
                                    </select>
                                </div>

                                <!-- Reset filters -->
                                <div class="col-xxl-2 col-sm-6">
                                    <button wire:click="$set('search', ''); $set('entrepriseFilter', ''); $set('marqueFilter', ''); $set('statusFilter', '')"
                                            class="btn btn-light w-100">
                                        <i class="ri-refresh-line me-1"></i>Réinitialiser
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div wire:loading.delay class="text-center py-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Chargement...</span>
                                </div>
                            </div>

                            <div wire:loading.remove class="table-responsive table-card">
                                <table class="table align-middle table-nowrap table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Véhicule</th>
                                            <th>Entreprise</th>
                                            <th>Immatriculation</th>
                                            <th>Chassis</th>
                                            <th>Marque/Modèle</th>
                                            <th>Kilométrage</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vehicules as $vehicule)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <i class="ri-car-line fs-5 text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $vehicule->libelle }}</h6>
                                                        <small class="text-muted">{{ $vehicule->type ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button wire:click="goToEntreprise({{ $vehicule->entreprise_id }})"
                                                        class="btn btn-link btn-sm text-start p-0">
                                                    <i class="ri-building-line me-1"></i>{{ $vehicule->entreprise->name }}
                                                </button>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary-subtle text-secondary">
                                                    {{ $vehicule->matricule }}
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted font-monospace">{{ $vehicule->chassis }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $vehicule->marque }}</strong>
                                                @if($vehicule->modele)
                                                    <br><small class="text-muted">{{ $vehicule->modele }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted">{{ number_format($vehicule->kilometrage_actuel) }} km</span>
                                            </td>
                                            <td>
                                                @if($vehicule->status === 'ACTIVATED')
                                                    <span class="badge bg-success-subtle text-success">Actif</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger">Inactif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button wire:click="openDetailsModal({{ $vehicule->id }})"
                                                        class="btn btn-sm btn-soft-primary">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="py-4">
                                                    <i class="ri-car-line display-4 text-muted"></i>
                                                    <p class="text-muted mt-3">Aucun véhicule trouvé</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted">
                                    Affichage de {{ $vehicules->firstItem() ?? 0 }} à {{ $vehicules->lastItem() ?? 0 }}
                                    sur {{ $vehicules->total() }} véhicules
                                </div>
                                <div>
                                    {{ $vehicules->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Détails -->
    @include('livewire.dashboard.vehicules.modals.details-vehicule')
</div>
