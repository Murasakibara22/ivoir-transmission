<div>
    {{-- ========================================
        MODAL POSITION GPS
    ======================================== --}}
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
                            👆 Cliquez sur la carte ou déplacez le marqueur
                        </p>
                    </div>
                    <button onclick="@this.call('closePositionModal')"
                            class="btn btn-sm btn-light rounded-circle p-2"
                            style="width: 35px; height: 35px;">
                        <i class="ri-close-line fs-5"></i>
                    </button>
                </div>
            </div>

            <div class="flex-grow-1" style="overflow-y: auto;">
                <div class="position-relative" style="height: 450px;">
                    <div id="map" style="width: 100%; height: 100%;"></div>
                    <div id="mapLoader" class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-primary"></div>
                    </div>
                </div>

                <div class="p-4 bg-light border-top">
                    <label class="form-label small text-muted mb-2">Rechercher une adresse :</label>
                    <input type="text"
                           id="autocomplete-modal"
                           class="form-control mb-3"
                           placeholder="Tapez une adresse..."
                           autocomplete="off">

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
                    <button onclick="@this.call('closePositionModal')" class="btn btn-light order-3 order-sm-1">
                        <i class="ri-arrow-left-line me-2"></i>Retour
                    </button>
                    <button type="button" id="useCurrentLocation" class="btn btn-outline-primary order-2 order-sm-2">
                        <i class="ri-focus-3-line me-2"></i>Ma position GPS
                    </button>
                    <button type="button" id="confirmPositionBtn" class="btn btn-primary flex-sm-fill order-1 order-sm-3">
                        <i class="ri-check-line me-2"></i>Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ========================================
        MODAL SOS EXPRESS
    ======================================== --}}
    @if($showSosModal)
    <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.8);">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title d-flex align-items-center">
                        <span class="badge bg-white text-danger me-2">🚨 SOS</span>
                        Dépannage Express
                    </h5>
                    <button type="button" wire:click="closeSosModal" class="btn-close btn-close-white"></button>
                </div>

                <div class="modal-body p-4">
                    {{-- Progress steps --}}
                    <div class="d-flex justify-content-between mb-4">
                        <div class="text-center flex-fill">
                            <div class="rounded-circle mx-auto mb-2 {{ $sosStep >= 1 ? 'bg-danger text-white' : 'bg-light text-muted' }}"
                                 style="width: 40px; height: 40px; line-height: 40px;">
                                @if($sosStep > 1) ✓ @else 1 @endif
                            </div>
                            <small class="text-muted">Position</small>
                        </div>
                        <div class="flex-fill" style="height: 2px; background: #dee2e6; margin-top: 20px;"></div>
                        <div class="text-center flex-fill">
                            <div class="rounded-circle mx-auto mb-2 {{ $sosStep >= 2 ? 'bg-danger text-white' : 'bg-light text-muted' }}"
                                 style="width: 40px; height: 40px; line-height: 40px;">
                                @if($sosStep > 2) ✓ @else 2 @endif
                            </div>
                            <small class="text-muted">Problème</small>
                        </div>
                        <div class="flex-fill" style="height: 2px; background: #dee2e6; margin-top: 20px;"></div>
                        <div class="text-center flex-fill">
                            <div class="rounded-circle mx-auto mb-2 {{ $sosStep >= 3 ? 'bg-danger text-white' : 'bg-light text-muted' }}"
                                 style="width: 40px; height: 40px; line-height: 40px;">
                                3
                            </div>
                            <small class="text-muted">Confirmation</small>
                        </div>
                    </div>

                    {{-- ÉTAPE 1 : LOCALISATION --}}
                    @if($sosStep === 1)
                    <div class="sos-step">
                        <h6 class="mb-4 text-center">📍 Où êtes-vous ?</h6>
                        <div class="d-grid gap-3 mb-3">
                            <button type="button" wire:click="openPositionModal" class="btn btn-danger btn-lg">
                                <i class="ri-map-pin-user-fill me-2"></i>Utiliser le GPS
                            </button>
                        </div>
                        @if($adresse_livraison)
                        <div class="alert alert-success">
                            <i class="ri-check-circle-line me-2"></i>{{ $adresse_livraison }}
                        </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Ou saisissez l'adresse</label>
                            <textarea wire:model="adresse_livraison" class="form-control" rows="2"></textarea>
                            @error('adresse_livraison')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @endif

                    {{-- ÉTAPE 2 : TYPE DE SERVICE --}}
                    @if($sosStep === 2)
                    <div class="sos-step">
                        <h6 class="mb-4 text-center">🔧 Quel est le problème ?</h6>
                        <div class="row g-3">
                            @foreach($list_service_select as $index => $cat)
                            <div class="col-6">
                                <input type="radio" class="btn-check" id="sos{{ $cat->id }}" wire:model="sosService" value="{{ $cat->id }}">
                                <label class="btn btn-outline-danger w-100 p-3 d-flex flex-column align-items-center" for="sos{{ $cat->id }}">
                                    <i class="ri-tools-fill fs-2 mb-2"></i>
                                    <strong class="text-center">{{ $cat->libelle }}</strong>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('sosService')<div class="alert alert-danger mt-3">{{ $message }}</div>@enderror

                        {{-- Photo du problème (facultatif) --}}
                        <div class="mt-4">
                            <label class="form-label">📸 Photo du problème (facultatif)</label>
                            <input type="file" wire:model="problemPhoto" accept="image/*" capture="environment" class="form-control">
                        </div>
                    </div>
                    @endif

                    {{-- ÉTAPE 3 : CONFIRMATION --}}
                    @if($sosStep === 3)
                    <div class="sos-step">
                        <h6 class="mb-4 text-center">✅ Récapitulatif</h6>
                        <div class="card bg-light border-0 mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>📍 Position</span>
                                    <strong>{{ Str::limit($adresse_livraison, 30) }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>🔧 Service</span>
                                    <strong>{{ $list_service_select->find($sosService)?->libelle ?? 'Service' }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>💰 Coût</span>
                                    <strong class="text-success">{{ number_format($montant_service, 0, ',', ' ') }} FCFA</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>⏱️ Arrivée</span>
                                    <strong class="text-danger">30-45 min</strong>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">📞 Votre numéro <span class="text-danger">*</span></label>
                            <input type="tel" wire:model="contact_livraison" class="form-control form-control-lg" placeholder="+225">
                            @error('contact_livraison')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @endif
                </div>

                <div class="modal-footer border-0 bg-light">
                    @if($sosStep > 1)
                    <button type="button" wire:click="sosPreviousStep" class="btn btn-light">
                        <i class="ri-arrow-left-line me-1"></i> Retour
                    </button>
                    @endif
                    @if($sosStep < 3)
                    <button type="button" wire:click="sosNextStep" class="btn btn-danger">
                        Continuer <i class="ri-arrow-right-line ms-1"></i>
                    </button>
                    @else
                    <button type="button" wire:click="confirmSosBooking" class="btn btn-danger btn-lg" wire:loading.attr="disabled">
                        <span wire:loading.remove>🚨 Confirmer</span>
                        <span wire:loading><span class="spinner-border spinner-border-sm me-2"></span>En cours...</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ========================================
        PAGE PRINCIPALE
    ======================================== --}}
    <div class="page-content">
        <div class="container-fluid">
            {{-- Breadcrumb --}}
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

            {{-- ASSISTANT VOCAL TOGGLE --}}
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="ri-volume-up-line text-primary fs-3 me-3"></i>
                                    <div>
                                        <h6 class="mb-0">Assistant Vocal</h6>
                                        <small class="text-muted">Activez pour être guidé vocalement</small>
                                    </div>
                                </div>
                                <div class="form-check form-switch form-switch-lg">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           role="switch"
                                           id="voiceAssistant"
                                           wire:model.live="voiceAssistantEnabled"
                                           wire:click="toggleVoiceAssistant">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOGGLE : Normal vs SOS --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-center">
                                <div class="btn-group btn-group-lg" role="group">
                                    <input type="radio" class="btn-check" id="normalBooking" wire:model="bookingType" value="normal" checked>
                                    <label class="btn btn-outline-primary px-4" for="normalBooking">
                                        <i class="ri-calendar-check-line me-2"></i>Réservation planifiée
                                    </label>
                                    <input type="radio" class="btn-check" id="sosBooking" wire:model="bookingType" value="sos">
                                    <label class="btn btn-outline-danger px-4" for="sosBooking" wire:click="switchBookingType('sos')">
                                        <i class="ri-alarm-warning-fill me-2"></i>🚨 SOS Express
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORMULAIRE NORMAL --}}
            @if($bookingType === 'normal')
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent="makeReservation">
                                {{-- SECTION : Informations RDV --}}
                                <div class="mb-4">
                                    <h5 class="text-primary mb-3">
                                        <i class="ri-information-line me-2"></i>INFORMATIONS SUR LE RENDEZ-VOUS
                                    </h5>
                                </div>

                                <div class="row">
                                    {{-- Adresse avec autocomplete Google Maps --}}
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Situation géographique <span class="text-danger">*</span></label>
                                        <input type="text"
                                               id="autocomplete"
                                               wire:model="adresse_livraison"
                                               class="form-control"
                                               placeholder="Recherchez votre adresse..."
                                               autocomplete="off">
                                        @error('adresse_livraison')<span class="text-danger small">{{ $message }}</span>@enderror
                                        @if($select_commune)
                                            <div class="text-success mt-1 small">
                                                <i class="ri-map-pin-line"></i> Commune détectée : <strong>{{ $select_commune }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Date --}}
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <select class="form-select" wire:model="date_rdv" @if(!$adresse_livraison) disabled @endif>
                                            <option value="">Sélectionnez...</option>
                                            @if($joursAutorises && count($joursAutorises) > 0)
                                                @foreach($joursAutorises as $date => $label)
                                                    <option value="{{ $date }}">{{ $label }}</option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>Veuillez d'abord sélectionner une adresse</option>
                                            @endif
                                        </select>
                                        @if(!$adresse_livraison)
                                            <div class="text-danger mt-1 small">
                                                <i class="ri-information-line"></i> Sélectionnez d'abord votre position pour voir les dates disponibles
                                            </div>
                                        @elseif(empty($joursAutorises))
                                            <div class="text-warning mt-1 small">
                                                <i class="ri-error-warning-line"></i> Aucune date disponible pour cette commune
                                            </div>
                                        @endif
                                        @error('date_rdv')<span class="text-danger small">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Heure --}}
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Heure <span class="text-danger">*</span></label>
                                        <input type="time" wire:model="time_rdv" class="form-control">
                                        @error('time_rdv')<span class="text-danger small">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                {{-- SECTION : Catégorie de service --}}
                                <div class="mt-4 mb-4">
                                    <h5 class="text-primary mb-3">
                                        <i class="ri-service-line me-2"></i>TYPE DE SERVICE
                                    </h5>
                                </div>

                                <div class="row g-3 mb-4">
                                    @foreach($list_service_select as $cat)
                                    <div class="col-md-4 col-6">
                                        <input type="radio" class="btn-check" id="cat{{ $cat->id }}" wire:model.live="categorie" value="{{ $cat->id }}">
                                        <label class="btn btn-outline-primary w-100 h-100 p-3 d-flex flex-column align-items-center" for="cat{{ $cat->id }}">
                                            <i class="ri-service-fill fs-2 mb-2"></i>
                                            <strong class="text-center">{{ $cat->libelle }}</strong>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                                {{-- Services détaillés --}}
                                @if($categorie)
                                @php $selectedCategory = $list_service_select->find($categorie); @endphp
                                @if($selectedCategory && $selectedCategory->services->count() > 0)
                                <div class="mb-4">
                                    <h6 class="mb-3">Services disponibles :</h6>
                                    @foreach($selectedCategory->services as $service)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" wire:model.live="select_service" value="{{ $service->id }}" id="s{{ $service->id }}">
                                        <label class="form-check-label w-100 d-flex justify-content-between" for="s{{ $service->id }}">
                                            <span>{{ $service->libelle }}</span>
                                            <span class="badge bg-primary">+{{ number_format($service->prix, 0, ',', ' ') }} FCFA</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                                @endif

                                {{-- SECTION : Véhicule --}}
                                <div class="mt-4 mb-4">
                                    <h5 class="text-primary mb-3">
                                        <i class="ri-car-line me-2"></i>VÉHICULE
                                    </h5>
                                </div>

                                {{-- Choix du mode --}}
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="card h-100 border-2 {{ $inputMode === 'scan' ? 'border-primary' : '' }}" style="cursor: pointer;" wire:click="setInputMode('scan')">
                                            <div class="card-body text-center p-3">
                                                <i class="ri-camera-line fs-1 mb-2"></i>
                                                <h6>Scanner chassis</h6>
                                                <small class="text-muted">Photo automatique</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100 border-2 {{ $inputMode === 'manual' ? 'border-primary' : '' }}" style="cursor: pointer;" wire:click="setInputMode('manual')">
                                            <div class="card-body text-center p-3">
                                                <i class="ri-edit-line fs-1 mb-2"></i>
                                                <h6>Saisie manuelle</h6>
                                                <small class="text-muted">Entrer les infos</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Mode SCAN --}}
                                @if($inputMode === 'scan')
                                <div class="scan-section mb-4">
                                    @if($chassisImage)
                                    <div class="text-center">
                                        <img src="{{ $chassisImage->temporaryUrl() }}" class="img-fluid rounded mb-3" style="max-height: 200px;">
                                        @if(!$ocrSuccess)
                                        <div class="d-grid gap-2">
                                            <button type="button" wire:click="processOCR" class="btn btn-primary" wire:loading.attr="disabled">
                                                <span wire:loading.remove>Analyser</span>
                                                <span wire:loading>Analyse...</span>
                                            </button>
                                            <button type="button" wire:click="removeChassisImage" class="btn btn-outline-danger btn-sm">Supprimer</button>
                                        </div>
                                        @endif
                                        @if($ocrSuccess)
                                        <div class="alert alert-success">✅ Scan réussi !</div>
                                        @endif
                                    </div>
                                    @else
                                    <div class="border-dashed rounded p-4 text-center" style="cursor: pointer;" onclick="document.getElementById('chassisImg').click()">
                                        <i class="ri-upload-cloud-line display-4 text-primary"></i>
                                        <p class="mb-0">Cliquez pour prendre une photo</p>
                                        <input type="file" id="chassisImg" wire:model="chassisImage" accept="image/*" capture="environment" class="d-none">
                                    </div>
                                    @endif
                                </div>
                                @endif

                                {{-- Mode MANUEL --}}
                                @if($inputMode === 'manual')
                                <div class="manual-section mb-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">N° Chassis</label>
                                            <input type="text" wire:model="chassis" class="form-control" placeholder="17 caractères">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Marque</label>
                                            <input type="text" wire:model="select_marque" class="form-control" placeholder="Ex: Toyota">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Modèle</label>
                                            <input type="text" wire:model="select_type" class="form-control" placeholder="Ex: Corolla">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Année</label>
                                            <input type="text" wire:model="year_vehicule" class="form-control" placeholder="Ex: 2020">
                                        </div>
                                    </div>
                                </div>
                                @endif

                                {{-- SECTION : Contact --}}
                                <div class="mt-4 mb-4">
                                    <h5 class="text-primary mb-3">
                                        <i class="ri-contacts-line me-2"></i>CONTACT
                                    </h5>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nom</label>
                                        <input type="text" wire:model="username" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                                        <input type="tel" wire:model="contact_livraison" class="form-control" placeholder="+225">
                                        @error('contact_livraison')<span class="text-danger small">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" wire:model="email_livraison" class="form-control">
                                    </div>
                                </div>

                                {{-- Bouton validation --}}
                                <div class="mt-4 d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                                        <span wire:loading.remove>✅ Confirmer la réservation</span>
                                        <span wire:loading><span class="spinner-border spinner-border-sm me-2"></span>En cours...</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Sidebar résumé --}}
                <div class="col-xl-4">
                    <div class="card sticky-top" style="top: 100px;">
                        <div class="card-header">
                            <h5 class="mb-0">Résumé</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <small>🎁 Cumulez des points pour des réductions de 30%</small>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Mains d'œuvres</span>
                                <strong>50,000 FCFA</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total</strong>
                                <strong class="text-primary">{{ number_format($montant_service, 0, ',', ' ') }} FCFA</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- BOUTON FLOTTANT SOS --}}
    <button wire:click="switchBookingType('sos')" class="btn btn-danger btn-lg rounded-circle position-fixed" style="bottom: 30px; right: 30px; width: 70px; height: 70px; z-index: 1000; box-shadow: 0 10px 30px rgba(220,53,69,0.4);">
        <i class="ri-alarm-warning-fill fs-3"></i>
        <div class="small fw-bold">SOS</div>
    </button>
