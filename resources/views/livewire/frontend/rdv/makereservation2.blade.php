<div>
    <!-- Modal de sélection de position -->
    @if($showPositionModal)
    <div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
         style="z-index: 9999; background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(4px);"
         wire:click="closePositionModal">

        <div class="bg-white rounded-4 shadow-lg position-relative d-flex flex-column"
            style="width: 90%; max-width: 800px; max-height: 90vh;"
            wire:click.stop>

            <!-- Header - FIXE -->
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
                    <button onclick="@this.call('closePositionModal')"
                            class="btn btn-sm btn-light rounded-circle p-2"
                            style="width: 35px; height: 35px;">
                        <i class="ri-close-line fs-5"></i>
                    </button>
                </div>
            </div>

            <!-- Contenu scrollable -->
            <div class="flex-grow-1" style="overflow-y: auto; overflow-x: hidden;">
                <!-- Map Container -->
                <div class="position-relative" style="height: 450px; min-height: 300px;">
                    <div id="map" style="width: 100%; height: 100%;"></div>

                    <!-- Overlay d'instructions -->
                    <div class="position-absolute top-0 start-0 m-3 bg-white rounded-3 shadow p-3" style="max-width: 280px; z-index: 1000;">
                        <div class="d-flex align-items-start">
                            <i class="ri-information-line text-primary fs-4 me-2"></i>
                            <div>
                                <p class="mb-1 fw-semibold small">Comment ça marche ?</p>
                                <p class="text-muted small mb-0">Déplacez le marqueur rouge ou cliquez sur la carte pour indiquer votre position précise.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Indicateur de chargement -->
                    <div id="mapLoader" class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Chargement...</span>
                        </div>
                    </div>
                </div>

                <!-- Adresse sélectionnée -->
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

            <!-- Footer Actions - FIXE -->
            <div class="p-4 border-top bg-white flex-shrink-0">
                <div class="d-flex flex-column flex-sm-row gap-2 gap-sm-3">
                    <button onclick="@this.call('closePositionModal')"
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

            <!-- start page title -->
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
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body checkout-tab">

                            <form >
                                <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                                    <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">
                                                <i class="ri-user-2-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i> Personal Info
                                            </button>
                                        </li>
                                        {{-- <li class="nav-item" role="presentation">
                                            <button class="nav-link fs-15 p-3" id="pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" aria-controls="pills-bill-address" aria-selected="false">
                                                <i class="ri-truck-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i> Shipping Info
                                            </button>
                                        </li> --}}
                                        {{-- <li class="nav-item" role="presentation">
                                            <button class="nav-link fs-15 p-3" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">
                                                <i class="ri-bank-card-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i> Payment Info
                                            </button>
                                        </li> --}}
                                        {{-- <li class="nav-item" role="presentation">
                                            <button class="nav-link fs-15 p-3" id="pills-finish-tab" data-bs-toggle="pill" data-bs-target="#pills-finish" type="button" role="tab" aria-controls="pills-finish" aria-selected="false">
                                                <i class="ri-checkbox-circle-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i> Finish
                                            </button>
                                        </li> --}}
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                                        <div>
                                            <h5 class="mb-1 text-primary">INFORMATIONS SUR LE RENDEZ-VOUS</h5>
                                            <p class="text-muted mb-4">s'il vous plaît remplissez les informations ci-dessous.</p>
                                        </div>

                                        <div>

                                            <div class="row">

                                                @if($showCommune)
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="country" class="form-label">Communes <span class="text-danger">*</span> </label>
                                                        <select   class="form-select" id="country"  wire:model.live="select_commune">
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
                                                        <label for="billinginfo-phone" class="form-label">Situation géographique <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" wire:model.live="adresse_livraison" placeholder="Renseignez une adresse" autocomplete="false" id="autocomplete">
                                                    </div>
                                                    @error('adresse_livraison') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>


                                                <div class="@if($list_service_select && count($list_service_select) > 0) col-lg-5 @else col-lg-12 @endif">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-phone" class="form-label">J'ai besoin de<span class="text-danger">*</span> </label>
                                                        <select  class="form-select"  wire:model.live="categorie">
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
                                                        <label for="genderInput" class="form-label">Besoins</label>
                                                        <div>
                                                            @foreach($list_service_select as $service)
                                                                @php
                                                                    $isRequired = in_array($service->libelle, $required_service);
                                                                @endphp

                                                                <div class="form-check form-check-inline mb-2">
                                                                    <input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        id="formCheck{{ $service->id }}"
                                                                        value="{{ $service->libelle }}"
                                                                        wire:model="select_service"
                                                                        @if($isRequired) checked disabled @endif
                                                                    >
                                                                    <label
                                                                        class="form-check-label @if($isRequired) text-muted @endif"
                                                                        for="formCheck{{ $service->id }}"
                                                                    >
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
                                                        <label for="billinginfo-phone" class="form-label">Date du rendez-vous <span class="text-danger">*</span> </label>
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
                                                    <label for="billinginfo-phone" class="form-label">Heure du rendez-vous <span class="text-danger">*</span> </label>
                                                    <div class="mb-3">
                                                        <input type="time" wire:model="time_rdv" class="form-control" >
                                                    </div>
                                                    @error('time_rdv') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>




                                                <div class="col-lg-12">
                                                    <div class="form-check card-radio">
                                                        <input id="shippingMethod01" name="shippingMethod" type="radio" class="form-check-input" checked="">
                                                        <label class="form-check-label" for="shippingMethod01">
                                                            <span class="fs-18 float-end mt-2 text-wrap d-block">{{number_format($montant_service,0,'.',' ')}} fcfa</span>
                                                            <span class="fs-14 mb-1 text-wrap text-primary d-block">Mains d'œuvres
                                                                </span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>



                                        <div >
                                            <h5 class="mb-3 mt-5 text-primary">INFORMATIONS SUR LE VÉHICULE</h5>
                                        </div>


                                        <div>
                                            <div class="row mt-4">

                                                <div class="col-md-4" wire:ignore>
                                                    <div class="mb-3">
                                                        <label for="country" class="form-label">Numéro de chassis<span class="text-danger">*</span> </label>
                                                        <input type="text" wire:model.live="chassis" class="form-control" id="billinginfo-firstName" placeholder="Entrer le numéro de chassis" autocomplete="false">
                                                    </div>
                                                    @error('chassis') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="state" class="form-label">Modèles <span class="text-muted"> (FACULTATIF)</span> </label>
                                                        <input type="text" wire:model="select_type" class="form-control" id="billinginfo-firstName" placeholder="Entrer le ..." autocomplete="false">
                                                    </div>
                                                    @error('select_type') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="state" class="form-label">Marques <span class="text-muted"> (FACULTATIF)</span> </label>
                                                        <input type="text" wire:model="select_marque" class="form-control" id="billinginfo-firstName" placeholder="Entrer la marque..." autocomplete="false">
                                                    </div>
                                                    @error('select_marque') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="country" class="form-label">Année <span class="text-muted"> (FACULTATIF)</span></label>
                                                        <input type="text" wire:model="year_vehicule" class="form-control" id="billinginfo-firstName" placeholder="Entrer l'année" autocomplete="false">
                                                    </div>
                                                    @error('year_vehicule') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>






                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="zip" class="form-label">images <span class="text-muted"> ( FACULTATIF )</span> </label>
                                                        <input type="file" wire:model="AsImages" accept=".png, .jpg, .jpeg" multiple class="form-control" id="zip" placeholder="Enter zip code">
                                                    </div>
                                                    @error('AsImages') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-address" class="form-label">Détails</label>
                                                        <textarea class="form-control" wire:model="detail_vehicule" id="billinginfo-address" placeholder="Plus de détails" rows="3"></textarea>
                                                    </div>
                                                    @error('detail_vehicule') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                        </div>



                                        <div>

                                            <div>
                                                <h5 class="mb-1 mt-3 text-primary">Mode de paiements</h5>
                                            </div>

                                            {{-- <div class="row g-4">

                                                <div class="col-lg-6 col-sm-6">
                                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse" aria-expanded="true" aria-controls="paymentmethodCollapse">
                                                        <div class="form-check card-radio">
                                                            <input id="paymentMethod02" name="paymentMethod" type="radio" class="form-check-input" checked>
                                                            <label class="form-check-label" for="paymentMethod02">
                                                                <span class="fs-16 text-muted me-2"><i class="ri-bank-card-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Mobile Money / Carte de Credit</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-sm-6">
                                                    <div data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="paymentmethodCollapse">
                                                        <div class="form-check card-radio">
                                                            <input id="paymentMethod03" disabled name="paymentMethod" type="radio" class="form-check-input">
                                                            <label class="form-check-label" for="paymentMethod03">
                                                                <span class="fs-16 text-muted me-2"><i class="ri-money-dollar-box-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Cash / Espèces</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="collapse show" id="paymentmethodCollapse">
                                                <div class="card p-4 border shadow-none mb-0 mt-4">
                                                    <div class="row gy-3">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="billinginfo-firstName" class="form-label">Nom & Prénoms <span class="text-muted">(FACULTATIF)</span> </label>
                                                                    <input type="text" wire:model="username" class="form-control" id="billinginfo-firstName" placeholder="Enter first name" value="">
                                                                </div>
                                                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="mb-3" wire:ignore>
                                                                    <label for="billinginfo-phone" class="form-label">numéro de paiements <span class="text-danger">*</span> </label>
                                                                    <input type="number" class="form-control" maxlength="10" minlength="10"  wire:model="contact_livraison"  placeholder="Entrer votre numéro de téléphone...">
                                                                    {{-- <p id="output">Please enter a valid number below</p>            --}}
                                                                </div>
                                                                @error('contact_livraison') <span class="text-danger">{{ $message }}</span> @enderror

                                                            </div>



                                                    </div>
                                                </div>
                                                <div class="text-success mt-2 fst-italic">
                                                    <i data-feather="lock" class="text-success icon-xs"></i> Votre transaction est sécurisée et cryptée.
                                                </div>
                                            </div>


                                            <div class="d-flex align-items-start gap-3 mt-3">
                                                <button type="button" wire:click="SubmitRendezVous" class="btn btn-primary btn-label right ms-auto nexttab" wire:loading.attr="disabled">
                                                    <i class="ri-truck-line label-icon align-middle fs-16 ms-2"></i>
                                                    <span wire:loading.remove>Confirmez votre rendez-vous</span>
                                                    <span wire:loading>Traitement en cours...</span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end tab pane -->

                                    {{-- <div class="tab-pane fade" id="pills-bill-address" role="tabpanel" aria-labelledby="pills-bill-address-tab">
                                        <div>
                                            <h5 class="mb-1">Shipping Information</h5>
                                            <p class="text-muted mb-4">Please fill all information below</p>
                                        </div>

                                        <div class="mt-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-14 mb-0">Saved Address</h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                                        Add Address
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row gy-3">
                                                <div class="col-lg-4 col-sm-6">
                                                    <div class="form-check card-radio">
                                                        <input id="shippingAddress01" name="shippingAddress" type="radio" class="form-check-input" checked>
                                                        <label class="form-check-label" for="shippingAddress01">
                                                            <span class="mb-4 fw-semibold d-block text-muted text-uppercase">Home Address</span>

                                                            <span class="fs-14 mb-2 d-block">Marcus Alfaro</span>
                                                            <span class="text-muted fw-normal text-wrap mb-1 d-block">4739 Bubby Drive Austin, TX 78729</span>
                                                            <span class="text-muted fw-normal d-block">Mo. 012-345-6789</span>
                                                        </label>
                                                    </div>
                                                    <div class="d-flex flex-wrap p-2 py-1 bg-light rounded-bottom border mt-n1">
                                                        <div>
                                                            <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#addAddressModal"><i class="ri-pencil-fill text-muted align-bottom me-1"></i> Edit</a>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#removeItemModal"><i class="ri-delete-bin-fill text-muted align-bottom me-1"></i> Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6">
                                                    <div class="form-check card-radio">
                                                        <input id="shippingAddress02" name="shippingAddress" type="radio" class="form-check-input">
                                                        <label class="form-check-label" for="shippingAddress02">
                                                            <span class="mb-4 fw-semibold d-block text-muted text-uppercase">Office Address</span>

                                                            <span class="fs-14 mb-2 d-block">James Honda</span>
                                                            <span class="text-muted fw-normal text-wrap mb-1 d-block">1246 Virgil Street Pensacola, FL 32501</span>
                                                            <span class="text-muted fw-normal d-block">Mo. 012-345-6789</span>
                                                        </label>
                                                    </div>
                                                    <div class="d-flex flex-wrap p-2 py-1 bg-light rounded-bottom border mt-n1">
                                                        <div>
                                                            <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#addAddressModal"><i class="ri-pencil-fill text-muted align-bottom me-1"></i> Edit</a>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#removeItemModal"><i class="ri-delete-bin-fill text-muted align-bottom me-1"></i> Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <h5 class="fs-14 mb-3">Shipping Method</h5>

                                                <div class="row g-4">
                                                    <div class="col-lg-6">
                                                        <div class="form-check card-radio">
                                                            <input id="shippingMethod01" name="shippingMethod" type="radio" class="form-check-input" checked>
                                                            <label class="form-check-label" for="shippingMethod01">
                                                                <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">Free</span>
                                                                <span class="fs-14 mb-1 text-wrap d-block">Free Delivery</span>
                                                                <span class="text-muted fw-normal text-wrap d-block">Expected Delivery 3 to 5 Days</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-check card-radio">
                                                            <input id="shippingMethod02" name="shippingMethod" type="radio" class="form-check-input" checked>
                                                            <label class="form-check-label" for="shippingMethod02">
                                                                <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">$24.99</span>
                                                                <span class="fs-14 mb-1 text-wrap d-block">Express Delivery</span>
                                                                <span class="text-muted fw-normal text-wrap d-block">Delivery within 24hrs.</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3 mt-4">
                                            <button type="button" class="btn btn-light btn-label previestab" data-previous="pills-bill-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back to Personal Info</button>
                                            <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-payment-tab"><i class="ri-bank-card-line label-icon align-middle fs-16 ms-2"></i>Continue to Payment</button>
                                        </div>
                                    </div> --}}
                                    <!-- end tab pane -->

                                    <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">


                                        <div class="d-flex align-items-start gap-3 mt-4">
                                            <button type="button" class="btn btn-light btn-label previestab" data-previous="pills-bill-address-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back to Shipping</button>
                                            <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-finish-tab"><i class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Complete Order</button>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    {{-- <div class="tab-pane fade" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
                                        <div class="text-center py-5">

                                            <div class="mb-4">
                                                <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
                                            </div>
                                            <h5>Thank you ! Your Order is Completed !</h5>
                                            <p class="text-muted">You will receive an order confirmation email with details of your order.</p>

                                            <h3 class="fw-semibold">Order ID: <a href="apps-ecommerce-order-details.html" class="text-decoration-underline">VZ2451</a></h3>
                                        </div>
                                    </div> --}}
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-4">
                    <div class="sticky-side-div">

                        <div class="alert border-dashed alert-success" role="alert">
                            <div class="d-flex align-items-center">
                                <lord-icon src="https://cdn.lordicon.com/nkmsrxys.json" trigger="loop" colors="primary:#121331,secondary:#f06548" style="width:80px;height:80px"></lord-icon>
                                <div class="ms-2">
                                    <h5 class="fs-14 text-danger fw-semibold"> Note importante !!</h5>
                                    <p class="text-black mb-1">Cumulez des points (Bonus) pour obtenir des coupons de  <br />réductions de <span class="fw-semibold">30%</span> sur votre prochaine réservation </p>
                                    {{-- <button type="button" class="btn ps-0 btn-sm btn-link text-danger text-uppercase">Add Gift Wrap</button> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0">Sommes de la reservation</h5>
                            </div>

                            <div class="card-header bg-light-subtle border-bottom-dashed">
                                <div class="text-center">
                                    <h6 class="mb-2">As-tu un code <span class="fw-semibold">promo</span>  ?</h6>
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
                                            {{-- <tr>
                                                <td class="text-center text-warning" id="cart-subtotal">La mains d'oeuvre varie selon la commune </td>
                                            </tr> --}}

                                            {{-- <tr>
                                                <td>Ville :</td>
                                                <td class="text-end" id="cart-subtotal">Abidjan / 15.000 fcfa</td>
                                            </tr> --}}

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
                                <!-- end table-responsive -->
                            </div>
                        </div>
                    </div>
                    <!-- end stickey -->

                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
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

        // Récupération des informations
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

        // Si aucune commune trouvée
        if (!commune) {
           @this.set('select_commune', null)
        }

        // Création de l'objet JSON
        var location = {
            adresse: adresse_complete,
            adresse_name: adresse_name,
            latitude: latitude,
            longitude: longitude
        };



        // Transfert temporaire vers Livewire et ouverture du modal
        @this.set('adresse_livraison', adresse_name + ' ' + adresse_complete)
        @this.set('select_commune', commune)

        // Ouvrir le modal pour confirmation de position
        @this.call('openPositionModal', adresse_name + ' ' + adresse_complete, location);
    });
}

