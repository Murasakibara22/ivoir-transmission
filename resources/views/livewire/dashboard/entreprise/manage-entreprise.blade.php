<div >
    <div class="page-content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Gestion Entreprise</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Accueil</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.entreprise') }}">Entreprises</a></li>
                                <li class="breadcrumb-item active">{{ $entreprise->name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img @if($entreprise->logo) src="{{ $entreprise->logo }}" @else src="https://api.dicebear.com/7.x/initials/svg?seed={{ $entreprise->name }}" @endif alt="Logo" class="avatar-lg rounded-circle">
                                </div>
                                <div class="col">
                                    <h4 class="mb-1">{{ $entreprise->name }}</h4>
                                    <p class="text-muted mb-2">
                                        <i class="ri-mail-line me-1"></i>{{ $entreprise->email }}
                                        <span class="mx-2">•</span>
                                        <i class="ri-phone-line me-1"></i>{{ $entreprise->phone }}
                                    </p>
                                    <div>
                                        @if($entreprise->status === 'ACTIVATED')
                                            <span class="badge bg-success-subtle text-success">
                                                <i class="ri-checkbox-circle-line me-1"></i>Actif
                                            </span>
                                        @elseif($entreprise->status === 'SUSPENDED')
                                            <span class="badge bg-warning-subtle text-warning">
                                                <i class="ri-pause-circle-line me-1"></i>Suspendu
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">
                                                <i class="ri-close-circle-line me-1"></i>Inactif
                                            </span>
                                        @endif

                                        @if($entreprise->type)
                                            <span class="badge bg-info-subtle text-info ms-2">{{ $entreprise->type }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button wire:click="openEditInfoModal" class="btn btn-soft-primary">
                                        <i class="ri-edit-line me-1"></i>Modifier
                                    </button>
                                    <button wire:click="toggleStatus" class="btn btn-soft-{{ $entreprise->status === 'ACTIVATED' ? 'warning' : 'success' }} ms-2">
                                        <i class="ri-{{ $entreprise->status === 'ACTIVATED' ? 'pause' : 'play' }}-circle-line me-1"></i>
                                        {{ $entreprise->status === 'ACTIVATED' ? 'Suspendre' : 'Activer' }}
                                    </button>
                                </div>
                            </div>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Véhicules</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                        {{ $entreprise->vehicules->count() }}
                                    </h4>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Contrats Actifs</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                        {{ $entreprise->contrats->where('status', 'ACTIVE')->count() }}
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                        <i class="ri-file-list-3-line text-success"></i>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Factures Impayées</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                        {{ $entreprise->factures->where('status_paiement', 'PENDING')->count() }}
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                        <i class="ri-bill-line text-warning"></i>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Entretiens en cours</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                        {{ \App\Models\Entretien::where('entreprise_id', $entreprise->id)->where('status', 'IN_PROGRESS')->count() }}
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                        <i class="ri-tools-line text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button wire:click="setActiveTab('informations')"
                                            class="nav-link {{ $activeTab === 'informations' ? 'active' : '' }}"
                                            type="button">
                                        <i class="ri-information-line me-1"></i>
                                        Informations
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button wire:click="setActiveTab('vehicules')"
                                            class="nav-link {{ $activeTab === 'vehicules' ? 'active' : '' }}"
                                            type="button">
                                        <i class="ri-car-line me-1"></i>
                                        Véhicules
                                        <span class="badge bg-primary ms-1">{{ $entreprise->vehicules->count() }}</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button wire:click="setActiveTab('contrats')"
                                            class="nav-link {{ $activeTab === 'contrats' ? 'active' : '' }}"
                                            type="button">
                                        <i class="ri-file-list-3-line me-1"></i>
                                        Contrats
                                        <span class="badge bg-success ms-1">{{ $entreprise->contrats->count() }}</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button wire:click="setActiveTab('entretiens')"
                                            class="nav-link {{ $activeTab === 'entretiens' ? 'active' : '' }}"
                                            type="button">
                                        <i class="ri-tools-line me-1"></i>
                                        Entretiens
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button wire:click="setActiveTab('factures')"
                                            class="nav-link {{ $activeTab === 'factures' ? 'active' : '' }}"
                                            type="button">
                                        <i class="ri-bill-line me-1"></i>
                                        Factures
                                        <span class="badge bg-warning ms-1">{{ $entreprise->factures->count() }}</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- ONGLET INFORMATIONS -->
                @if($activeTab === 'informations')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Informations de l'entreprise</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Nom de l'entreprise</label>
                                            <p class="fs-14 mb-0">{{ $entreprise->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Email</label>
                                            <p class="fs-14 mb-0">{{ $entreprise->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Téléphone</label>
                                            <p class="fs-14 mb-0">{{ $entreprise->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Type</label>
                                            <p class="fs-14 mb-0">{{ $entreprise->type ?? 'Non défini' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Statut</label>
                                            <p class="fs-14 mb-0">
                                                @if($entreprise->status === 'ACTIVATED')
                                                    <span class="badge bg-success">Actif</span>
                                                @elseif($entreprise->status === 'SUSPENDED')
                                                    <span class="badge bg-warning">Suspendu</span>
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Date d'inscription</label>
                                            <p class="fs-14 mb-0">{{ $entreprise->created_at->format('d/m/Y à H:i') }}</p>
                                        </div>
                                    </div>
                                    @if(is_array($entreprise->address) && count($entreprise->address) > 0)
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Adresse</label>
                                            <p class="fs-14 mb-0">
                                                {{ $entreprise->address['rue'] ?? '' }}<br>
                                                {{ $entreprise->address['ville'] ?? '' }} {{ $entreprise->address['code_postal'] ?? '' }}<br>
                                                {{ $entreprise->address['pays'] ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- ONGLET VÉHICULES -->
                @if($activeTab === 'vehicules')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">Liste des véhicules</h5>
                                <button wire:click="openAddVehiculeModal" class="btn btn-primary">
                                    <i class="ri-add-line me-1"></i>Ajouter un véhicule
                                </button>
                            </div>
                            <div class="card-body">
                                <!-- Search -->
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="search-box">
                                            <input type="text" wire:model.live.debounce.300ms="search"
                                                   class="form-control search"
                                                   placeholder="Rechercher un véhicule...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vehicles List -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Véhicule</th>
                                                <th>Immatriculation</th>
                                                <th>Marque</th>
                                                <th>Modèle</th>
                                                <th>Année</th>
                                                <th>Kilométrage</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($vehicules as $vehicule)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <i class="ri-car-line fs-20 text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $vehicule->libelle }}</h6>
                                                            <small class="text-muted">{{ $vehicule->type ?? 'N/A' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary-subtle text-secondary">
                                                        {{ $vehicule->matricule }}
                                                    </span>
                                                </td>
                                                <td>{{ $vehicule->marque }}</td>
                                                <td>{{ $vehicule->modele ?? 'N/A' }}</td>
                                                <td>{{ $vehicule->year ?? 'N/A' }}</td>
                                                <td>{{ number_format($vehicule->kilometrage_actuel) }} km</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-soft-secondary" type="button" data-bs-toggle="dropdown">
                                                            <i class="ri-more-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <button wire:click="openVehiculeDetailsModal({{ $vehicule->id }})" class="dropdown-item">
                                                                    <i class="ri-eye-line me-2"></i>Voir détails
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button wire:click="openEditVehiculeModal({{ $vehicule->id }})" class="dropdown-item">
                                                                    <i class="ri-edit-line me-2"></i>Modifier
                                                                </button>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <button wire:click="confirmDelete({{ $vehicule->id }}, 'vehicule')" class="dropdown-item text-danger">
                                                                    <i class="ri-delete-bin-line me-2"></i>Supprimer
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="py-4">
                                                        <i class="ri-car-line fs-1 text-muted"></i>
                                                        <p class="text-muted mt-2">Aucun véhicule trouvé</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                @if($vehicules->hasPages())
                                <div class="mt-3">
                                    {{ $vehicules->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- ONGLET CONTRATS -->
                @if($activeTab === 'contrats')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">Liste des contrats</h5>
                                <button wire:click="openAddContratModal" class="btn btn-primary">
                                    <i class="ri-add-line me-1"></i>Créer un contrat
                                </button>
                            </div>
                            <div class="card-body">
                                <!-- Filters -->
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <select wire:model.live="statusFilter" class="form-select">
                                            <option value="">Tous les statuts</option>
                                            <option value="DRAFT">Brouillon</option>
                                            <option value="PENDING">En attente</option>
                                            <option value="ACTIVE">Actif</option>
                                            <option value="EXPIRED">Expiré</option>
                                            <option value="CANCELLED">Annulé</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Contracts List -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Libellé</th>
                                                <th>Fréquence</th>
                                                <th>Véhicules</th>
                                                <th>Montant</th>
                                                <th>Date début</th>
                                                <th>Date fin</th>
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
                                                    <span class="badge bg-info-subtle text-info">
                                                        {{ $contrat->frequence_entretien }}
                                                    </span>
                                                </td>
                                                <td>{{ $contrat->nombre_vehicules }} véhicules</td>
                                                <td class="fw-semibold">{{ number_format($contrat->montant_entretien) }} FCFA</td>
                                                <td>{{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') }}</td>
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
                                                            @if($contrat->status === 'PENDING')
                                                            <li>
                                                                <button wire:click="activerContrat({{ $contrat->id }})" class="dropdown-item text-success">
                                                                    <i class="ri-check-line me-2"></i>Activer le contrat
                                                                </button>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            @endif
                                                            <li>
                                                                <a href="#" wire:click="openContratDetailsModal({{ $contrat->id }})" class="dropdown-item">
                                                                    <i class="ri-eye-line me-2"></i>Voir détails
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" wire:click="openEditContratModal({{ $contrat->id }})" class="dropdown-item">
                                                                    <i class="ri-edit-line me-2"></i>Modifier
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <div class="py-4">
                                                        <i class="ri-file-list-3-line fs-1 text-muted"></i>
                                                        <p class="text-muted mt-2">Aucun contrat trouvé</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if($contrats->hasPages())
                                <div class="mt-3">
                                    {{ $contrats->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

               <!-- ONGLET ENTRETIENS -->
                @if($activeTab === 'entretiens')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Entretiens planifiés</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>N° Entretien</th>
                                                <th>Contrat</th>
                                                <th>Date prévue</th>
                                                <th>Véhicules</th>
                                                <th>Progression</th>
                                                <th>Coût prévu</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($entretiens as $entretien)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-primary-subtle text-primary">
                                                        #{{ $entretien->numero_entretien }}
                                                    </span>
                                                </td>
                                                <td>{{ $entretien->contrat->libelle }}</td>
                                                <td>{{ \Carbon\Carbon::parse($entretien->date_prevue)->format('d/m/Y') }}</td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-success">✓ {{ $entretien->nombre_vehicules_fait }} fait(s)</span>
                                                        <span class="text-muted">{{ $entretien->nombre_vehicules_restant }} restant(s)</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="progress" style="height: 20px;">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ ($entretien->nombre_vehicules_fait / $entretien->nombre_vehicules_total) * 100 }}%">
                                                            {{ round(($entretien->nombre_vehicules_fait / $entretien->nombre_vehicules_total) * 100) }}%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="fw-semibold">{{ number_format($entretien->cout_prevu) }} FCFA</td>
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
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-soft-secondary" type="button" data-bs-toggle="dropdown">
                                                            <i class="ri-more-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @if($entretien->status !== 'COMPLETED')
                                                            <li>
                                                                <button wire:click="openGererVehiculesModal({{ $entretien->id }})" class="dropdown-item">
                                                                    <i class="ri-list-check me-2"></i>Gérer les véhicules
                                                                </button>
                                                            </li>
                                                            @if($entretien->nombre_vehicules_fait === $entretien->nombre_vehicules_total)
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <button wire:click="openClotureEntretienModal({{ $entretien->id }})"
                                                                        class="dropdown-item text-success">
                                                                    <i class="ri-check-line me-2"></i>Clôturer l'entretien
                                                                </button>
                                                            </li>
                                                            @endif
                                                            @else
                                                            <li>
                                                                <button wire:click="voirDetailsEntretien({{ $entretien->id }})" class="dropdown-item">
                                                                    <i class="ri-eye-line me-2"></i>Voir détails
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
                                                        <i class="ri-tools-line fs-1 text-muted"></i>
                                                        <p class="text-muted mt-2">Aucun entretien planifié</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if($entretiens->hasPages())
                                <div class="mt-3">
                                    {{ $entretiens->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- ONGLET FACTURES -->
                @if($activeTab === 'factures')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Factures</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Référence</th>
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
                                            <tr>
                                                <td>
                                                    <span class="badge bg-secondary-subtle text-secondary">
                                                        {{ $facture->ref }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($facture->entretien)
                                                        Entretien #{{ $facture->entretien->numero_entretien }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') }}</td>
                                                <td class="fw-semibold">{{ number_format($facture->montant_ttc) }} FCFA</td>
                                                <td>
                                                    @if($facture->status_paiement === 'PAID')
                                                        <span class="badge bg-success">Payé</span>
                                                    @elseif($facture->status_paiement === 'PENDING')
                                                        <span class="badge bg-warning">En attente</span>
                                                    @elseif($facture->status_paiement === 'OVERDUE')
                                                        <span class="badge bg-danger">En retard</span>
                                                    @else
                                                        <span class="badge bg-dark">Annulé</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-soft-primary">
                                                        <i class="ri-download-line me-1"></i>PDF
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="py-4">
                                                        <i class="ri-bill-line fs-1 text-muted"></i>
                                                        <p class="text-muted mt-2">Aucune facture trouvée</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if($factures->hasPages())
                                <div class="mt-3">
                                    {{ $factures->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- MODALS -->
     @include('livewire.dashboard.entreprise.modals.edit-info')
    @include('livewire.dashboard.entreprise.modals.add-vehicule')
    @include('livewire.dashboard.entreprise.modals.edit-vehicule')
   @include('livewire.dashboard.entreprise.modals.vehicule-details')
    @include('livewire.dashboard.entreprise.modals.add-contrat')
    @include('livewire.dashboard.entreprise.modals.gerer-vehicules-entretien')
    @include('livewire.dashboard.entreprise.modals.cloture-entretien')
    @include('livewire.dashboard.entreprise.modals.contrat-details')
    @include('livewire.dashboard.entreprise.modals.edit-contrat')
</div>
