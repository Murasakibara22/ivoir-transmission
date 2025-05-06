<div>
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

                            <form wire:submit.prevent='SubmitRendezVous'>
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

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="country" class="form-label">Communes <span class="text-danger">*</span> </label>
                                                        <select  class="form-select" id="country"  wire:model.live="select_commune">
                                                            <option value="">Sélectionnez...</option>
                                                            @if($list_commune && $list_commune->count() > 0)
                                                                @foreach($list_commune as $commune)
                                                                        <option value="{{$commune->id}}">{{$commune->nom}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    @error('select_commune') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-phone" class="form-label">Adresse <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" wire:model="adresse_livraison" placeholder="Renseignez une adresse" autocomplete="false" id="autocomplete">
                                                    </div>
                                                    @error('adresse_livraison') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>




                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-phone" class="form-label">Date du rendez-vous <span class="text-danger">*</span> </label>
                                                        <select  class="form-select" id="country"  wire:model.live="date_rdv">
                                                            <option value="">Sélectionnez...</option>
                                                            @if($joursAutorises && count($joursAutorises) > 0)
                                                                @foreach($joursAutorises as $date => $label)
                                                                    <option value="{{ $date }}">{{ $label }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    @error('date_rdv') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="billinginfo-phone" class="form-label">Heure du rendez-vous <span class="text-danger">*</span> </label>
                                                    <div class="mb-3">
                                                        <input type="time" wire:model="time_rdv" class="form-control" min="{{ now()->format('H:i') }}" placeholder="Enter  no.">
                                                    </div>
                                                </div>




                                                {{-- <div class="col-lg-6">
                                                    <div class="form-check card-radio">
                                                        <input id="shippingMethod01" name="shippingMethod" type="radio" class="form-check-input" checked="">
                                                        <label class="form-check-label" for="shippingMethod01">
                                                            <span class="fs-18 float-end mt-2 text-wrap d-block">{{number_format($montant_service,0,'.',' ')}} fcfa</span>
                                                            <span class="fs-14 mb-1 text-wrap text-primary d-block">Frais de services
                                                                </span>
                                                        </label>
                                                    </div>
                                                </div> --}}

                                            </div>

                                        </div>



                                        <div >
                                            <h5 class="mb-3 mt-5 text-primary">INFORMATIONS SUR LE VÉHICULE</h5>
                                        </div>


                                        <div>
                                            <div class="row mt-4">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="state" class="form-label">Marques <span class="text-muted"> (FACULTATIF)</span> </label>
                                                        <select class="form-select" id="state"  wire:model="select_marque">
                                                            <option value="">Selectionnez...</option>
                                                            @if($list_marque && $list_marque->count() > 0)
                                                            @foreach($list_marque as $marque)
                                                            <option value="{{$marque->id}}">{{$marque->libelle}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    @error('select_marque') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="country" class="form-label">Numéro de chassis<span class="text-danger">*</span> </label>
                                                        <input type="text" wire:model="chassis" class="form-control" id="billinginfo-firstName" placeholder="Entrer le numéro de chassis" autocomplete="false">
                                                    </div>
                                                    @error('chassis') <span class="text-danger">{{ $message }}</span> @enderror
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
                                                <h5 class="mb-1 mt-3 text-primary">Moyens de paiements</h5>
                                            </div>

                                            <div class="row g-4">

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
                                            </div>

                                            <div class="collapse show" id="paymentmethodCollapse">
                                                <div class="card p-4 border shadow-none mb-0 mt-4">
                                                    <div class="row gy-3">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="billinginfo-firstName" class="form-label">Nom & Prénoms <span class="text-muted">(FACULTATIF)</span> </label>
                                                                    <input type="text" wire:model="username" class="form-control" id="billinginfo-firstName" placeholder="Enter first name" value="">
                                                                </div>
                                                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="mb-3" wire:ignore>
                                                                    <label for="billinginfo-phone" class="form-label">Contact <span class="text-danger">*</span> </label>
                                                                    <input type="text" class="form-control"  wire:model="contact_livraison"  placeholder="Entrer votre numéro de téléphone...">
                                                                    {{-- <p id="output">Please enter a valid number below</p>            --}}
                                                                </div>
                                                                @error('contact_livraison') <span class="text-danger">{{ $message }}</span> @enderror

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="mb-3" wire:ignore>
                                                                    <label for="billinginfo-phone" class="form-label">Email <span class="text-muted">( FACULTATIF )</span> </label>
                                                                    <input type="text" class="form-control"  wire:model="email_livraison"  placeholder="Entrer votre adresse email...">
                                                                    {{-- <p id="output">Please enter a valid number below</p>            --}}
                                                                </div>
                                                                @error('email_livraison') <span class="text-danger">{{ $message }}</span> @enderror

                                                            </div>

                                                    </div>
                                                </div>
                                                <div class="text-success mt-2 fst-italic">
                                                    <i data-feather="lock" class="text-success icon-xs"></i> Votre transaction est sécurisée avec le cryptage SSL
                                                </div>
                                            </div>


                                            <div class="d-flex align-items-start gap-3 mt-3">
                                                <button type="submit" class="btn btn-primary btn-label right ms-auto nexttab">
                                                    <i class="ri-truck-line label-icon align-middle fs-16 ms-2"></i>Confirmez votre rendez-vous
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
                                    <h5 class="fs-14 text-danger fw-semibold"> Buying for a loved one?</h5>
                                    <p class="text-black mb-1">Gift wrap and personalised message on card, <br />Only for <span class="fw-semibold">$9.99</span> USD </p>
                                    <button type="button" class="btn ps-0 btn-sm btn-link text-danger text-uppercase">Add Gift Wrap</button>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0">Sommes de la reservation</h5>
                            </div>

                            <div class="card-body pt-2">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total :</td>
                                                <td class="text-end" id="cart-subtotal">{{ number_format($montant_service, 0, ',','.') }} fcfa </td>
                                            </tr>

                                            <tr>
                                                <td>Ville :</td>
                                                <td class="text-end" id="cart-subtotal">Abidjan / 15.000 fcfa</td>
                                            </tr>

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNZfIwGs9Y1hlRDCyiw3LV8dpLu1biIbM&libraries=places&callback=initMap" async></script>

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

            // Création de l'objet JSON
            var location = {
                adresse: adresse_complete,
                adresse_name: adresse_name,
                latitude: latitude,
                longitude: longitude
            };

            console.log("Location:", location);

            // Transfert vers Livewire
            @this.set('adresse_livraison', adresse_name + ' ' + adresse_complete)
            @this.set('location', location)
        });
    }
</script>






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
        console.log(iti.getNumber());
        var phoneNumber = iti.getNumber();
        @this.set('contact_livraison',phoneNumber);
        @this.set('dialCode', iti.getSelectedCountryData().dialCode);

    }

    // Écouteur d’événement sur le champ input et sur le changement de pays
    input.addEventListener("countrychange", getDialCode);
    input.addEventListener("input", getDialCode);
</script>



@endpush
