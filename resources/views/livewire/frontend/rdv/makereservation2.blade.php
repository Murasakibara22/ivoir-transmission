<div>
    <!-- Modal de sélection de position -->
    @if($showPositionModal)
    <div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
         style="z-index: 9999; background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(4px);"
         wire:click="closePositionModal">

        <div class="bg-white rounded-4 shadow-lg position-relative d-flex flex-column"
            style="width: 90%; max-width: 800px; max-height: 90vh;"
            wire:click.stop>

            <div class="p-4 border-bottom bg-light flex-shrink-0">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-1 fw-bold text-dark">
                            <i class="ri-map-pin-line text-warning me-2"></i>
                            Sélectionnez votre position exacte
                        </h5>
                        <p class="text-muted small mb-0">
                            👆 Cliquez sur la carte ou déplacez le marqueur pour définir votre position
                        </p>
                    </div>
                    <button wire:click="closePositionModal"
                            class="btn btn-sm btn-light rounded-circle p-2"
                            style="width: 35px; height: 35px;">
                        <i class="ri-close-line fs-5"></i>
                    </button>
                </div>
            </div>

            <div class="flex-grow-1" style="overflow-y: auto; overflow-x: hidden;">
                <div class="position-relative" style="height: 450px; min-height: 300px;">
                    <div id="map" style="width: 100%; height: 100%;"></div>

                    <div class="position-absolute top-0 start-0 m-3 bg-white rounded-3 shadow p-3" style="max-width: 280px; z-index: 1000;">
                        <div class="d-flex align-items-start">
                            <i class="ri-information-line text-primary fs-4 me-2"></i>
                            <div>
                                <p class="mb-1 fw-semibold small">Comment ça marche ?</p>
                                <p class="text-muted small mb-0">Déplacez le marqueur rouge ou cliquez sur la carte pour indiquer votre position précise.</p>
                            </div>
                        </div>
                    </div>

                    <div id="mapLoader" class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Chargement...</span>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-light border-top">
                    <label class="form-label small text-muted mb-2">Adresse sélectionnée :</label>
                    <div class="d-flex align-items-center bg-white p-3 rounded-3 border">
                        <i class="ri-map-pin-2-fill text-danger fs-4 me-3"></i>
                        <div class="flex-grow-1">
                            <p class="mb-0 fw-medium" id="selectedAddress">{{ $tempAddress }}</p>
                            <p class="mb-0 small text-muted" id="selectedCoords"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 border-top bg-white flex-shrink-0">
                <div class="d-flex flex-column flex-sm-row gap-2 gap-sm-3">
                    <button wire:click="closePositionModal"
                            class="btn btn-light order-3 order-sm-1">
                        <i class="ri-arrow-left-line me-2"></i>
                        Retour
                    </button>

                    <button type="button"
                            id="useCurrentLocation"
                            class="btn btn-outline-primary order-2 order-sm-2">
                        <i class="ri-focus-3-line me-2"></i>
                        <span class="d-none d-sm-inline">Ma position actuelle</span>
                        <span class="d-inline d-sm-none">Ma position</span>
                    </button>

                    <button type="button"
                            id="confirmPositionBtn"
                            class="btn btn-primary flex-sm-fill order-1 order-sm-3"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="ri-check-line me-2"></i>
                        Confirmer cette position
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Prenez un Rendez-vous</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                                <li class="breadcrumb-item active">Rendez-vous</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body checkout-tab">

                            <!-- BARRE DE PROGRESSION STEPPER -->
                            <div class="step-arrow-nav mt-n3 mx-n3 mb-4">
                                <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fs-15 p-3 {{ $currentStep == 1 ? 'active' : '' }}"
                                                type="button" disabled>
                                            <i class="ri-calendar-check-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                            <span class="d-none d-sm-inline">Rendez-vous</span>
                                            <span class="d-inline d-sm-none">RDV</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fs-15 p-3 {{ $currentStep == 2 ? 'active' : '' }}"
                                                type="button" disabled>
                                            <i class="ri-car-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                            <span class="d-none d-sm-inline">Véhicule</span>
                                            <span class="d-inline d-sm-none">Auto</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fs-15 p-3 {{ $currentStep == 3 ? 'active' : '' }}"
                                                type="button" disabled>
                                            <i class="ri-secure-payment-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                            <span class="d-none d-sm-inline">Paiement</span>
                                            <span class="d-inline d-sm-none">Pay</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <form wire:submit.prevent="SubmitRendezVous">

                                <!-- ÉTAPE 1 : INFORMATIONS SUR LE RENDEZ-VOUS -->
                                @if($currentStep == 1)
                                <div>
                                    <div>
                                        <h5 class="mb-1 text-primary">INFORMATIONS SUR LE RENDEZ-VOUS</h5>
                                        <p class="text-muted mb-4">Veuillez renseigner les détails de votre rendez-vous.</p>
                                    </div>

                                    <div class="row">
                                        @if($showCommune)
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="country" class="form-label">
                                                    <i class="ri-map-pin-line me-1"></i>
                                                    Communes <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select" id="country" wire:model.live="select_commune">
                                                    <option value="">Sélectionnez...</option>
                                                    @if($list_commune && $list_commune->count() > 0)
                                                        @foreach($list_commune as $commune)
                                                            <option value="{{$commune->nom}}">{{$commune->nom}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('select_commune') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        @endif

                                        <div class="@if($showCommune) col-lg-6 @else col-lg-12 @endif">
                                            <div class="mb-3">
                                                <label for="billinginfo-phone" class="form-label">
                                                    <i class="ri-road-map-line me-1"></i>
                                                    Situation géographique <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" wire:model.live="adresse_livraison"
                                                       placeholder="Renseignez une adresse" autocomplete="false" id="autocomplete">
                                            </div>
                                            @error('adresse_livraison') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="@if($list_service_select && count($list_service_select) > 0) col-lg-5 @else col-lg-12 @endif">
                                            <div class="mb-3">
                                                <label for="billinginfo-phone" class="form-label">
                                                    <i class="ri-tools-line me-1"></i>
                                                    J'ai besoin de <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select" wire:model.live="categorie">
                                                    <option value="">Sélectionnez...</option>
                                                    @if($list_ctegorie && count($list_ctegorie) > 0)
                                                        @foreach($list_ctegorie as $categorie)
                                                            <option value="{{ $categorie->libelle }}">{{ $categorie->libelle }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            @error('categorie') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        @if($list_service_select && count($list_service_select) > 0)
                                            <div class="col-lg-7">
                                                <label for="genderInput" class="form-label">
                                                    <i class="ri-checkbox-multiple-line me-1"></i>
                                                    Besoins
                                                </label>
                                                <div>
                                                    @foreach($list_service_select as $service)
                                                        @php
                                                            $isRequired = in_array($service->libelle, $required_service);
                                                        @endphp

                                                        <div class="form-check form-check-inline mb-2">
                                                            <input type="checkbox" class="form-check-input"
                                                                   id="formCheck{{ $service->id }}"
                                                                   value="{{ $service->libelle }}"
                                                                   wire:model="select_service"
                                                                   @if($isRequired) checked disabled @endif>
                                                            <label class="form-check-label @if($isRequired) text-muted @endif"
                                                                   for="formCheck{{ $service->id }}">
                                                                {{ $service->libelle }}
                                                                @if($isRequired)
                                                                    <small class="text-muted">(obligatoire)</small>
                                                                @endif
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('select_service')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="billinginfo-phone" class="form-label">
                                                    <i class="ri-calendar-2-line me-1"></i>
                                                    Date du rendez-vous <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select"
                                                        wire:model="date_rdv"
                                                        @if(!$adresse_livraison) disabled @endif>
                                                    <option value="">Sélectionnez...</option>
                                                    @if($joursAutorises && count($joursAutorises) > 0)
                                                        @foreach($joursAutorises as $date => $label)
                                                            <option value="{{ $date }}">{{ $label }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @if(!$adresse_livraison)
                                                    <div class="text-danger mt-2 small">
                                                        Veuillez renseigner une adresse avant de sélectionner une date.
                                                    </div>
                                                @endif
                                            </div>
                                            @error('date_rdv') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-lg-6">
                                            <label for="billinginfo-phone" class="form-label">
                                                <i class="ri-time-line me-1"></i>
                                                Heure du rendez-vous <span class="text-danger">*</span>
                                            </label>
                                            <div class="mb-3">
                                                {{-- Le temps doit etre entre 8h et 18h --}}
                                                <input type="time" min="08:00" max="18:00" wire:model="time_rdv" class="form-control">
                                            </div>
                                            @error('time_rdv') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-check card-radio">
                                                <input id="shippingMethod01" name="shippingMethod" type="radio" class="form-check-input" checked="">
                                                <label class="form-check-label" for="shippingMethod01">
                                                    <span class="fs-18 float-end mt-2 text-wrap d-block">{{number_format($montant_service,0,'.',' ')}} fcfa</span>
                                                    <span class="fs-14 mb-1 text-wrap text-primary d-block">
                                                        <i class="ri-money-dollar-circle-line me-1"></i>
                                                        Frais de main d'œuvre
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-3 mt-3">
                                        <button type="button" wire:click="$set('currentStep', 2)"
                                                class="btn btn-primary btn-label right ms-auto">
                                            <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                            Suivant : Informations véhicule
                                        </button>
                                    </div>
                                </div>
                                @endif

                                <!-- ÉTAPE 2 : INFORMATIONS SUR LE VÉHICULE -->
                                @if($currentStep == 2)
                                <div>
                                    <div>
                                        <h5 class="mb-3 mt-0 text-primary">INFORMATIONS SUR LE VÉHICULE</h5>
                                    </div>

                                    <div>
                                        <div class="row mt-4">

                                            <div class="col-md-4" wire:ignore>
                                                <div class="mb-3">
                                                    <label for="country" class="form-label">
                                                        <i class="ri-barcode-line me-1"></i>
                                                        Numéro de châssis <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" wire:model.live="chassis" class="form-control"
                                                           id="billinginfo-firstName" placeholder="Entrer le numéro de châssis" autocomplete="false">
                                                </div>
                                                @error('chassis') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="state" class="form-label">
                                                        <i class="ri-shield-star-line me-1"></i>
                                                        Modèles <span class="text-muted">(FACULTATIF)</span>
                                                    </label>
                                                    <input type="text" wire:model="select_type" class="form-control"
                                                           id="billinginfo-firstName" placeholder="Entrer le ..." autocomplete="false">
                                                </div>
                                                @error('select_type') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="state" class="form-label">
                                                        <i class="ri-price-tag-3-line me-1"></i>
                                                        Marques <span class="text-muted">(FACULTATIF)</span>
                                                    </label>
                                                    <input type="text" wire:model="select_marque" class="form-control"
                                                           id="billinginfo-firstName" placeholder="Entrer la marque..." autocomplete="false">
                                                </div>
                                                @error('select_marque') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="country" class="form-label">
                                                        <i class="ri-calendar-line me-1"></i>
                                                        Année <span class="text-muted">(FACULTATIF)</span>
                                                    </label>
                                                    <input type="text" wire:model="year_vehicule" class="form-control"
                                                           id="billinginfo-firstName" placeholder="Entrer l'année" autocomplete="false">
                                                </div>
                                                @error('year_vehicule') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="zip" class="form-label">
                                                        <i class="ri-image-line me-1"></i>
                                                        Images <span class="text-muted">(FACULTATIF)</span>
                                                    </label>
                                                    <input type="file" wire:model="AsImages" accept=".png, .jpg, .jpeg" multiple class="form-control" id="zip" placeholder="Enter zip code">
                                                </div>
                                                @error('AsImages') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="billinginfo-address" class="form-label">
                                                        <i class="ri-file-text-line me-1"></i>
                                                        Détails supplémentaires
                                                    </label>
                                                    <textarea class="form-control" wire:model="detail_vehicule"
                                                              id="billinginfo-address" placeholder="Plus de détails" rows="3"></textarea>
                                                </div>
                                                @error('detail_vehicule') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3 mt-3">
                                            <button type="button" wire:click="$set('currentStep', 1)"
                                                    class="btn btn-light btn-label">
                                                <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                Retour
                                            </button>
                                            <button type="button" wire:click="$set('currentStep', 3)"
                                                    class="btn btn-primary btn-label right ms-auto">
                                                <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                Suivant : Paiement
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- ÉTAPE 3 : MODE DE PAIEMENT -->
                                @if($currentStep == 3)
                                <div>
                                    <div>
                                        <h5 class="mb-1 mt-0 text-primary">MODE DE PAIEMENTS</h5>
                                        <p class="text-muted mb-4">Finalisez votre réservation en renseignant vos informations de paiement.</p>
                                    </div>

                                    <div class="collapse show" id="paymentmethodCollapse">
                                        <div class="card p-4 border shadow-none mb-0 mt-4">
                                            <div class="row gy-3">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-firstName" class="form-label">
                                                            <i class="ri-user-line me-1"></i>
                                                            Nom & Prénoms <span class="text-muted">(FACULTATIF)</span>
                                                        </label>
                                                        <input type="text" wire:model="username" class="form-control"
                                                               id="billinginfo-firstName" placeholder="Enter first name" value="">
                                                    </div>
                                                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3" wire:ignore>
                                                        <label for="billinginfo-phone" class="form-label">
                                                            <i class="ri-phone-line me-1"></i>
                                                            Numéro de paiements <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" class="form-control" maxlength="10" minlength="10"
                                                               wire:model="contact_livraison" placeholder="Entrer votre numéro de téléphone...">
                                                    </div>
                                                    @error('contact_livraison') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-success mt-2 fst-italic">
                                            <i data-feather="lock" class="text-success icon-xs"></i>
                                            Votre transaction est sécurisée et cryptée.
                                        </div>
                                    </div>

                                    <!-- Récapitulatif -->
                                    <div class="card border bg-light mt-4">
                                        <div class="card-body">
                                            <h6 class="card-title mb-3">
                                                <i class="ri-file-list-3-line me-2"></i>
                                                Récapitulatif de votre réservation
                                            </h6>
                                            <ul class="list-unstyled mb-0">
                                                <li class="mb-2">
                                                    <i class="ri-map-pin-line text-primary me-2"></i>
                                                    <strong>Commune :</strong> {{ $select_commune ?? 'Non renseignée' }}
                                                </li>
                                                <li class="mb-2">
                                                    <i class="ri-calendar-line text-primary me-2"></i>
                                                    <strong>Date :</strong>
                                                    @if($date_rdv)
                                                        {{ \Carbon\Carbon::parse($date_rdv)->format('d/m/Y') }}
                                                    @else
                                                        Non renseignée
                                                    @endif
                                                </li>
                                                <li class="mb-2">
                                                    <i class="ri-time-line text-primary me-2"></i>
                                                    <strong>Heure :</strong> {{ $time_rdv ?? 'Non renseignée' }}
                                                </li>
                                                <li class="mb-2">
                                                    <i class="ri-tools-line text-primary me-2"></i>
                                                    <strong>Service :</strong> {{ $categorie ?? 'Non renseigné' }}
                                                </li>
                                                <li class="mb-2">
                                                    <i class="ri-car-line text-primary me-2"></i>
                                                    <strong>Châssis :</strong> {{ $chassis ?? 'Non renseigné' }}
                                                </li>
                                                <li class="mb-0 pt-2 border-top">
                                                    <i class="ri-money-dollar-circle-line text-success me-2"></i>
                                                    <strong>Montant total :</strong>
                                                    <span class="fs-5 fw-bold text-success">
                                                        {{ number_format($montant_service, 0, '.', ' ') }} FCFA
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-3 mt-3">
                                        <button type="button" wire:click="$set('currentStep', 2)"
                                                class="btn btn-light btn-label">
                                            <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                            Retour
                                        </button>
                                        <button type="submit" class="btn btn-success btn-label right ms-auto" wire:loading.attr="disabled">
                                            <i class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i>
                                            <span wire:loading.remove>Confirmer ma réservation</span>
                                            <span wire:loading>Traitement en cours...</span>
                                        </button>
                                    </div>
                                </div>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR DROITE -->
                <div class="col-xl-4">
                    <div class="sticky-side-div">

                        <div class="alert border-dashed alert-success" role="alert">
                            <div class="d-flex align-items-center">
                                <lord-icon src="https://cdn.lordicon.com/nkmsrxys.json" trigger="loop" colors="primary:#121331,secondary:#f06548" style="width:80px;height:80px"></lord-icon>
                                <div class="ms-2">
                                    <h5 class="fs-14 text-danger fw-semibold">Note importante !!</h5>
                                    <p class="text-black mb-1">Cumulez des points (Bonus) pour obtenir des coupons de <br/>réductions de <span class="fw-semibold">30%</span> sur votre prochaine réservation</p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0">Sommes de la reservation</h5>
                            </div>

                            <div class="card-header bg-light-subtle border-bottom-dashed">
                                <div class="text-center">
                                    <h6 class="mb-2">As-tu un code <span class="fw-semibold">promo</span> ?</h6>
                                </div>
                                <div class="hstack gap-3 px-3 mx-n3">
                                    <input class="form-control me-auto" type="text" placeholder="Enter coupon code" aria-label="Add Promo Code here...">
                                    <button type="button" class="btn btn-success w-xs">Appliquer</button>
                                </div>
                            </div>

                            <div class="card-body pt-2">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr class="table-active">
                                                <th>Total (FCFA) :</th>
                                                <td class="text-end">
                                                    <span class="fw-semibold" id="cart-total">
                                                        {{ number_format($montant_service, 0, ',','.') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Indicateur de progression -->
                                <div class="mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">Progression</small>
                                        <small class="fw-semibold text-primary">Étape {{ $currentStep }}/3</small>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: {{ ($currentStep / 3) * 100 }}%"
                                            aria-valuenow="{{ ($currentStep / 3) * 100 }}"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwmz2CstWs-2hp_ygHYc527i7XBgIrNJg&libraries=places&callback=initMap" async></script>
<script>
async function initMap() {
    var input = document.getElementById('autocomplete');
    const options = {
        componentRestrictions: { country: "ci" },
    };

    var autocomplete = new google.maps.places.Autocomplete(input, options);

    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();

        if (!place.geometry) {
            alert("Aucune géométrie disponible pour ce lieu.");
            return;
        }

        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        var adresse_name = place.name;
        var adresse_complete = place.formatted_address;

        let commune = "";
        place.address_components.forEach(component => {
            if (component.types.includes("sublocality") || component.types.includes("sublocality_level_1")) {
                commune = component.long_name;
            }
        });

        if (!commune) {
           @this.set('select_commune', null)
        }

        var location = {
            adresse: adresse_complete,
            adresse_name: adresse_name,
            latitude: latitude,
            longitude: longitude
        };

        @this.set('adresse_livraison', adresse_name + ' ' + adresse_complete)
        @this.set('select_commune', commune)

        @this.call('openPositionModal', adresse_name + ' ' + adresse_complete, location);
    });
}

window.addEventListener('positionConfirmed', function() {
    console.log('Position confirmée !');
    const input = document.getElementById('autocomplete');
    if (input) {
        input.classList.add('border-success');
        input.classList.add('border-3');
        setTimeout(() => {
            input.classList.remove('border-success');
            input.classList.remove('border-3');
        }, 2000);
    }
});
</script>
<!-- Script pour le modal de carte -->
<script>
let map;
let marker;

window.addEventListener('openMapModal', function(event) {
    map = null;
    marker = null;

    setTimeout(() => {
        initializeMap(event.detail.location);
    }, 300);
});

function initializeMap(location) {
    const mapLoader = document.getElementById('mapLoader');

    const initialPos = location ? {
        lat: parseFloat(location.latitude),
        lng: parseFloat(location.longitude)
    } : { lat: 5.316667, lng: -4.033333 };

    map = new google.maps.Map(document.getElementById('map'), {
        center: initialPos,
        zoom: 16,
        mapTypeControl: true,
        streetViewControl: false,
        fullscreenControl: true,
        styles: [
            {
                featureType: "poi",
                elementType: "labels",
                stylers: [{ visibility: "on" }]
            }
        ]
    });

    marker = new google.maps.Marker({
        position: initialPos,
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        icon: {
            url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
            scaledSize: new google.maps.Size(50,50)
        },
        title: "Votre position"
    });

    if (mapLoader) mapLoader.style.display = 'none';

    google.maps.event.addListener(marker, 'dragend', function() {
        updateAddressFromMarker(marker.getPosition());
    });

    google.maps.event.addListener(map, 'click', function(event) {
        marker.setPosition(event.latLng);
        updateAddressFromMarker(event.latLng);
    });

    updateAddressFromMarker(marker.getPosition());

    attachModalButtons();
}

function updateAddressFromMarker(position) {
    const geocoder = new google.maps.Geocoder();
    const coordsDisplay = document.getElementById('selectedCoords');

    let lat, lng;
    if (typeof position.lat === 'function') {
        lat = position.lat();
        lng = position.lng();
    } else {
        lat = position.lat;
        lng = position.lng;
    }

    if (coordsDisplay) {
        coordsDisplay.textContent = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
    }

    geocoder.geocode({ location: { lat: lat, lng: lng } }, (results, status) => {
        if (status === 'OK' && results[0]) {
            const addressElement = document.getElementById('selectedAddress');
            if (addressElement) {
                addressElement.textContent = results[0].formatted_address;
            }
        }
    });
}


function attachModalButtons() {
    const useCurrentBtn = document.getElementById('useCurrentLocation');

    if (useCurrentBtn) {
        const newBtn = useCurrentBtn.cloneNode(true);
        useCurrentBtn.parentNode.replaceChild(newBtn, useCurrentBtn);

        newBtn.addEventListener('click', function() {
            const button = this;

            if (navigator.geolocation) {
                button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Localisation...';
                button.disabled = true;

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        if (map && marker) {
                            map.setCenter(pos);
                            map.setZoom(17);
                            marker.setPosition(pos);
                            updateAddressFromMarker(pos);
                        }

                        button.innerHTML = '<i class="ri-check-line me-2"></i><span class="d-none d-sm-inline">Position obtenue !</span><span class="d-inline d-sm-none">OK !</span>';
                        button.classList.add('btn-success');
                        button.classList.remove('btn-outline-primary');

                        setTimeout(function() {
                            button.innerHTML = '<i class="ri-focus-3-line me-2"></i><span class="d-none d-sm-inline">Ma position actuelle</span><span class="d-inline d-sm-none">Ma position</span>';
                            button.classList.remove('btn-success');
                            button.classList.add('btn-outline-primary');
                            button.disabled = false;
                        }, 2000);
                    },
                    function(error) {
                        let errorMsg = 'Impossible d\'obtenir votre position.';

                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                errorMsg = 'Vous avez refusé l\'accès à votre position. Veuillez autoriser la géolocalisation dans les paramètres de votre navigateur.';
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMsg = 'Votre position est actuellement indisponible.';
                                break;
                            case error.TIMEOUT:
                                errorMsg = 'La demande de géolocalisation a expiré. Veuillez réessayer.';
                                break;
                        }

                        alert(errorMsg);
                        button.innerHTML = '<i class="ri-focus-3-line me-2"></i><span class="d-none d-sm-inline">Ma position actuelle</span><span class="d-inline d-sm-none">Ma position</span>';
                        button.disabled = false;
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 15000,
                        maximumAge: 0
                    }
                );
            } else {
                alert('La géolocalisation n\'est pas supportée par votre navigateur.');
            }
        });
    }

    const confirmBtn = document.getElementById('confirmPositionBtn');

    if (confirmBtn) {
        const newConfirmBtn = confirmBtn.cloneNode(true);
        confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);

        newConfirmBtn.addEventListener('click', function() {
            if (!marker) return;

            const position = marker.getPosition();
            const geocoder = new google.maps.Geocoder();
            const button = this;

            button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Confirmation...';
            button.disabled = true;

            geocoder.geocode({ location: position }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    const finalLocation = {
                        adresse: results[0].formatted_address,
                        adresse_name: results[0].name || results[0].address_components[0].long_name,
                        latitude: position.lat(),
                        longitude: position.lng()
                    };

                    @this.call('confirmPosition', finalLocation);
                } else {
                    alert('Erreur lors de la confirmation de la position. Veuillez réessayer.');
                    button.innerHTML = '<i class="ri-check-line me-2"></i>Confirmer cette position';
                    button.disabled = false;
                }
            });
        });
    }
}
</script>
<style>
#map {
    border-radius: 0;
}

.gm-style-iw {
    border-radius: 8px !important;
}

.gm-style-iw-d {
    overflow: hidden !important;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.position-fixed > div {
    animation: modalFadeIn 0.3s ease-out;
}

.sticky-side-div {
    position: sticky;
    top: 100px;
}

@media (max-width: 1199px) {
    .sticky-side-div {
        position: relative;
        top: 0;
        margin-top: 20px;
    }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@20.0.4/build/js/intlTelInput.min.js"></script>
<script>
    const input = document.querySelector("#phone");

    const iti = intlTelInput(input, {
        separateDialCode: true,
        initialCountry: "auto",
        geoIpLookup: callback => {
            fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("ci"));
        },
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@20.0.4/build/js/utils.js"
    });

    function getDialCode() {
        const countryData = iti.getSelectedCountryData();
        const phoneNumber = input.value;
    }

    function sendPhoneData() {
        var phoneNumber = iti.getNumber();
        @this.set('contact_livraison',phoneNumber);
        @this.set('dialCode', iti.getSelectedCountryData().dialCode);

    }

    input.addEventListener("countrychange", getDialCode);
    input.addEventListener("input", getDialCode);
</script>
@endpush
