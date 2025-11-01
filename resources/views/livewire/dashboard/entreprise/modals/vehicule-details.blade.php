<!-- Modal Détails Véhicule -->
@if($showVehiculeDetailsModal && $selectedVehicule)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">
                    <i class="ri-car-line me-2"></i>Détails du véhicule
                </h5>
                <button type="button" wire:click="$set('showVehiculeDetailsModal', false)" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <!-- Header véhicule -->
                <div class="card border-0 bg-primary-subtle mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="avatar-lg bg-white rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-car-line fs-1 text-primary"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="mb-1">{{ $selectedVehicule->libelle }}</h4>
                                <p class="text-muted mb-2">
                                    <span class="badge bg-primary me-2">{{ $selectedVehicule->matricule }}</span>
                                    <span class="badge bg-secondary">{{ $selectedVehicule->chassis }}</span>
                                </p>
                                <div class="d-flex gap-2">
                                    @if($selectedVehicule->marque)
                                        <span class="badge bg-info-subtle text-info">{{ $selectedVehicule->marque }}</span>
                                    @endif
                                    @if($selectedVehicule->modele)
                                        <span class="badge bg-info-subtle text-info">{{ $selectedVehicule->modele }}</span>
                                    @endif
                                    @if($selectedVehicule->year)
                                        <span class="badge bg-info-subtle text-info">{{ $selectedVehicule->year }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <button wire:click="openEditVehiculeModal({{ $selectedVehicule->id }})"
                                        class="btn btn-warning btn-sm">
                                    <i class="ri-edit-line me-1"></i>Modifier
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations principales -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card border mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="ri-information-line me-1 text-primary"></i>
                                    Informations générales
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="text-muted" width="40%">Type de véhicule</td>
                                                <td class="fw-semibold">{{ $selectedVehicule->type ?? 'Non défini' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Carburant</td>
                                                <td class="fw-semibold">
                                                    @if($selectedVehicule->carburant)
                                                        <span class="badge bg-success-subtle text-success">
                                                            {{ $selectedVehicule->carburant }}
                                                        </span>
                                                    @else
                                                        Non défini
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Couleur</td>
                                                <td class="fw-semibold">{{ $selectedVehicule->couleur ?? 'Non définie' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Date mise en circulation</td>
                                                <td class="fw-semibold">
                                                    {{ $selectedVehicule->date_mise_circulation ? \Carbon\Carbon::parse($selectedVehicule->date_mise_circulation)->format('d/m/Y') : 'Non définie' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Statut</td>
                                                <td>
                                                    @if($selectedVehicule->status === 'ACTIVATED')
                                                        <span class="badge bg-success">Actif</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactif</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card border mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="ri-dashboard-line me-1 text-warning"></i>
                                    Kilométrage & Entretien
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="text-muted" width="50%">Kilométrage actuel</td>
                                                <td class="fw-semibold text-primary fs-5">
                                                    {{ number_format($selectedVehicule->kilometrage_actuel) }} km
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Prochaine visite</td>
                                                <td class="fw-semibold">
                                                    @if($selectedVehicule->date_prochaine_visite)
                                                        <span class="badge bg-warning-subtle text-warning">
                                                            {{ \Carbon\Carbon::parse($selectedVehicule->date_prochaine_visite)->format('d/m/Y') }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">Non définie</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Coût vidange estimé</td>
                                                <td class="fw-semibold">
                                                    {{ $selectedVehicule->cout_vidange_estime ? number_format($selectedVehicule->cout_vidange_estime) . ' FCFA' : 'Non défini' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Nombre d'entretiens</td>
                                                <td>
                                                    <span class="badge bg-info fs-6">
                                                        {{ $selectedVehicule->historique_entretiens->count() }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($selectedVehicule->description)
                <div class="card border mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="ri-file-text-line me-1 text-info"></i>
                            Description
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">{{ $selectedVehicule->description }}</p>
                    </div>
                </div>
                @endif

                <!-- Historique des entretiens -->
                <div class="card border">
                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">
                            <i class="ri-tools-line me-1 text-success"></i>
                            Historique des entretiens
                        </h6>
                        <span class="badge bg-success">{{ $selectedVehicule->historique_entretiens->count() }}</span>
                    </div>
                    <div class="card-body">
                        @if($selectedVehicule->historique_entretiens->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Kilométrage</th>
                                            <th>Coût</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($selectedVehicule->historique_entretiens->sortByDesc('date_entretient')->take(10) as $historique)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($historique->date_entretient)->format('d/m/Y') }}</td>
                                            <td>{{ $historique->type_entretient }}</td>
                                            <td>
                                                @if($historique->kilometrage_intervention)
                                                    {{ number_format($historique->kilometrage_intervention) }} km
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($historique->cout_pieces || $historique->cout_main_oeuvre)
                                                    {{ number_format(($historique->cout_pieces ?? 0) + ($historique->cout_main_oeuvre ?? 0)) }} FCFA
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($historique->status === 'DONE')
                                                    <span class="badge bg-success-subtle text-success">Terminé</span>
                                                @elseif($historique->status === 'IN_PROGRESS')
                                                    <span class="badge bg-warning-subtle text-warning">En cours</span>
                                                @elseif($historique->status === 'PENDING')
                                                    <span class="badge bg-info-subtle text-info">En attente</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger">Annulé</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="ri-tools-line fs-1 text-muted"></i>
                                <p class="text-muted mb-0 mt-2">Aucun historique d'entretien pour ce véhicule</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="$set('showVehiculeDetailsModal', false)" class="btn btn-light">
                    <i class="ri-close-line me-1"></i>Fermer
                </button>
                <button wire:click="openEditVehiculeModal({{ $selectedVehicule->id }})" class="btn btn-warning">
                    <i class="ri-edit-line me-1"></i>Modifier
                </button>
            </div>
        </div>
    </div>
</div>
@endif