// Écouter la confirmation de position
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

// Réinitialiser les variables à chaque ouverture
window.addEventListener('openMapModal', function(event) {
    // Reset complet
    map = null;
    marker = null;

    setTimeout(() => {
        initializeMap(event.detail.location);
    }, 300);
});

function initializeMap(location) {
    const mapLoader = document.getElementById('mapLoader');

    // Position initiale (depuis l'adresse sélectionnée)
    const initialPos = location ? {
        lat: parseFloat(location.latitude),
        lng: parseFloat(location.longitude)
    } : { lat: 5.316667, lng: -4.033333 };

    // Créer la carte
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

    // Créer le marqueur draggable
    marker = new google.maps.Marker({
        position: initialPos,
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        icon: {
            url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
            scaledSize: new google.maps.Size(50, 50)
        },
        title: "Votre position"
    });

    // Masquer le loader
    if (mapLoader) mapLoader.style.display = 'none';

    // Mettre à jour l'adresse lors du déplacement du marqueur
    google.maps.event.addListener(marker, 'dragend', function() {
        updateAddressFromMarker(marker.getPosition());
    });

    // Permettre de cliquer sur la carte pour déplacer le marqueur
    google.maps.event.addListener(map, 'click', function(event) {
        marker.setPosition(event.latLng);
        updateAddressFromMarker(event.latLng);
    });

    // Initialiser l'affichage de l'adresse
    updateAddressFromMarker(marker.getPosition());

    // Attacher les boutons APRÈS la création de la carte
    attachModalButtons();
}

