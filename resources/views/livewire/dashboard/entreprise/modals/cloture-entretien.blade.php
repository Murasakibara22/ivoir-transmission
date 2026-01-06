<!-- Modal Clôture Entretien -->
@if($showClotureEntretienModal && $selectedEntretien)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success-subtle">
                <h5 class="modal-title">
                    <i class="ri-checkbox-circle-line me-2"></i>Clôturer l'entretien
                </h5>
                <button type="button" wire:click="$set('showClotureEntretienModal', false)" class="btn-close"></button>
            </div>
            <form wire:submit.prevent="cloturerEntretien">
                <div class="modal-body">
                    <!-- Alert info -->
                    <div class="alert alert-success border-0 mb-4">
                        <div class="d-flex align-items-start">
                            <i class="ri-information-line fs-4 me-2"></i>
                            <div>
                                <strong>Clôture de l'entretien #{{ $selectedEntretien->numero_entretien }}</strong>
                                <p class="mb-0 mt-2">
                                    Tous les véhicules ont été traités. En validant cette clôture :
                                </p>
                                <ul class="mb-0 mt-2">
                                    <li>Une facture sera automatiquement générée</li>
                                    <li>Le prochain entretien sera planifié selon la fréquence du contrat</li>
                                    <li>L'entreprise sera notifiée</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Récapitulatif -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <h6 class="text-muted mb-3">Contrat</h6>
                                    <p class="mb-1 fw-semibold">{{ $selectedEntretien->contrat->libelle }}</p>
                                    <small class="text-muted">
                                        Fréquence : {{ $selectedEntretien->contrat->frequence_entretien }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <h6 class="text-muted mb-3">Date de l'entretien</h6>
                                    <p class="mb-0 fw-semibold">
                                        {{ \Carbon\Carbon::parse($selectedEntretien->date_prevue)->format('d F Y') }}
                                    </p>
                                    <small class="text-muted">
                                        Il y a {{ \Carbon\Carbon::parse($selectedEntretien->date_prevue)->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats véhicules -->
                    <div class="card border mb-4">
                        <div class="card-body">
                            <h6 class="mb-3">Progression des véhicules</h6>
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="p-3 bg-light rounded">
                                        <h3 class="mb-1 text-primary">{{ $selectedEntretien->nombre_vehicules_total }}</h3>
                                        <p class="text-muted mb-0 small">Total</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 bg-success-subtle rounded">
                                        <h3 class="mb-1 text-success">{{ $selectedEntretien->nombre_vehicules_fait }}</h3>
                                        <p class="text-muted mb-0 small">Fait(s)</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 bg-warning-subtle rounded">
                                        <h3 class="mb-1 text-warning">{{ $selectedEntretien->nombre_vehicules_restant }}</h3>
                                        <p class="text-muted mb-0 small">Restant(s)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height: 25px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                     style="width: {{ ($selectedEntretien->nombre_vehicules_fait / $selectedEntretien->nombre_vehicules_total) * 100 }}%">
                                    {{ round(($selectedEntretien->nombre_vehicules_fait / $selectedEntretien->nombre_vehicules_total) * 100) }}%
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coût -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Coût prévu initialement</label>
                            <div class="input-group">
                                <input type="text" class="form-control bg-light"
                                       value="{{ number_format($selectedEntretien->cout_prevu) }}"
                                       readonly>
                                <span class="input-group-text bg-light">FCFA</span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Coût final <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" wire:model="entretien_cout_final"
                                       class="form-control @error('entretien_cout_final') is-invalid @enderror"
                                       min="0" step="1000"
                                       placeholder="Montant final">
                                <span class="input-group-text">FCFA</span>
                            </div>
                            @error('entretien_cout_final')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Différence de coût -->
                    @if($entretien_cout_final && $entretien_cout_final != $selectedEntretien->cout_prevu)
                    <div class="alert alert-warning border-0 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="ri-error-warning-line fs-4 me-2"></i>
                            <div class="flex-grow-1">
                                <strong>Différence détectée :</strong>
                                @php
                                    $difference = $entretien_cout_final - $selectedEntretien->cout_prevu;
                                @endphp
                                @if($difference > 0)
                                    <span class="text-danger">
                                        +{{ number_format(abs($difference)) }} FCFA de plus que prévu
                                    </span>
                                @else
                                    <span class="text-success">
                                        -{{ number_format(abs($difference)) }} FCFA de moins que prévu
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Commentaire -->
                    <div class="mb-3">
                        <label class="form-label">
                            Commentaire / Justification
                            @if($entretien_cout_final && $entretien_cout_final != $selectedEntretien->cout_prevu)
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <textarea wire:model="entretien_commentaire"
                                  class="form-control @error('entretien_commentaire') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Expliquez les travaux effectués, les pièces changées, ou la raison de la différence de coût..."></textarea>
                        @error('entretien_commentaire')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Résumé facture -->
                    @if($entretien_cout_final)
                    <div class="card bg-primary-subtle border-0">
                        <div class="card-body">
                            <h6 class="mb-3">
                                <i class="ri-file-list-line me-1"></i>Facture qui sera générée
                            </h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 text-muted">Montant HT</p>
                                    <h5 class="mb-0">{{ number_format($entretien_cout_final) }} FCFA</h5>
                                </div>
                                <div class="text-end">
                                    <p class="mb-1 text-muted">Échéance</p>
                                    <h6 class="mb-0">{{ now()->addDays(30)->format('d/m/Y') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="$set('showClotureEntretienModal', false)" class="btn btn-light">
                        <i class="ri-close-line me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="cloturerEntretien">
                            <i class="ri-check-line me-1"></i>Valider la clôture
                        </span>
                        <span wire:loading wire:target="cloturerEntretien">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                            Validation...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