</div>

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwmz2CstWs-2hp_ygHYc527i7XBgIrNJg&libraries=places&callback=initMap" async defer></script>

<script>
// Initialisation de l'autocomplete Google Maps
async function initMap() {
    var input = document.getElementById('autocomplete');
    if (input) {
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
               @this.set('select_commune', null);
            }

            // Création de l'objet location
            var location = {
                adresse: adresse_complete,
                adresse_name: adresse_name,
                latitude: latitude,
                longitude: longitude
            };

            // Transfert vers Livewire et ouverture du modal
            @this.set('adresse_livraison', adresse_name + ' ' + adresse_complete);
            @this.set('select_commune', commune);

            // Ouvrir le modal pour confirmation de position
            @this.call('openPositionModal', adresse_name + ' ' + adresse_complete, location);
        });
    }
}

// Initialiser l'autocomplete du modal quand il s'ouvre
window.addEventListener('openMapModal', function() {
    setTimeout(function() {
        var inputModal = document.getElementById('autocomplete-modal');
        if (inputModal && window.google) {
            const options = {
                componentRestrictions: { country: "ci" },
            };

            var autocompleteModal = new google.maps.places.Autocomplete(inputModal, options);

            autocompleteModal.addListener('place_changed', function () {
                var place = autocompleteModal.getPlace();

                if (!place.geometry) {
                    return;
                }

                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();

                // Déplacer le marker sur la carte
                if (window.marker) {
                    var newPos = {lat: latitude, lng: longitude};
                    window.marker.setPosition(newPos);
                    window.map.setCenter(newPos);
                    updateAddress(newPos);
                }
            });
        }
    }, 500);
});