function updateAddressFromMarker(position) {
    const geocoder = new google.maps.Geocoder();
    const coordsDisplay = document.getElementById('selectedCoords');

    // Gérer les deux types de position
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

    // Géocodage inverse
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
    // Bouton "Ma position actuelle"
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

    // Bouton "Confirmer"
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

                    // Envoyer au composant Livewire - MÉTHODE CORRIGÉE
                    @this.call('confirmPosition', finalLocation);

                    // Ou si emit ne marche pas, utilise cette alternative :
                    // window.livewire.find('{{ $_instance->getId() }}').call('confirmPosition', finalLocation);
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
/* Styles pour le modal et la carte */
#map {
    border-radius: 0;
}

.gm-style-iw {
    border-radius: 8px !important;
}

.gm-style-iw-d {
    overflow: hidden !important;
}

/* Animation d'entrée du modal */
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
</style>






<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@20.0.4/build/js/intlTelInput.min.js"></script>
<script>
    const input = document.querySelector("#phone");

    //je souhaite aussi augmenter la largeur de mon input
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

    // Fonction pour récupérer le dial code et le numéro
    function getDialCode() {
        const countryData = iti.getSelectedCountryData();
        const phoneNumber = input.value; // Récupère la valeur actuelle du champ input
    }

    function sendPhoneData() {
        var phoneNumber = iti.getNumber();
        @this.set('contact_livraison',phoneNumber);
        @this.set('dialCode', iti.getSelectedCountryData().dialCode);

    }

    // Écouteur d’événement sur le champ input et sur le changement de pays
    input.addEventListener("countrychange", getDialCode);
    input.addEventListener("input", getDialCode);
</script>



@endpush
