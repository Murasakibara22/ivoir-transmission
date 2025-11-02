<!-- Modal Détails Entretien -->
@if($showDetailsModal && $selectedEntretien)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">
                    <i class="ri-tools-line me-2"></i>Détails de l'entretien #{{ $selectedEntretien->numero_entretien }}
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
                                    <i class="ri-tools-line fs-1 text-info"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="mb-1">Entretien #{{ $selectedEntretien->numero_entretien }}</h4>
                                <p class="text-muted mb-2">
                                    <button wire:click="goToEntreprise({{ $selectedEntretien->entreprise_id }})"
                                            class="btn btn-link btn-sm p-0">
                                        <i class="ri-building-line me-1"></i>{{ $selectedEntretien->entreprise->name }}
                                    </button>
                                </p>
                                <span class="badge bg-secondary">{{ $selectedEntretien->contrat->libelle }}</span>
                            </div>
                            <div class="col-auto">
                                @if($selectedEntretien->status === 'COMPLETED')
                                    <span class="badge bg-success fs-6">Terminé</span>
                                @elseif($selectedEntretien->status === 'IN_PROGRESS')
                                    <span class="badge bg-info fs-6">En cours</span>
                                @elseif($selectedEntretien->status === 'PENDING')
                                    <span class="badge bg-warning fs-6">En attente</span>
                                @else
                                    <span class="badge bg-danger fs-6">Annulé</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card border-0 bg-primary-subtle">
                            <div class="card-body text-center">
                                <h3 class="mb-1 text-primary">{{ $selectedEntretien->nombre_vehicules_total }}</h3>
                                <p class="text-muted mb-0">Total véhicules</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 bg-success-subtle">
                            <div class="card-body text-center">
                                <h3 class="mb-1 text-success">{{ $selectedEntretien->nombre_vehicules_fait }}</h3>
                                <p class="text-muted mb-0">Véhicules faits</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 bg-warning-subtle">
                            <div class="card-body text-center">
                                <h3 class="mb-1 text-warning">{{ $selectedEntretien->nombre_vehicules_restant }}</h3>
                                <p class="text-muted mb-0">Véhicules restants</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progression -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Progression globale</span>
                        <span class="fw-semibold">
                            {{ round(($selectedEntretien->nombre_vehicules_fait / $selectedEntretien->nombre_vehicules_total) * 100) }}%
                        </span>
                    </div>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar bg-success" role="progressbar"
                             style="width: {{ ($selectedEntretien->nombre_vehicules_fait / $selectedEntretien->nombre_vehicules_total) * 100 }}%">
                            {{ $selectedEntretien->nombre_vehicules_fait }} / {{ $selectedEntretien->nombre_vehicules_total }}
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
                                            <td class="text-muted" width="50%">Date prévue</td>
                                            <td class="fw-semibold">{{ \Carbon\Carbon::parse($selectedEntretien->date_prevue)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Date réalisation</td>
                                            <td class="fw-semibold">
                                                @if($selectedEntretien->date_realisation)
                                                    {{ \Carbon\Carbon::parse($selectedEntretien->date_realisation)->format('d/m/Y') }}
                                                @else
                                                    <span class="text-muted">Non réalisé</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Coût prévu</td>
                                            <td class="fw-semibold text-primary">{{ number_format($selectedEntretien->cout_prevu) }} FCFA</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Coût final</td>
                                            <td class="fw-semibold">
                                                @if($selectedEntretien->cout_final)
                                                    {{ number_format($selectedEntretien->cout_final) }} FCFA
                                                @else
                                                    <span class="text-muted">Non défini</span>
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
                                <h6 class="mb-0"><i class="ri-file-list-line me-1"></i>Contrat lié</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" width="50%">Libellé</td>
                                            <td class="fw-semibold">{{ $selectedEntretien->contrat->libelle }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Fréquence</td>
                                            <td>
                                                <span class="badge bg-info-subtle text-info">
                                                    {{ $selectedEntretien->contrat->frequence_entretien }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Nombre véhicules</td>
                                            <td class="fw-semibold">{{ $selectedEntretien->contrat->nombre_vehicules }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Montant entretien</td>
                                            <td class="fw-semibold">{{ number_format($selectedEntretien->contrat->montant_entretien) }} FCFA</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commentaire -->
                @if($selectedEntretien->commentaire_cout)
                <div class="card border mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="ri-message-3-line me-1"></i>Commentaire</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">{{ $selectedEntretien->commentaire_cout }}</p>
                    </div>
                </div>
                @endif

                <!-- Liste des véhicules -->
                <div class="card border">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="ri-car-line me-1"></i>Véhicules de l'entretien</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Véhicule</th>
                                        <th>Immatriculation</th>
                                        <th>Marque</th>
                                        <th>Statut</th>
                                        @if($selectedEntretien->status !== 'COMPLETED')
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($selectedEntretien->historique_entretiens as $index => $historique)
                                    <tr class="{{ $historique->status === 'DONE' ? 'table-success' : '' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                    <i class="ri-car-line fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $historique->vehicule->libelle }}</h6>
                                                    <small class="text-muted">{{ $historique->vehicule->type ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary">
                                                {{ $historique->vehicule->matricule }}
                                            </span>
                                        </td>
                                        <td>{{ $historique->vehicule->marque }}</td>
                                        <td>
                                            @if($historique->status === 'DONE')
                                                <span class="badge bg-success">
                                                    <i class="ri-checkbox-circle-line me-1"></i>Terminé
                                                </span>
                                            @elseif($historique->status === 'IN_PROGRESS')
                                                <span class="badge bg-warning">
                                                    <i class="ri-time-line me-1"></i>En cours
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="ri-time-line me-1"></i>En attente
                                                </span>
                                            @endif
                                        </td>
                                        @if($selectedEntretien->status !== 'COMPLETED')
                                        <td>
                                            @if($historique->status !== 'DONE')
                                                <button wire:click="marquerVehiculeTermine({{ $historique->id }})"
                                                        class="btn btn-sm btn-success"
                                                        wire:loading.attr="disabled">
                                                    <i class="ri-check-line me-1"></i>Marquer fait
                                                </button>
                                            @else
                                                <span class="text-success">✓ Fait</span>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="ri-car-line fs-1 text-muted"></i>
                                            <p class="text-muted mb-0 mt-2">Aucun véhicule</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeDetailsModal" class="btn btn-light">
                    <i class="ri-close-line me-1"></i>Fermer
                </button>
                <button wire:click="goToEntreprise({{ $selectedEntretien->entreprise_id }})" class="btn btn-primary">
                    <i class="ri-building-line me-1"></i>Voir l'entreprise
                </button>
            </div>
        </div>
    </div>
</div>
@endif
