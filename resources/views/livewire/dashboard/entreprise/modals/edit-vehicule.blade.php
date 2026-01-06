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




                        <!-- Section Photos du véhicule -->
<div class="col-12 mt-3 mb-3">
    <h6 class="text-warning mb-3">
        <i class="ri-image-line me-1"></i>Photos du véhicule
    </h6>
</div>

<div class="col-12 mb-3">
    <!-- Images existantes -->
    @if(!empty($existingImages))
        <label class="form-label">Images actuelles</label>
        <div class="row g-3 mb-3">
            @foreach($existingImages as $index => $imagePath)
                <div class="col-md-3" wire:key="existing-image-{{ $index }}">
                    <div class="position-relative">
                        <img src="{{ $imagePath }}" 
                             class="img-fluid rounded-3 border" 
                             style="height: 150px; width: 100%; object-fit: cover;">
                        <button type="button" 
                                wire:click="removeExistingImage({{ $index }})"
                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle"
                                style="width: 30px; height: 30px; padding: 0;">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
    <!-- Zone d'ajout de nouvelles images -->
    <label class="form-label">Ajouter de nouvelles photos</label>
    <div class="border border-2 border-dashed rounded-3 p-4 text-center" 
         style="background: #fff8e1; cursor: pointer;"
         onclick="document.getElementById('editVehiculeImageInput').click()">
        <i class="ri-upload-cloud-2-line fs-1 text-warning mb-2 d-block"></i>
        <p class="mb-2 fw-medium">Ajouter plus de photos</p>
        <p class="text-muted small mb-0">Formats acceptés: JPG, PNG (Max 2MB par image)</p>
        <input type="file" 
               id="editVehiculeImageInput"
               wire:model="vehicule_images" 
               accept="image/*" 
               multiple 
               class="d-none">
    </div>
    
    <!-- Indicateur de chargement -->
    <div wire:loading wire:target="vehicule_images" class="mt-2">
        <div class="alert alert-info mb-0">
            <span class="spinner-border spinner-border-sm me-2"></span>
            Chargement des images en cours...
        </div>
    </div>
    
    @error('vehicule_images.*') 
        <div class="text-danger small mt-2">{{ $message }}</div> 
    @enderror
    
    <!-- Prévisualisation des nouvelles images -->
    @if(!empty($vehicule_images))
        <div class="row g-3 mt-2">
            @foreach($vehicule_images as $index => $image)
                <div class="col-md-3" wire:key="new-image-{{ $index }}">
                    <div class="position-relative">
                        <img src="{{ $image->temporaryUrl() }}" 
                             class="img-fluid rounded-3 border" 
                             style="height: 150px; width: 100%; object-fit: cover;">
                        <button type="button" 
                                wire:click="removeNewImage({{ $index }})"
                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle"
                                style="width: 30px; height: 30px; padding: 0;">
                            <i class="ri-close-line"></i>
                        </button>
                        <div class="badge bg-success position-absolute bottom-0 start-0 m-2">
                            Nouveau
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
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

