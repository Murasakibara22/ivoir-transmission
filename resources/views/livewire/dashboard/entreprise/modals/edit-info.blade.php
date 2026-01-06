<!-- Modal Edit Info Entreprise -->
@if($showEditInfoModal)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ri-edit-line me-2"></i>Modifier les informations
                </h5>
                <button type="button" wire:click="closeEditInfoModal" class="btn-close"></button>
            </div>
            <form wire:submit.prevent="updateEntrepriseInfo">
                <div class="modal-body">
                    <div class="row">
                        <!-- Logo -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Logo de l'entreprise</label>
                            <div class="d-flex align-items-center gap-3">
                                @if($entreprise->logo)
                                    <img src="{{ asset('storage/' . $entreprise->logo) }}"
                                         alt="Logo actuel"
                                         class="avatar-lg rounded">
                                @else
                                    <div class="avatar-lg rounded bg-light d-flex align-items-center justify-content-center">
                                        <i class="ri-image-line fs-2 text-muted"></i>
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <input type="file" wire:model="newLogo" class="form-control" accept="image/*">
                                    @if($newLogo)
                                        <div class="mt-2">
                                            <img src="{{ $newLogo->temporaryUrl() }}" class="avatar-md rounded">
                                        </div>
                                    @endif
                                    @error('newLogo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">PNG, JPG - Max 2MB</small>
                                </div>
                            </div>
                            <div wire:loading wire:target="newLogo" class="mt-2">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Chargement...</span>
                                </div>
                                <span class="text-muted ms-2">Upload en cours...</span>
                            </div>
                        </div>

                        <!-- Nom -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Nom de l'entreprise <span class="text-danger">*</span>
                            </label>
                            <input type="text" wire:model="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Ex: Tech Solutions SARL">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" wire:model="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="contact@entreprise.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Téléphone -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Téléphone <span class="text-danger">*</span>
                            </label>
                            <input type="tel" wire:model="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="+225 XX XX XX XX XX">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type d'entreprise</label>
                            <select wire:model="type" class="form-select">
                                <option value="">Sélectionner un type</option>
                                <option value="SARL">SARL</option>
                                <option value="SA">SA</option>
                                <option value="SAS">SAS</option>
                                <option value="EURL">EURL</option>
                                <option value="AUTO_ENTREPRENEUR">Auto-entrepreneur</option>
                                <option value="ASSOCIATION">Association</option>
                                <option value="AUTRE">Autre</option>
                            </select>
                        </div>

                        <!-- Adresse -->
                        <div class="col-12">
                            <h6 class="mb-3">Adresse</h6>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Rue / Quartier</label>
                            <input type="text" wire:model="address.rue"
                                   class="form-control"
                                   placeholder="Ex: Rue des Jardins, Cocody">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Ville</label>
                            <input type="text" wire:model="address.ville"
                                   class="form-control"
                                   placeholder="Ex: Abidjan">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Code postal</label>
                            <input type="text" wire:model="address.code_postal"
                                   class="form-control"
                                   placeholder="Ex: 00225">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Pays</label>
                            <input type="text" wire:model="address.pays"
                                   class="form-control"
                                   placeholder="Ex: Côte d'Ivoire">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeEditInfoModal" class="btn btn-light">
                        <i class="ri-close-line me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updateEntrepriseInfo">
                            <i class="ri-save-line me-1"></i>Enregistrer
                        </span>
                        <span wire:loading wire:target="updateEntrepriseInfo">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                            Enregistrement...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