// Écouter la confirmation de position
window.addEventListener('positionConfirmed', function() {
    const input = document.getElementById('autocomplete');
    if (input) {
        input.classList.add('border-success');
        setTimeout(() => input.classList.remove('border-success'), 2000);
    }
});

// Assistant Vocal
let voiceAssistant = {
    enabled: @json($voiceAssistantEnabled),
    synthesis: window.speechSynthesis,

    speak(text) {
        if (!this.enabled) return;
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'fr-FR';
        utterance.rate = 0.9;
        this.synthesis.speak(utterance);
    }
};

// Écouter les événements Livewire
window.addEventListener('voiceAssistantToggled', event => {
    voiceAssistant.enabled = event.detail.enabled;
    voiceAssistant.speak(event.detail.message);
});

window.addEventListener('speakText', event => {
    voiceAssistant.speak(event.detail.text);
});

// Google Maps
let map, marker, geocoder;

window.addEventListener('openMapModal', function(event) {
    setTimeout(() => initializeMap(event.detail.location), 300);
});

function initializeMap(location) {
    const initialPos = location ? {lat: parseFloat(location.latitude), lng: parseFloat(location.longitude)} : {lat: 5.316667, lng: -4.033333};

    window.map = new google.maps.Map(document.getElementById('map'), {
        center: initialPos,
        zoom: 16
    });

    window.marker = new google.maps.Marker({
        position: initialPos,
        map: window.map,
        draggable: true
    });

    document.getElementById('mapLoader').style.display = 'none';

    window.marker.addListener('dragend', () => updateAddress(window.marker.getPosition()));
    window.map.addListener('click', (e) => {
        window.marker.setPosition(e.latLng);
        updateAddress(e.latLng);
    });

    updateAddress(window.marker.getPosition());
    attachButtons();
}

