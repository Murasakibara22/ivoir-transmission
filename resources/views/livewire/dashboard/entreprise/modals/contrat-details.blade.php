{{-- resources/views/livewire/dashboard/entreprise/modals/contrat-details.blade.php --}}
@if($showContratDetailsModal && $selectedContrat)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary-subtle">
                <h5 class="modal-title">
                    <i class="ri-file-list-3-line me-2"></i>Détails du contrat
                </h5>
                <button type="button" wire:click="closeContratDetailsModal" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <!-- Header Info -->
                <div class="card border border-primary mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="mb-2">{{ $selectedContrat->libelle }}</h4>
                                @if($selectedContrat->description)
                                <p class="text-muted mb-0">{{ $selectedContrat->description }}</p>
                                @endif
                            </div>
                            <div class="col-md-4 text-end">
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

                <div class="row">
                    <!-- Informations générales -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="ri-information-line me-1"></i>Informations générales
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="text-muted small">Fréquence d'entretien</label>
                                    <p class="fw-semibold mb-0">
                                        <span class="badge bg-info-subtle text-info">
                                            {{ $selectedContrat->frequence_entretien }}
                                        </span>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small">Durée du contrat</label>
                                    <p class="fw-semibold mb-0">{{ $selectedContrat->duree_contrat_mois }} mois</p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small">Nombre de véhicules</label>
                                    <p class="fw-semibold mb-0">{{ $selectedContrat->nombre_vehicules }} véhicule(s)</p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small">Montant par entretien</label>
                                    <p class="fw-semibold mb-0 text-primary fs-5">
                                        {{ number_format($selectedContrat->montant_entretien) }} FCFA
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dates -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="ri-calendar-line me-1"></i>Dates importantes
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="text-muted small">Date de début</label>
                                    <p class="fw-semibold mb-0">
                                        {{ \Carbon\Carbon::parse($selectedContrat->date_debut)->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small">Date de fin</label>
                                    <p class="fw-semibold mb-0">
                                        {{ \Carbon\Carbon::parse($selectedContrat->date_fin)->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small">Premier entretien</label>
                                    <p class="fw-semibold mb-0">
                                        {{ \Carbon\Carbon::parse($selectedContrat->date_premier_entretien)->format('d/m/Y') }}
                                    </p>
                                </div>
                                @if($selectedContrat->garage_validated_at)
                                <div class="mb-0">
                                    <label class="text-muted small">Date d'activation</label>
                                    <p class="fw-semibold mb-0 text-success">
                                        {{ \Carbon\Carbon::parse($selectedContrat->garage_validated_at)->format('d/m/Y à H:i') }}
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Entretiens -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="ri-list-check me-1"></i>Historique des entretiens
                                    <span class="badge bg-primary ms-2">{{ $selectedContrat->entretiens->count() }}</span>
                                </h6>
                            </div>
                            <div class="card-body">
                                @if($selectedContrat->entretiens->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>N°</th>
                                                <th>Date prévue</th>
                                                <th>Progression</th>
                                                <th>Coût</th>
                                                <th>Statut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($selectedContrat->entretiens as $entretien)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-primary-subtle text-primary">
                                                        #{{ $entretien->numero_entretien }}
                                                    </span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($entretien->date_prevue)->format('d/m/Y') }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="progress flex-grow-1" style="height: 20px;">
                                                            <div class="progress-bar" style="width: {{ ($entretien->nombre_vehicules_fait / $entretien->nombre_vehicules_total) * 100 }}%">
                                                                {{ $entretien->nombre_vehicules_fait }}/{{ $entretien->nombre_vehicules_total }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-semibold">{{ number_format($entretien->cout_final ?? $entretien->cout_prevu) }} F</span>
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="text-center py-4">
                                    <i class="ri-tools-line fs-1 text-muted"></i>
                                    <p class="text-muted mt-2">Aucun entretien planifié</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Factures -->
                    @if($selectedContrat->factures && $selectedContrat->factures->count() > 0)
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="ri-bill-line me-1"></i>Factures liées
                                    <span class="badge bg-warning ms-2">{{ $selectedContrat->factures->count() }}</span>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Référence</th>
                                                <th>Date émission</th>
                                                <th>Montant TTC</th>
                                                <th>Statut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($selectedContrat->factures as $facture)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-secondary-subtle text-secondary">
                                                        {{ $facture->ref }}
                                                    </span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}</td>
                                                <td class="fw-semibold">{{ number_format($facture->montant_ttc) }} FCFA</td>
                                                <td>
                                                    @if($facture->status_paiement === 'PAID')
                                                        <span class="badge bg-success">Payé</span>
                                                    @elseif($facture->status_paiement === 'PENDING')
                                                        <span class="badge bg-warning">En attente</span>
                                                    @else
                                                        <span class="badge bg-danger">En retard</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                @if($selectedContrat->status === 'PENDING')
                <button type="button" wire:click="activerContrat({{ $selectedContrat->id }})" class="btn btn-success">
                    <i class="ri-check-line me-1"></i>Activer le contrat
                </button>
                @endif
                <button type="button" wire:click="openEditContratModal({{ $selectedContrat->id }})" class="btn btn-primary">
                    <i class="ri-edit-line me-1"></i>Modifier
                </button>
                <button type="button" wire:click="closeContratDetailsModal" class="btn btn-light">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>
@endif
