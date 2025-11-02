<!-- Modal Détails Contrat -->
@if($showDetailsModal && $selectedContrat)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success-subtle">
                <h5 class="modal-title">
                    <i class="ri-file-list-3-line me-2"></i>Détails du contrat
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
                                    <i class="ri-file-list-3-line fs-1 text-success"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="mb-1">{{ $selectedContrat->libelle }}</h4>
                                <p class="text-muted mb-2">
                                    @if($selectedContrat->description)
                                        {{ $selectedContrat->description }}
                                    @endif
                                </p>
                                <button wire:click="goToEntreprise({{ $selectedContrat->entreprise_id }})"
                                        class="btn btn-sm btn-soft-info">
                                    <i class="ri-building-line me-1"></i>{{ $selectedContrat->entreprise->name }}
                                </button>
                            </div>
                            <div class="col-auto">
                                @if($selectedContrat->status === 'ACTIVE')
                                    <span class="badge bg-success fs-6">Actif</span>
                                @elseif($selectedContrat->status === 'PENDING')
                                    <span class="badge bg-warning fs-6">En attente</span>
                                @elseif($selectedContrat->status === 'EXPIRED')
                                    <span class="badge bg-danger fs-6">Expiré</span>
                                @else
                                    <span class="badge bg-secondary fs-6">{{ $selectedContrat->status }}</span>
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
                                <h6 class="mb-0"><i class="ri-information-line me-1"></i>Informations du contrat</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" width="50%">Fréquence entretien</td>
                                            <td>
                                                <span class="badge bg-info-subtle text-info">
                                                    {{ $selectedContrat->frequence_entretien }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Durée du contrat</td>
                                            <td class="fw-semibold">{{ $selectedContrat->duree_contrat_mois }} mois</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Date de début</td>
                                            <td class="fw-semibold">{{ \Carbon\Carbon::parse($selectedContrat->date_debut)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Date de fin</td>
                                            <td class="fw-semibold">{{ \Carbon\Carbon::parse($selectedContrat->date_fin)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Premier entretien</td>
                                            <td class="fw-semibold">{{ \Carbon\Carbon::parse($selectedContrat->date_premier_entretien)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Validation garage</td>
                                            <td>
                                                @if($selectedContrat->garage_validated_at)
                                                    <span class="badge bg-success-subtle text-success">
                                                        {{ \Carbon\Carbon::parse($selectedContrat->garage_validated_at)->format('d/m/Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">Non validé</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card border h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="ri-money-dollar-circle-line me-1"></i>Tarification</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" width="50%">Nombre de véhicules</td>
                                            <td>
                                                <span class="badge bg-primary fs-6">{{ $selectedContrat->nombre_vehicules }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Montant par entretien</td>
                                            <td class="fw-semibold text-primary fs-5">
                                                {{ number_format($selectedContrat->montant_entretien) }} FCFA
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Nombre d'entretiens prévus</td>
                                            <td class="fw-semibold">
                                                @php
                                                    $nbEntretiens = 0;
                                                    switch($selectedContrat->frequence_entretien) {
                                                        case 'MENSUEL':
                                                            $nbEntretiens = $selectedContrat->duree_contrat_mois;
                                                            break;
                                                        case 'TRIMESTRIEL':
                                                            $nbEntretiens = ceil($selectedContrat->duree_contrat_mois / 3);
                                                            break;
                                                        case 'SEMESTRIEL':
                                                            $nbEntretiens = ceil($selectedContrat->duree_contrat_mois / 6);
                                                            break;
                                                        case 'ANNUEL':
                                                            $nbEntretiens = ceil($selectedContrat->duree_contrat_mois / 12);
                                                            break;
                                                    }
                                                @endphp
                                                {{ $nbEntretiens }} entretiens
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Coût total estimé</td>
                                            <td class="fw-bold text-success fs-5">
                                                {{ number_format($nbEntretiens * $selectedContrat->montant_entretien) }} FCFA
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Entretiens du contrat -->
                <div class="card border">
                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                        <h6 class="mb-0"><i class="ri-tools-line me-1"></i>Entretiens du contrat</h6>
                        <span class="badge bg-primary">{{ $selectedContrat->entretiens->count() }}</span>
                    </div>
                    <div class="card-body">
                        @if($selectedContrat->entretiens->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>N°</th>
                                        <th>Date prévue</th>
                                        <th>Véhicules</th>
                                        <th>Coût prévu</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($selectedContrat->entretiens->sortBy('date_prevue') as $entretien)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary">
                                                #{{ $entretien->numero_entretien }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($entretien->date_prevue)->format('d/m/Y') }}</td>
                                        <td>
                                            <small class="text-success">✓ {{ $entretien->nombre_vehicules_fait }}</small> /
                                            <small class="text-muted">{{ $entretien->nombre_vehicules_total }}</small>
                                        </td>
                                        <td class="fw-semibold">{{ number_format($entretien->cout_prevu) }} FCFA</td>
                                        <td>
                                            @if($entretien->status === 'COMPLETED')
                                                <span class="badge bg-success-subtle text-success">Terminé</span>
                                            @elseif($entretien->status === 'IN_PROGRESS')
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
                            <p class="text-muted mb-0 mt-2">Aucun entretien planifié</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeDetailsModal" class="btn btn-light">
                    <i class="ri-close-line me-1"></i>Fermer
                </button>
                @if($selectedContrat->status === 'PENDING')
                <button wire:click="activerContrat({{ $selectedContrat->id }})" class="btn btn-success">
                    <i class="ri-check-line me-1"></i>Activer le contrat
                </button>
                @endif
                <button wire:click="goToEntreprise({{ $selectedContrat->entreprise_id }})" class="btn btn-primary">
                    <i class="ri-building-line me-1"></i>Voir l'entreprise
                </button>
            </div>
        </div>
    </div>
</div>
@endif
