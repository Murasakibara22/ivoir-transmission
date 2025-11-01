<!-- Modal Edit Vehicule -->
@if($showEditVehiculeModal && $selectedVehicule)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning-subtle">
                <h5 class="modal-title">
                    <i class="ri-edit-line me-2"></i>Modifier le véhicule
                </h5>
                <button type="button" wire:click="$set('showEditVehiculeModal', false)" class="btn-close"></button>
            </div>
            <form wire:submit.prevent="updateVehicule">
                <div class="modal-body">
                    <!-- Info véhicule -->
                    <div class="alert alert-warning border-0 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="ri-information-line fs-4 me-2"></i>
                            <div>
                                <strong>Modification :</strong> Vous modifiez le véhicule <strong>{{ $selectedVehicule->matricule }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Section Informations principales -->
                        <div class="col-12 mb-3">
                            <h6 class="text-warning mb-3">
                                <i class="ri-information-line me-1"></i>Informations principales
                            </h6>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Libellé du véhicule <span class="text-danger">*</span>
                            </label>
                            <input type="text" wire:model="vehicule_libelle"
                                   class="form-control @error('vehicule_libelle') is-invalid @enderror"
                                   placeholder="Ex: Mercedes Sprinter Utilitaire">
                            @error('vehicule_libelle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Immatriculation <span class="text-danger">*</span>
                            </label>
                            <input type="text" wire:model="vehicule_matricule"
                                   class="form-control @error('vehicule_matricule') is-invalid @enderror"
                                   placeholder="Ex: AB-123-CD">
                            @error('vehicule_matricule')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Numéro de chassis <span class="text-danger">*</span>
                            </label>
                            <input type="text" wire:model="vehicule_chassis"
                                   class="form-control @error('vehicule_chassis') is-invalid @enderror"
                                   placeholder="Ex: VF1AB000123456789">
                            @error('vehicule_chassis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Marque <span class="text-danger">*</span>
                            </label>
                            <select wire:model="vehicule_marque"
                                    class="form-select @error('vehicule_marque') is-invalid @enderror">
                                <option value="">Sélectionner une marque</option>
                                <option value="Mercedes">Mercedes</option>
                                <option value="BMW">BMW</option>
                                <option value="Audi">Audi</option>
                                <option value="Renault">Renault</option>
                                <option value="Peugeot">Peugeot</option>
                                <option value="Ford">Ford</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Nissan">Nissan</option>
                                <option value="Volkswagen">Volkswagen</option>
                                <option value="Citroën">Citroën</option>
                                <option value="Autre">Autre</option>
                            </select>
                            @error('vehicule_marque')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Section Caractéristiques -->
                        <div class="col-12 mt-3 mb-3">
                            <h6 class="text-warning mb-3">
                                <i class="ri-settings-3-line me-1"></i>Caractéristiques
                            </h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Modèle</label>
                            <input type="text" wire:model="vehicule_modele"
                                   class="form-control"
                                   placeholder="Ex: Sprinter 314 CDI">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Année</label>
                            <input type="number" wire:model="vehicule_year"
                                   class="form-control"
                                   min="1990" max="2025"
                                   placeholder="Ex: 2020">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Type de véhicule</label>
                            <select wire:model="vehicule_type" class="form-select">
                                <option value="">Sélectionner un type</option>
                                <option value="Utilitaire">Utilitaire</option>
                                <option value="Berline">Berline</option>
                                <option value="SUV">SUV</option>
                                <option value="Camion">Camion</option>
                                <option value="Minibus">Minibus</option>
                                <option value="Break">Break</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Carburant</label>
                            <select wire:model="vehicule_carburant" class="form-select">
                                <option value="">Sélectionner</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Essence">Essence</option>
                                <option value="Hybride">Hybride</option>
                                <option value="Électrique">Électrique</option>
                                <option value="GPL">GPL</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Couleur</label>
                            <input type="text" wire:model="vehicule_couleur"
                                   class="form-control"
                                   placeholder="Ex: Blanc">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kilométrage actuel (km)</label>
                            <input type="number" wire:model="vehicule_kilometrage_actuel"
                                   class="form-control"
                                   min="0"
                                   placeholder="Ex: 50000">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="$set('showEditVehiculeModal', false)" class="btn btn-light">
                        <i class="ri-close-line me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-warning" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updateVehicule">
                            <i class="ri-save-line me-1"></i>Mettre à jour
                        </span>
                        <span wire:loading wire:target="updateVehicule">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                            Mise à jour...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

