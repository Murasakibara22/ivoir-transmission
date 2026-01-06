{{-- resources/views/livewire/dashboard/entreprise/modals/edit-contrat.blade.php --}}
@if($showEditContratModal && $selectedContrat)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="max-height: 90vh; display: flex; flex-direction: column;">
            <div class="modal-header bg-primary-subtle">
                <h5 class="modal-title">
                    <i class="ri-edit-line me-2"></i>Modifier le contrat
                </h5>
                <button type="button" wire:click="closeEditContratModal" class="btn-close"></button>
            </div>
            <form wire:submit.prevent="updateContrat" style="display: flex; flex-direction: column; flex: 1; overflow: hidden;">
                <div class="modal-body" style="overflow-y: auto; flex: 1;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Libellé <span class="text-danger">*</span></label>
                            <input type="text" wire:model="contrat_libelle"
                                   class="form-control @error('contrat_libelle') is-invalid @enderror">
                            @error('contrat_libelle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre de véhicules <span class="text-danger">*</span></label>
                            <input type="number" wire:model="contrat_nombre_vehicules"
                                   class="form-control @error('contrat_nombre_vehicules') is-invalid @enderror"
                                   min="1" max="{{ $entreprise->vehicules->count() }}">
                            @error('contrat_nombre_vehicules')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea wire:model="contrat_description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fréquence <span class="text-danger">*</span></label>
                            <select wire:model="contrat_frequence_entretien"
                                    class="form-select @error('contrat_frequence_entretien') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                <option value="MENSUEL">Mensuel</option>
                                <option value="TRIMESTRIEL">Trimestriel</option>
                                <option value="SEMESTRIEL">Semestriel</option>
                                <option value="ANNUEL">Annuel</option>
                            </select>
                            @error('contrat_frequence_entretien')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Durée (mois) <span class="text-danger">*</span></label>
                            <input type="number" wire:model="contrat_duree_contrat_mois"
                                   class="form-control @error('contrat_duree_contrat_mois') is-invalid @enderror"
                                   min="1" max="60">
                            @error('contrat_duree_contrat_mois')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date début <span class="text-danger">*</span></label>
                            <input type="date" wire:model="contrat_date_debut"
                                   class="form-control @error('contrat_date_debut') is-invalid @enderror">
                            @error('contrat_date_debut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date premier entretien <span class="text-danger">*</span></label>
                            <input type="date" wire:model="contrat_date_premier_entretien"
                                   class="form-control @error('contrat_date_premier_entretien') is-invalid @enderror">
                            @error('contrat_date_premier_entretien')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Montant par entretien (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" wire:model="contrat_montant_entretien"
                                   class="form-control @error('contrat_montant_entretien') is-invalid @enderror"
                                   min="0" step="1000">
                            @error('contrat_montant_entretien')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeEditContratModal" class="btn btn-light">Annuler</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove><i class="ri-save-line me-1"></i>Enregistrer</span>
                        <span wire:loading><span class="spinner-border spinner-border-sm me-1"></span>Enregistrement...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
