<div>
    <div class="page-content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tous les entretiens</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">Entretiens</li>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Entretiens</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">{{ $stats['total'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                        <i class="ri-tools-line text-primary"></i>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">En cours</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0 text-info">{{ $stats['en_cours'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                        <i class="ri-time-line text-info"></i>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Terminés</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0 text-success">{{ $stats['termines'] }}</h4>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">En retard</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0 text-danger">{{ $stats['en_retard'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger-subtle rounded fs-3">
                                        <i class="ri-alarm-warning-line text-danger"></i>
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
                                    <h5 class="card-title mb-0">Liste des entretiens</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button wire:click="exportEntretiens" class="btn btn-soft-secondary">
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
                                <div class="col-xxl-3 col-sm-6">
                                    <div class="search-box">
                                        <input type="text" wire:model.live.debounce.300ms="search"
                                               class="form-control search"
                                               placeholder="Rechercher...">
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
                                        <option value="PENDING">En attente</option>
                                        <option value="IN_PROGRESS">En cours</option>
                                        <option value="COMPLETED">Terminé</option>
                                        <option value="CANCELLED">Annulé</option>
                                    </select>
                                </div>

                                <!-- Filtre Date -->
                                <div class="col-xxl-2 col-sm-6">
                                    <select wire:model.live="dateFilter" class="form-select">
                                        <option value="">Toutes les dates</option>
                                        <option value="today">Aujourd'hui</option>
                                        <option value="week">Cette semaine</option>
                                        <option value="month">Ce mois</option>
                                        <option value="overdue">En retard</option>
                                    </select>
                                </div>

                                <!-- Reset -->
                                <div class="col-xxl-3 col-sm-6">
                                    <button wire:click="$set('search', ''); $set('entrepriseFilter', ''); $set('statusFilter', ''); $set('dateFilter', '')"
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
                                            <th>N° Entretien</th>
                                            <th>Entreprise</th>
                                            <th>Contrat</th>
                                            <th>Date prévue</th>
                                            <th>Véhicules</th>
                                            <th>Progression</th>
                                            <th>Coût</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($entretiens as $entretien)
                                        <tr class="{{ $entretien->date_prevue < today() && !in_array($entretien->status, ['COMPLETED', 'CANCELLED']) ? 'table-danger' : '' }}">
                                            <td>
                                                <span class="badge bg-primary-subtle text-primary">
                                                    #{{ $entretien->numero_entretien }}
                                                </span>
                                            </td>
                                            <td>
                                                <button wire:click="goToEntreprise({{ $entretien->entreprise_id }})"
                                                        class="btn btn-link btn-sm text-start p-0">
                                                    <i class="ri-building-line me-1"></i>{{ $entretien->entreprise->name }}
                                                </button>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $entretien->contrat->libelle }}</small>
                                            </td>
                                            <td>
                                                <span class="fw-semibold">
                                                    {{ \Carbon\Carbon::parse($entretien->date_prevue)->format('d/m/Y') }}
                                                </span>
                                                @if($entretien->date_prevue < today() && !in_array($entretien->status, ['COMPLETED', 'CANCELLED']))
                                                    <br><span class="badge bg-danger-subtle text-danger">En retard</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="text-success">✓ {{ $entretien->nombre_vehicules_fait }}</span>
                                                    <span class="text-muted small">/ {{ $entretien->nombre_vehicules_total }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="progress" style="height: 20px; min-width: 80px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: {{ ($entretien->nombre_vehicules_fait / $entretien->nombre_vehicules_total) * 100 }}%">
                                                        {{ round(($entretien->nombre_vehicules_fait / $entretien->nombre_vehicules_total) * 100) }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-semibold">{{ number_format($entretien->cout_prevu) }}</span>
                                                <small class="text-muted d-block">FCFA</small>
                                            </td>
                                            <td>
                                                @if($entretien->status === 'PENDING')
                                                    <span class="badge bg-warning">En attente</span>
                                                @elseif($entretien->status === 'IN_PROGRESS')
                                                    <span class="badge bg-info">En cours</span>
                                                @elseif($entretien->status === 'COMPLETED')
                                                    <span class="badge bg-success">Terminé</span>
                                                @else
                                                    <span class="badge bg-danger">Annulé</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button wire:click="openDetailsModal({{ $entretien->id }})"
                                                        class="btn btn-sm btn-soft-primary">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
                                                <div class="py-4">
                                                    <i class="ri-tools-line display-4 text-muted"></i>
                                                    <p class="text-muted mt-3">Aucun entretien trouvé</p>
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
                                    Affichage de {{ $entretiens->firstItem() ?? 0 }} à {{ $entretiens->lastItem() ?? 0 }}
                                    sur {{ $entretiens->total() }} entretiens
                                </div>
                                <div>
                                    {{ $entretiens->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Détails -->
    @include('livewire.dashboard.entretiens.modals.details-entretien')
</div>
