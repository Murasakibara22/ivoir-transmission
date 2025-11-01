<!-- Modal Add Contrat -->
@if($showAddContratModal)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="max-height: 90vh; display: flex; flex-direction: column;">
            <div class="modal-header bg-success-subtle" style="flex-shrink: 0;">
                <h5 class="modal-title">
                    <i class="ri-file-list-3-line me-2"></i>Créer un contrat de maintenance
                </h5>
                <button type="button" wire:click="$set('showAddContratModal', false)" class="btn-close"></button>
            </div>
            <form wire:submit.prevent="saveContrat" style="display: flex; flex-direction: column; flex: 1; overflow: hidden;">
                <div class="modal-body" style="overflow-y: auto; flex: 1; max-height: calc(90vh - 160px);">
                    <!-- Alert info -->
                    <div class="alert alert-success border-0 mb-4">
                        <div class="d-flex align-items-start">
                            <i class="ri-information-line fs-4 me-2"></i>
                            <div>
                                <strong>Information importante :</strong>
                                <p class="mb-0 mt-1">Une fois le contrat activé, le premier entretien sera automatiquement créé à la date du premier entretien.
                                Des historiques d'entretien seront générés pour chaque véhicule concerné.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Section Informations générales -->
                        <div class="col-12 mb-3">
                            <h6 class="text-success mb-3 border-bottom pb-2">
                                <i class="ri-information-line me-1"></i>Informations générales
                            </h6>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Libellé du contrat <span class="text-danger">*</span>
                            </label>
                            <input type="text" wire:model="contrat_libelle"
                                   class="form-control @error('contrat_libelle') is-invalid @enderror"
                                   placeholder="Ex: Contrat maintenance annuelle 2025">
                            @error('contrat_libelle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Nombre de véhicules <span class="text-danger">*</span>
                            </label>
                            <input type="number" wire:model="contrat_nombre_vehicules"
                                   class="form-control @error('contrat_nombre_vehicules') is-invalid @enderror"
                                   min="1" max="{{ $entreprise->vehicules->count() }}"
                                   placeholder="Ex: 5">
                            <small class="text-muted">
                                Maximum : {{ $entreprise->vehicules->count() }} véhicule(s) disponible(s)
                            </small>
                            @error('contrat_nombre_vehicules')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea wire:model="contrat_description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Détails du contrat, services inclus, etc."></textarea>
                        </div>

                        <!-- Section Planification -->
                        <div class="col-12 mt-3 mb-3">
                            <h6 class="text-success mb-3 border-bottom pb-2">
                                <i class="ri-calendar-line me-1"></i>Planification des entretiens
                            </h6>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Fréquence des entretiens <span class="text-danger">*</span>
                            </label>
                            <select wire:model="contrat_frequence_entretien"
                                    class="form-select @error('contrat_frequence_entretien') is-invalid @enderror">
                                <option value="">Sélectionner une fréquence</option>
                                <option value="MENSUEL">Mensuel (chaque mois)</option>
                                <option value="TRIMESTRIEL">Trimestriel (tous les 3 mois)</option>
                                <option value="SEMESTRIEL">Semestriel (tous les 6 mois)</option>
                                <option value="ANNUEL">Annuel (chaque année)</option>
                            </select>
                            @error('contrat_frequence_entretien')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Durée du contrat (en mois) <span class="text-danger">*</span>
                            </label>
                            <input type="number" wire:model="contrat_duree_contrat_mois"
                                   class="form-control @error('contrat_duree_contrat_mois') is-invalid @enderror"
                                   min="1" max="60"
                                   placeholder="Ex: 12">
                            <small class="text-muted">Entre 1 et 60 mois (5 ans maximum)</small>
                            @error('contrat_duree_contrat_mois')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Date de début du contrat <span class="text-danger">*</span>
                            </label>
                            <input type="date" wire:model="contrat_date_debut"
                                   class="form-control @error('contrat_date_debut') is-invalid @enderror"
                                   min="{{ now()->format('Y-m-d') }}">
                            @error('contrat_date_debut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Date du premier entretien <span class="text-danger">*</span>
                            </label>
                            <input type="date" wire:model="contrat_date_premier_entretien"
                                   class="form-control @error('contrat_date_premier_entretien') is-invalid @enderror"
                                   min="{{ now()->format('Y-m-d') }}">
                            @error('contrat_date_premier_entretien')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Section Tarification -->
                        <div class="col-12 mt-3 mb-3">
                            <h6 class="text-success mb-3 border-bottom pb-2">
                                <i class="ri-money-dollar-circle-line me-1"></i>Tarification
                            </h6>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Montant par entretien (FCFA) <span class="text-danger">*</span>
                            </label>
                            <input type="number" wire:model="contrat_montant_entretien"
                                   class="form-control @error('contrat_montant_entretien') is-invalid @enderror"
                                   min="0" step="1000"
                                   placeholder="Ex: 150000">
                            <small class="text-muted">Coût fixe pour chaque entretien planifié</small>
                            @error('contrat_montant_entretien')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Récapitulatif -->
                        @if($contrat_duree_contrat_mois && $contrat_frequence_entretien && $contrat_montant_entretien)
                        <div class="col-12 mt-3">
                            <div class="alert alert-info border-0">
                                <h6 class="alert-heading">
                                    <i class="ri-calculator-line me-1"></i>Récapitulatif du contrat
                                </h6>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Nombre d'entretiens prévus :</p>
                                        <h5 class="mb-0">
                                            @php
                                                $nbEntretiens = 0;
                                                switch($contrat_frequence_entretien) {
                                                    case 'MENSUEL':
                                                        $nbEntretiens = $contrat_duree_contrat_mois;
                                                        break;
                                                    case 'TRIMESTRIEL':
                                                        $nbEntretiens = ceil($contrat_duree_contrat_mois / 3);
                                                        break;
                                                    case 'SEMESTRIEL':
                                                        $nbEntretiens = ceil($contrat_duree_contrat_mois / 6);
                                                        break;
                                                    case 'ANNUEL':
                                                        $nbEntretiens = ceil($contrat_duree_contrat_mois / 12);
                                                        break;
                                                }
                                            @endphp
                                            {{ $nbEntretiens }} entretien(s)
                                        </h5>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Coût total estimé :</p>
                                        <h5 class="mb-0 text-primary">
                                            {{ number_format($nbEntretiens * $contrat_montant_entretien) }} FCFA
                                        </h5>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Date de fin :</p>
                                        <h5 class="mb-0">
                                            @if($contrat_date_debut)
                                                {{ \Carbon\Carbon::parse($contrat_date_debut)->addMonths($contrat_duree_contrat_mois)->format('d/m/Y') }}
                                            @else
                                                -
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer" style="flex-shrink: 0; border-top: 1px solid #dee2e6; background-color: #fff;">
                    <button type="button" wire:click="$set('showAddContratModal', false)" class="btn btn-light">
                        <i class="ri-close-line me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="saveContrat">
                            <i class="ri-save-line me-1"></i>Créer le contrat
                        </span>
                        <span wire:loading wire:target="saveContrat">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                            Création...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom scrollbar style -->
<style>
    .modal-body::-webkit-scrollbar {
        width: 8px;
    }
    .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .modal-body::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    .modal-body::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endif
