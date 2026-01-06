<div>
    <div class="page-content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tous les contrats</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">Contrats</li>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Contrats</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">{{ $stats['total'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                        <i class="ri-file-list-3-line text-primary"></i>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Contrats Actifs</p>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">En Attente</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0 text-warning">{{ $stats['en_attente'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                        <i class="ri-time-line text-warning"></i>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Expirés</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0 text-danger">{{ $stats['expires'] }}</h4>
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
            </div>

            <!-- Main Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Liste des contrats</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button wire:click="exportContrats" class="btn btn-soft-secondary">
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
                                               placeholder="Rechercher un contrat...">
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

                                <!-- Filtre Statut -->
                                <div class="col-xxl-2 col-sm-6">
                                    <select wire:model.live="statusFilter" class="form-select">
                                        <option value="">Tous les statuts</option>
                                        <option value="DRAFT">Brouillon</option>
                                        <option value="PENDING">En attente</option>
                                        <option value="ACTIVE">Actif</option>
                                        <option value="EXPIRED">Expiré</option>
                                        <option value="CANCELLED">Annulé</option>
                                    </select>
                                </div>

                                <!-- Filtre Fréquence -->
                                <div class="col-xxl-2 col-sm-6">
                                    <select wire:model.live="frequenceFilter" class="form-select">
                                        <option value="">Toutes les fréquences</option>
                                        <option value="MENSUEL">Mensuel</option>
                                        <option value="TRIMESTRIEL">Trimestriel</option>
                                        <option value="SEMESTRIEL">Semestriel</option>
                                        <option value="ANNUEL">Annuel</option>
                                    </select>
                                </div>

                                <!-- Reset -->
                                <div class="col-xxl-2 col-sm-6">
                                    <button wire:click="$set('search', ''); $set('entrepriseFilter', ''); $set('statusFilter', ''); $set('frequenceFilter', '')"
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
                                            <th>Libellé</th>
                                            <th>Entreprise</th>
                                            <th>Fréquence</th>
                                            <th>Véhicules</th>
                                            <th>Montant</th>
                                            <th>Période</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($contrats as $contrat)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">{{ $contrat->libelle }}</h6>
                                                @if($contrat->description)
                                                    <small class="text-muted">{{ Str::limit($contrat->description, 40) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <button wire:click="goToEntreprise({{ $contrat->entreprise_id }})"
                                                        class="btn btn-link btn-sm text-start p-0">
                                                    <i class="ri-building-line me-1"></i>{{ $contrat->entreprise->name }}
                                                </button>
                                            </td>
                                            <td>
                                                <span class="badge bg-info-subtle text-info">
                                                    {{ $contrat->frequence_entretien }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary-subtle text-primary">
                                                    {{ $contrat->nombre_vehicules }} véhicules
                                                </span>
                                            </td>
                                            <td class="fw-semibold">{{ number_format($contrat->montant_entretien) }} FCFA</td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}
                                                    <i class="ri-arrow-right-line"></i>
                                                    {{ \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                @if($contrat->status === 'ACTIVE')
                                                    <span class="badge bg-success">Actif</span>
                                                @elseif($contrat->status === 'PENDING')
                                                    <span class="badge bg-warning">En attente</span>
                                                @elseif($contrat->status === 'DRAFT')
                                                    <span class="badge bg-secondary">Brouillon</span>
                                                @elseif($contrat->status === 'EXPIRED')
                                                    <span class="badge bg-danger">Expiré</span>
                                                @else
                                                    <span class="badge bg-dark">Annulé</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-soft-secondary" type="button" data-bs-toggle="dropdown">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <button wire:click="openDetailsModal({{ $contrat->id }})" class="dropdown-item">
                                                                <i class="ri-eye-line me-2"></i>Voir détails
                                                            </button>
                                                        </li>
                                                        @if($contrat->status === 'PENDING')
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <button wire:click="activerContrat({{ $contrat->id }})" class="dropdown-item text-success">
                                                                <i class="ri-check-line me-2"></i>Activer
                                                            </button>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="py-4">
                                                    <i class="ri-file-list-3-line display-4 text-muted"></i>
                                                    <p class="text-muted mt-3">Aucun contrat trouvé</p>
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
                                    Affichage de {{ $contrats->firstItem() ?? 0 }} à {{ $contrats->lastItem() ?? 0 }}
                                    sur {{ $contrats->total() }} contrats
                                </div>
                                <div>
                                    {{ $contrats->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Détails -->
    @include('livewire.dashboard.contrats.modals.details-contrat')
</div>
