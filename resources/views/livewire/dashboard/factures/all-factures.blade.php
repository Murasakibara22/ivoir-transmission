<div>
    <div class="page-content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Toutes les factures</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">Factures</li>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Factures</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">{{ $stats['total'] }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                        <i class="ri-bill-line text-primary"></i>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">En attente</p>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Payées</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0 text-success">{{ $stats['payees'] }}</h4>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Montant en attente</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-18 fw-semibold ff-secondary mb-0 text-danger">
                                        {{ number_format($stats['montant_total']) }}
                                        <small class="fs-13 text-muted">FCFA</small>
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger-subtle rounded fs-3">
                                        <i class="ri-money-dollar-circle-line text-danger"></i>
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
                                    <h5 class="card-title mb-0">Liste des factures</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button wire:click="exportFactures" class="btn btn-soft-secondary">
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
                                               placeholder="Rechercher facture...">
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
                                        <option value="PAID">Payé</option>
                                        <option value="OVERDUE">En retard</option>
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
                                            <th>Référence</th>
                                            <th>Entreprise</th>
                                            <th>Entretien</th>
                                            <th>Date émission</th>
                                            <th>Date échéance</th>
                                            <th>Montant TTC</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($factures as $facture)
                                        @php
                                            $isOverdue = $facture->date_echeance < today() && $facture->status_paiement === 'PENDING';
                                        @endphp
                                        <tr class="{{ $isOverdue ? 'table-danger' : '' }}">
                                            <td>
                                                <span class="badge bg-secondary-subtle text-secondary fs-6">
                                                    {{ $facture->ref }}
                                                </span>
                                            </td>
                                            <td>
                                                <button wire:click="goToEntreprise({{ $facture->entreprise_id }})"
                                                        class="btn btn-link btn-sm text-start p-0">
                                                    <i class="ri-building-line me-1"></i>{{ $facture->entreprise->name }}
                                                </button>
                                            </td>
                                            <td>
                                                @if($facture->entretien)
                                                    <span class="badge bg-primary-subtle text-primary">
                                                        Entretien #{{ $facture->entretien->numero_entretien }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <span class="fw-semibold {{ $isOverdue ? 'text-danger' : '' }}">
                                                    {{ \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') }}
                                                </span>
                                                @if($isOverdue)
                                                    <br><span class="badge bg-danger-subtle text-danger">En retard</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fw-bold text-primary fs-6">
                                                    {{ number_format($facture->montant_ttc) }}
                                                </span>
                                                <small class="text-muted d-block">FCFA</small>
                                            </td>
                                            <td>
                                                @if($facture->status_paiement === 'PAID')
                                                    <span class="badge bg-success">
                                                        <i class="ri-checkbox-circle-line me-1"></i>Payé
                                                    </span>
                                                @elseif($facture->status_paiement === 'PENDING')
                                                    <span class="badge bg-warning">
                                                        <i class="ri-time-line me-1"></i>En attente
                                                    </span>
                                                @elseif($facture->status_paiement === 'OVERDUE')
                                                    <span class="badge bg-danger">
                                                        <i class="ri-alarm-warning-line me-1"></i>En retard
                                                    </span>
                                                @else
                                                    <span class="badge bg-dark">
                                                        <i class="ri-close-circle-line me-1"></i>Annulé
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-soft-secondary" type="button" data-bs-toggle="dropdown">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <button wire:click="openDetailsModal({{ $facture->id }})" class="dropdown-item">
                                                                <i class="ri-eye-line me-2"></i>Voir détails
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button wire:click="downloadFacture({{ $facture->id }})" class="dropdown-item">
                                                                <i class="ri-download-line me-2"></i>Télécharger PDF
                                                            </button>
                                                        </li>
                                                        @if($facture->status_paiement !== 'PAID')
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <button wire:click="marquerPayee({{ $facture->id }})" class="dropdown-item text-success">
                                                                <i class="ri-check-line me-2"></i>Marquer comme payée
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
                                                    <i class="ri-bill-line display-4 text-muted"></i>
                                                    <p class="text-muted mt-3">Aucune facture trouvée</p>
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
                                    Affichage de {{ $factures->firstItem() ?? 0 }} à {{ $factures->lastItem() ?? 0 }}
                                    sur {{ $factures->total() }} factures
                                </div>
                                <div>
                                    {{ $factures->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Détails -->
    @include('livewire.dashboard.factures.modals.details-facture')
</div>
