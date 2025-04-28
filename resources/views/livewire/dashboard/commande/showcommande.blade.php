<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Détails Commandes</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Tableau de bord</a></li>
                                <li class="breadcrumb-item active">Détails Commandes</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Commande #{{$show_commande->reference}}</h5>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('dashboard.orders.invoice', $show_commande->slug) }}"  class="btn btn-success btn-sm"><i class="ri-download-2-fill align-middle me-1"></i> imprimer</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-nowrap align-middle table-borderless mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col">Produit Details</th>
                                            <th scope="col">Produit / Price</th>
                                            <th scope="col">Quantité</th>
                                            <th scope="col">Notes</th>
                                            <th scope="col" class="text-end">Montant Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @if($produits_cart)
                                            @foreach($produits_cart as $produit)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                            <img src="{{ isset($produit['images']) ? json_decode($produit['images'])[0] : "" }}" alt="" class="img-fluid d-block">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="fs-15"><a href="{{ route('dashboard.produits.show', $produit['slug']) }} }}" class="link-primary">{{ Illuminate\Support\Str::limit($produit['libelle'], 25,'...') }}</a></h5>
                                                            <p class="text-muted mb-0">Taille: <span class="fw-medium">{{ $produit['taille'] ?? "Non specifier" }}</span></p>
                                                            <p class="text-muted mb-0">Type: <span class="fw-medium">{{ $produit['description'] ?? "Non specifier"}} </span></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($produit['prix_unitaire'], 0, ',','.') }} fcfa</td>
                                                <td>{{ $produit['quantite'] }}</td>
                                                <td>
                                                   0
                                                </td>
                                                <td class="fw-medium text-end">
                                                    {{ number_format($produit['total'],0, ',','.') }} fcfa
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        <tr class="border-top border-top-dashed">
                                            <td colspan="3"></td>
                                            <td colspan="2" class="fw-medium p-0">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>Sous Total :</td>
                                                            <td class="text-end">{{ number_format($show_commande->montant,0, ',','.') }} fcfa</td>
                                                        </tr>

                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row">Total  :</th>
                                                            <th class="text-end text-success h5">{{ number_format($show_commande->montant,0, ',','.') }} fcfa</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Status de la commande</h5>
                                <div class="flex-shrink-0 mt-2 mt-sm-0">
                                    @if($show_commande->status == "ANNULER")
                                    <button type="button" disabled class="btn btn-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Annnuler</button>
                                    @else
                                        @if($show_commande->status == "TERMINEE" || $show_commande->status == "VALIDEE")
                                            <button type="button" disabled class="btn btn-info btn-sm mt-2 mt-sm-0"><i class="ri-map-pin-line align-middle me-1"></i> Valider la commande</button>
                                        @else
                                            <a href="javasccript:void(0;)" wire:click="validateOrder" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"><i class="ri-map-pin-line align-middle me-1"></i> Valider la commande</a>
                                        @endif


                                        @if($show_commande->status == "VALIDEE" || $show_commande->status == "TERMINEE")
                                            <button type="button" disabled class="btn btn-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Annnuler</button>
                                        @else
                                            <a href="javasccript:void(0;)" wire:click="cancelOrder" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Annnuler</a>
                                        @endif

                                        @if($show_commande->status != "VALIDEE" || $show_commande->status == "ANNULER")
                                            <button type="button" disabled class="btn btn-success btn-sm mt-2 mt-sm-0"><i class="mdi mdi-check align-middle me-1"></i> Terminer</button>
                                        @else
                                            <a href="javasccript:void(0;)" wire:click="finishOrder" class="btn btn-soft-success btn-sm mt-2 mt-sm-0"><i class="mdi mdi-check align-middle me-1"></i> Terminer</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="profile-timeline">
                                <div class="accordion accordion-flush" id="accordionFlushExample">

                                    @if($show_commande->status != "ANNULER")

                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingOne">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title @if($show_commande->status == "en attente" ) bg-warning @elseif($show_commande->status == "TERMINEE") bg-success @elseif($show_commande->status == "VALIDEE") bg-primary @endif rounded-circle">
                                                                <i class="ri-shopping-bag-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-0 fw-semibold"> En attente - <span class="fw-normal">{{ $show_commande->created_at }}</span></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <h6 class="mb-1">Une commande a été placer.</h6>
                                                    <p class="text-muted">{{$show_commande->created_at}} - </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingThree">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title @if($show_commande->status == "TERMINEE") bg-success @elseif($show_commande->status == "VALIDEE") bg-primary @else bg-light text-success @endif rounded-circle">
                                                                <i class="ri-truck-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-1 fw-semibold">Valider - <span class="fw-normal">{{ $show_commande->validated_at }}</span></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <p class="text-muted mb-0">{{ $show_commande->validated_at }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingTwo">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title @if($show_commande->status == "TERMINEE") bg-success @else bg-light text-success @endif rounded-circle">
                                                                <i class="mdi mdi-gift-outline"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-1 fw-semibold">Livrer - <span class="fw-normal">{{ $show_commande->delivery_at }}</span></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <h6 class="mb-1">Votre commande a été livrer</h6>
                                                    <p class="text-muted mb-0">{{ $show_commande->delivery_at }}</p>
                                                </div>
                                            </div>
                                        </div>

                                    @else

                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingOne">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title  bg-danger rounded-circle">
                                                                <i class="ri-shopping-bag-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-0 fw-semibold">La commande a été Annuler </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    @endif

                                </div>
                                <!--end accordion-->
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i>Livraison Details</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                                @if($show_commande->date_delivery)
                                <h5 class="fs-16 mt-2">Adresse: {{$show_commande->adresse}} </h5>
                                <p class="text-muted mb-0">Date : {{ $show_commande->date_delivery }}</p>
                                @else
                                <h5>Récuperation dans nos point relais</h5>
                                @endif
                                <p class="text-muted mb-0"> Méthode de paiement : {{ $show_commande->methode_payment }}</p>
                            </div>
                        </div>
                    </div>
                    <!--end card-->

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">Détails Utilisateur</h5>
                                <div class="flex-shrink-0">
                                    <a href="javascript:void(0);" class="link-secondary">Voir le profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 vstack gap-3">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $show_commande->user()->first()->photo_url ?? "https://api.dicebear.com/7.x/initials/svg?seed=$show_commande->user()->first()->username" }}" alt="" class="avatar-sm rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-1">{{ $show_commande->user()->first()->username }}</h6>
                                            <p class="text-muted mb-0">Client</p>
                                        </div>
                                    </div>
                                </li>
                                <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $show_commande->user()->first()->email }}</li>
                                <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>+({{ $show_commande->user()->first()->dial_code }}) {{ $show_commande->user()->first()->phone_number }}</li>
                            </ul>
                        </div>
                    </div>



                    @if($show_commande->paiements()->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i> Détails Paiements</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Transactions:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0 fs-10">#{{ $show_commande->paiements()->first()->reference }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Méthode de P:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ $show_commande->methode_payment }}</h6>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Total Amount:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ number_format($show_commande->paiements()->first()->montant, 0) }}  FCFA</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--end card-->
                </div>
                <!--end col-->
            </div>

        </div>
    </div>



     <!-- Moddal -->
     <div wire:ignore.self class="modal fade" tabindex="-1" id="print-commande" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">

                <div class="modal-body">


                    <div class="row justify-content-center">
                        <div class="col-xxl-12">
                            <div class="card" id="demo">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-header border-bottom-dashed p-4">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <img src="{{ asset('frontend/assets/logo.jpeg') }}" class="card-logo card-logo-dark" alt="logo dark" height="79">
                                                    <img src="{{ asset('frontend/assets/logo.jpeg') }}" class="card-logo card-logo-light" alt="logo light" height="79">
                                                    <div class="mt-sm-5 mt-4">
                                                        <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                                        <p class="text-muted mb-1" id="address-details">Cocody, rivera palmeraie</p>
                                                        <p class="text-muted mb-0" id="zip-code"><span>contact:</span> +(01) 234 6789</p>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                                    {{-- <h6><span class="text-muted fw-normal">Legal Registration No:</span><span id="legal-register-no">987654</span></h6> --}}
                                                    <h6><span class="text-muted fw-normal">Email:</span><span id="email">infos@twinshair.com</span></h6>
                                                    <h6><span class="text-muted fw-normal">Site web:</span> <a href="https://themesbrand.com/" class="link-primary" target="_blank" id="website">www.twinshair-ci.com</a></h6>
                                                    <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span id="contact-no"> +(07) 07 582 935 71</span></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-header-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="row g-3">
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Réference</p>
                                                    <h5 class="fs-14 mb-0">#<span id="invoice-no">{{$show_commande->reference}}</span></h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                                    <h5 class="fs-14 mb-0"><span id="invoice-date">{{ date('d, M Y', strtotime($show_commande->created_at)) }}</span> <small class="text-muted" id="invoice-time">{{ date('H:i', strtotime($show_commande->created_at)) }}</small></h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Status Pay</p>
                                                    @if($show_commande->status == "TERMINEE")
                                                    <span class="badge badge-soft-success fs-11" id="payment-status">régler</span>
                                                    @else
                                                    <span class="badge badge-soft-warning fs-11" id="payment-status">non régler</span>
                                                    @endif
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Montant Total</p>
                                                    <h5 class="fs-14 mb-0"><span id="total-amount">{{$show_commande->montant }} fcfa </span></h5>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4 border-top border-top-dashed">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Adresse Clients</h6>
                                                    <p class="fw-medium mb-2" id="billing-name">{{$show_commande->user()->first()->username}}</p>
                                                    <p class="text-muted mb-1"><span>Contact: </span><span id="billing-phone-no">{{$show_commande->user()->first()->phone}}</span></p>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Adresse de Livraison</h6>
                                                    @if($show_commande->adresse == null)
                                                        <p class="fw-medium mb-2" id="shipping-name">Récupération sur place</p>
                                                    @else
                                                    <p class="text-muted mb-1" id="shipping-address-line-1">{{$show_commande->adresse}}</p>
                                                    {{-- <p class="text-muted mb-1"><span>Phone: +</span><span id="shipping-phone-no">(123) 456-7890</span></p> --}}
                                                    @endif
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="table-responsive">
                                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <th scope="col" style="width: 50px;">#</th>
                                                            <th scope="col">Produits Details</th>
                                                            <th scope="col">PU</th>
                                                            <th scope="col">Quantité</th>
                                                            <th scope="col" class="text-end">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="products-list">
                                                        @if($show_commande->produit()->get() && count($show_commande->produit()->get()) > 0)
                                                        @foreach($show_commande->produit()->get() as $key => $produit)
                                                        <tr>
                                                            <th scope="row">{{$key+1}}</th>
                                                            <td class="text-start">
                                                                <span class="fw-medium">{{ Illuminate\Support\Str::limit($produit->libelle, 20)}}</span>
                                                                @if($produit->variante_id != null)
                                                                    <p class="text-muted mb-0">Taille: <span class="fw-medium">{{ App\Models\VarianteProduit::find($produit->variante_id)->longeur ?? "" }}</span></p>
                                                                @endif
                                                                <p class="text-muted mb-0">Type: <span class="fw-medium">.... </span></p>
                                                            </td>
                                                            <td>{{ number_format($produit->prix_unitaire, 0, ',','.') }}</td>
                                                            <td>{{ $produit->quantite }}</td>
                                                            <td class="text-end">{{ number_format($produit->prix_total, 0, ',','.') }}</td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table><!--end table-->
                                            </div>
                                            <div class="border-top border-top-dashed mt-2">
                                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                                    <tbody>

                                                        <tr class="border-top border-top-dashed fs-15">
                                                            <th scope="row">Total</th>
                                                            <th class="text-end">{{$show_commande->montant}} fcfa</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end table-->
                                            </div>
                                            <div class="mt-3">
                                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Details Paiements:</h6>
                                                @if($show_commande->methode_payment == "cash" || $show_commande->methode_payment == "Cash")
                                                    <p class="text-muted mb-1">Method de paiement: <span class="fw-medium" id="payment-method">Cash</span></p>
                                                @else
                                                    <p class="text-muted mb-1">Method de paiement: <span class="fw-medium" id="payment-method">Mobile Money</span></p>
                                                @endif
                                            </div>

                                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                                <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Imprimer</a>
                                                <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Télécharger</a>
                                            </div>
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->


                </div>
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end modal-->

</div>



@push('styles')
<style>
    .feedback-text{
        width: 100%;
        margin-top: .25rem;
        font-size: .875em;
        color: #f06548;
    }
</style>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
@endpush
