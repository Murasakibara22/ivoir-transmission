<!-- Modal Détails Véhicule -->
@if($showDetailsModal && $selectedVehicule)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary-subtle">
                <h5 class="modal-title">
                    <i class="ri-car-line me-2"></i>Détails du véhicule
                </h5>
                <button type="button" wire:click="closeDetailsModal" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <!-- Header -->
                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="avatar-lg bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm">
                                    <i class="ri-car-line fs-1 text-primary"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="mb-1">{{ $selectedVehicule->libelle }}</h4>
                                <p class="text-muted mb-2">
                                    <span class="badge bg-primary me-2">{{ $selectedVehicule->matricule }}</span>
                                    <span class="badge bg-secondary">{{ $selectedVehicule->chassis }}</span>
                                </p>
                                <button wire:click="goToEntreprise({{ $selectedVehicule->entreprise_id }})"
                                        class="btn btn-sm btn-soft-info">
                                    <i class="ri-building-line me-1"></i>{{ $selectedVehicule->entreprise->name }}
                                </button>
                            </div>
                            <div class="col-auto">
                                @if($selectedVehicule->status === 'ACTIVATED')
                                    <span class="badge bg-success fs-6">Actif</span>
                                @else
                                    <span class="badge bg-danger fs-6">Inactif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card border h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="ri-information-line me-1"></i>Informations générales</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" width="40%">Type</td>
                                            <td class="fw-semibold">{{ $selectedVehicule->type ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Marque</td>
                                            <td class="fw-semibold">{{ $selectedVehicule->marque }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Modèle</td>
                                            <td class="fw-semibold">{{ $selectedVehicule->modele ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Année</td>
                                            <td class="fw-semibold">{{ $selectedVehicule->year ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Carburant</td>
                                            <td>
                                                @if($selectedVehicule->carburant)
                                                    <span class="badge bg-success-subtle text-success">{{ $selectedVehicule->carburant }}</span>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Couleur</td>
                                            <td class="fw-semibold">{{ $selectedVehicule->couleur ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card border h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="ri-dashboard-line me-1"></i>Kilométrage & Entretien</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" width="50%">Kilométrage actuel</td>
                                            <td class="fw-semibold text-primary fs-5">
                                                {{ number_format($selectedVehicule->kilometrage_actuel) }} km
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Prochaine visite</td>
                                            <td>
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
                                                {{ $selectedVehicule->cout_vidange_estime ? number_format($selectedVehicule->cout_vidange_estime) . ' FCFA' : 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Nombre d'entretiens</td>
                                            <td>
                                                <span class="badge bg-info fs-6">{{ $selectedVehicule->historique_entretiens->count() }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Historique -->
                <div class="card border">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="ri-history-line me-1"></i>Historique des entretiens</h6>
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
                                            @if($historique->status === 'DONE')
                                                <span class="badge bg-success-subtle text-success">Terminé</span>
                                            @elseif($historique->status === 'IN_PROGRESS')
                                                <span class="badge bg-warning-subtle text-warning">En cours</span>
                                            @else
                                                <span class="badge bg-info-subtle text-info">En attente</span>
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
                            <p class="text-muted mb-0 mt-2">Aucun historique d'entretien</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeDetailsModal" class="btn btn-light">
                    <i class="ri-close-line me-1"></i>Fermer
                </button>
                <button wire:click="goToEntreprise({{ $selectedVehicule->entreprise_id }})" class="btn btn-primary">
                    <i class="ri-building-line me-1"></i>Voir l'entreprise
                </button>
            </div>
        </div>
    </div>
</div>
@endif