function updateAddress(position) {
    const lat = typeof position.lat === 'function' ? position.lat() : position.lat;
    const lng = typeof position.lng === 'function' ? position.lng() : position.lng;

    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({location: {lat, lng}}, (results, status) => {
        if (status === 'OK' && results[0]) {
            document.getElementById('selectedAddress').textContent = results[0].formatted_address;
            document.getElementById('selectedCoords').textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        }
    });
}

function attachButtons() {
    document.getElementById('useCurrentLocation')?.addEventListener('click', function() {
        if (navigator.geolocation) {
            this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Localisation...';
            this.disabled = true;

            navigator.geolocation.getCurrentPosition(pos => {
                const position = {lat: pos.coords.latitude, lng: pos.coords.longitude};
                window.map.setCenter(position);
                window.marker.setPosition(position);
                updateAddress(position);
                this.innerHTML = '<i class="ri-check-line me-2"></i>Position obtenue !';
                this.disabled = false;
            }, () => {
                alert('Impossible d\'obtenir votre position');
                this.innerHTML = '<i class="ri-focus-3-line me-2"></i>Ma position GPS';
                this.disabled = false;
            });
        }
    });

    document.getElementById('confirmPositionBtn')?.addEventListener('click', function() {
        const position = window.marker.getPosition();
        const geocoder = new google.maps.Geocoder();

        this.disabled = true;

        geocoder.geocode({location: position}, (results, status) => {
            if (status === 'OK' && results[0]) {
                let commune = "";
                results[0].address_components.forEach(component => {
                    if (component.types.includes("sublocality") || component.types.includes("sublocality_level_1")) {
                        commune = component.long_name;
                    }
                });

                const locationData = {
                    adresse: results[0].formatted_address,
                    latitude: position.lat(),
                    longitude: position.lng(),
                    adresse_name: results[0].name || results[0].address_components[0]?.long_name || ''
                };

                @this.call('confirmPosition', locationData);

                if (commune) {
                    @this.set('select_commune', commune);
                }
            }
        });
    });
}
</script>

<style>
.border-dashed {
    border: 2px dashed #dee2e6;
}
.form-switch-lg .form-check-input {
    width: 3rem;
    height: 1.5rem;
}
.btn-check:checked + .btn-outline-primary,
.btn-check:checked + .btn-outline-danger {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
</style>
@endpush
