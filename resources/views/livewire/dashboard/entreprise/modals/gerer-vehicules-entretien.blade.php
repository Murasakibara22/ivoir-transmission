<!-- Modal Gérer Véhicules Entretien -->
@if($showGererVehiculesModal && $selectedEntretien)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">
                    <i class="ri-list-check me-2"></i>Gérer les véhicules - Entretien #{{ $selectedEntretien->numero_entretien }}
                </h5>
                <button type="button" wire:click="$set('showGererVehiculesModal', false)" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <!-- Entête info entretien -->
                <div class="card bg-light border-0 mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <h6 class="text-muted mb-1">Contrat</h6>
                                <p class="mb-0 fw-semibold">{{ $selectedEntretien->contrat->libelle }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted mb-1">Date prévue</h6>
                                <p class="mb-0 fw-semibold">
                                    {{ \Carbon\Carbon::parse($selectedEntretien->date_prevue)->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted mb-1">Coût prévu</h6>
                                <p class="mb-0 fw-semibold text-primary">
                                    {{ number_format($selectedEntretien->cout_prevu) }} FCFA
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats progression -->
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

                <!-- Barre de progression globale -->
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

                <!-- Alert si tous terminés -->
                @if($selectedEntretien->nombre_vehicules_fait === $selectedEntretien->nombre_vehicules_total)
                <div class="alert alert-success border-0 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="ri-checkbox-circle-line fs-4 me-2"></i>
                        <div>
                            <strong>Tous les véhicules ont été traités !</strong>
                            <p class="mb-0 mt-1">Vous pouvez maintenant clôturer cet entretien et générer la facture.</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Liste des véhicules -->
                <div class="card border">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="ri-car-line me-1"></i>
                            Liste des véhicules à entretenir
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th>Véhicule</th>
                                        <th>Immatriculation</th>
                                        <th>Marque/Modèle</th>
                                        <th>Kilométrage</th>
                                        <th>Statut</th>
                                        <th style="width: 150px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $historiques = \App\Models\HistoriqueEntretient::where('entretien_id', $selectedEntretien->id)
                                            ->with('vehicule')
                                            ->get();
                                    @endphp

                                    @forelse($historiques as $index => $historique)
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
                                        <td>
                                            {{ $historique->vehicule->marque }}
                                            {{ $historique->vehicule->modele ? '- ' . $historique->vehicule->modele : '' }}
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ number_format($historique->vehicule->kilometrage_actuel) }} km
                                            </span>
                                        </td>
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
                                        <td>
                                            @if($historique->status !== 'DONE')
                                                <button wire:click="marquerVehiculeTermine({{ $historique->id }})"
                                                        class="btn btn-sm btn-success"
                                                        wire:loading.attr="disabled"
                                                        wire:target="marquerVehiculeTermine({{ $historique->id }})">
                                                    <span wire:loading.remove wire:target="marquerVehiculeTermine({{ $historique->id }})">
                                                        <i class="ri-check-line me-1"></i>Marquer fait
                                                    </span>
                                                    <span wire:loading wire:target="marquerVehiculeTermine({{ $historique->id }})">
                                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                                    </span>
                                                </button>
                                            @else
                                                <button wire:click="annulerVehiculeTermine({{ $historique->id }})"
                                                        class="btn btn-sm btn-outline-danger"
                                                        wire:loading.attr="disabled"
                                                        wire:target="annulerVehiculeTermine({{ $historique->id }})">
                                                    <i class="ri-close-line me-1"></i>Annuler
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="ri-car-line fs-1 text-muted"></i>
                                            <p class="text-muted mb-0 mt-2">Aucun véhicule trouvé pour cet entretien</p>
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
                <button type="button" wire:click="$set('showGererVehiculesModal', false)" class="btn btn-light">
                    <i class="ri-close-line me-1"></i>Fermer
                </button>
                @if($selectedEntretien->nombre_vehicules_fait === $selectedEntretien->nombre_vehicules_total)
                <button wire:click="openClotureEntretienModal({{ $selectedEntretien->id }})"
                        class="btn btn-success">
                    <i class="ri-check-double-line me-1"></i>Clôturer l'entretien
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
