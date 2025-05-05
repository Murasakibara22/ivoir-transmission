<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Détails reservations</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Tableau de bord</a></li>
                                <li class="breadcrumb-item active">Détails reservations</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">

                            <div class="product-content">
                                <nav>
                                    <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab" href="#nav-speci" role="tab" aria-controls="nav-speci" aria-selected="true">Specification</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false" tabindex="-1">Details</a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-speci" role="tabpanel" aria-labelledby="nav-speci-tab">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;">
                                                            Services</th>
                                                        <td>{{$show_reservation->snapshot_services['libelle']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Adresse</th>
                                                        <td>{{$show_reservation->adresse_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">A faire le </th>
                                                        <td>{{$show_reservation->date_debut->format('d,M Y').'  à '.$show_reservation->date_debut->format('H:i') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Client</th>
                                                        <td> <a href="tel:{{$show_reservation->user->phone}}"> {{$show_reservation->user->phone}}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">A débuter à</th>
                                                        @if($show_reservation->start_at)
                                                        <td>{{$show_reservation->start_at->format('d,M Y').'  à '.$show_reservation->start_at->format('H:i') }}</td>
                                                        @else
                                                        <td class="text-danger">Non débutée</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">fini à</th>
                                                        @if($show_reservation->date_fin)
                                                        <td>{{$show_reservation->date_fin->format('d,M Y').'  à '.$show_reservation->date_fin->format('H:i') }}</td>
                                                        @else
                                                        <td class="text-danger">Non débutée</td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                                        <div>
                                            {{$show_reservation->description}}

                                            @if($show_reservation->images)
                                            <h5 class="mb-3 mt-4">Images</h5>
                                            <div class="row mt-2">
                                            @foreach(json_decode($show_reservation->images) as $url)
                                                <div class="col-lg-4 col-6 flex-shrink-0 avatar-xxl bg-light rounded p-1">
                                                    <img src="{{$url}}" alt="" class="img-fluid d-block">
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end card-->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Status de la reservation</h5>
                                <div class="flex-shrink-0 mt-2 mt-sm-0">
                                    @if($show_reservation->status == "ANNULER")
                                    <button type="button" disabled class="btn btn-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Annnuler</button>
                                    @else
                                        @if($show_reservation->status == "TERMINEE" || $show_reservation->status == "STARTED")
                                            <button type="button" disabled class="btn btn-info btn-sm mt-2 mt-sm-0"><i class="ri-map-pin-line align-middle me-1"></i> Débuter la prestation</button>
                                        @else
                                            <a href="javasccript:void(0;)" wire:click="validateOrder" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"><i class="ri-map-pin-line align-middle me-1"></i> Débuter la prestation</a>
                                        @endif


                                        @if($show_reservation->status == "STARTED" || $show_reservation->status == "TERMINEE")
                                            <button type="button" disabled class="btn btn-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Annnuler</button>
                                        @else
                                            <a href="javasccript:void(0;)" wire:click="cancelOrder" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Annnuler</a>
                                        @endif

                                        @if($show_reservation->status != "STARTED" || $show_reservation->status == "ANNULER")
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

                                    @if($show_reservation->status != "ANNULER")

                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingOne">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title @if($show_reservation->status == "en attente" ) bg-warning @elseif($show_reservation->status == "TERMINEE") bg-success @elseif($show_reservation->status == "STARTED") bg-primary @endif rounded-circle">
                                                                <i class="ri-shopping-bag-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-0 fw-semibold"> A faire le : <span class="fw-normal">{{ $show_reservation->date_debut->format('d-m-Y') }} - {{ $show_reservation->date_debut->format('H:i') }}</span></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <h6 class="mb-1">Une reservation a été placer le .</h6>
                                                    <p class="text-muted">{{$show_reservation->created_at->format('d-m-Y')}}  </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingThree">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title @if($show_reservation->status == "TERMINEE") bg-success @elseif($show_reservation->status == "STARTED") bg-primary @else bg-light text-success @endif rounded-circle">
                                                                <i class="ri-truck-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-1 fw-semibold">Commencé le :
                                                                @if($show_reservation->start_at)
                                                                 <span class="fw-normal">{{ $show_reservation->start_at->format('d-m-Y') }} à {{ $show_reservation->start_at->format('H:i') }}</span>
                                                                @endif
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <p class="text-muted mb-0">{{ $show_reservation->validated_at }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingTwo">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title @if($show_reservation->status == "TERMINEE") bg-success @else bg-light text-success @endif rounded-circle">
                                                                <i class="mdi mdi-gift-outline"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-1 fw-semibold">Terminé le :
                                                            @if($show_reservation->dete_fin)
                                                                <span class="fw-normal">{{ $show_reservation->dete_fin->format('d-m-Y') }} à {{ $show_reservation->dete_fin->format('H:i') }}</span>
                                                            @endif
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    @if($show_reservation->dete_fin)
                                                    <h6 class="mb-1">Votre reservation a été livrer</h6>
                                                    @endif
                                                    <p class="text-muted mb-0">{{ $show_reservation->date_fin }}</p>
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
                                                            <h6 class="fs-15 mb-0 fw-semibold">La reservation a été Annuler </h6>
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
                                @if($show_reservation->date_debut)
                                <p class="text-muted mb-0">A faire le : : {{ $show_reservation->date_debut->format('d-m-Y') }}</p>
                                <p class="text-muted mb-0">Heure : {{ $show_reservation->date_debut->format('H:i') }}</p>
                                @else
                                <h5>Récuperation dans nos point relais</h5>
                                @endif
                                <p class="text-muted mb-0"> Méthode de paiement : {{ $show_reservation->methode_payment }}</p>
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
                                            <img src="{{ $show_reservation->user()->first()->photo_url ?? "https://api.dicebear.com/7.x/initials/svg?seed=$show_reservation->user()->first()->username" }}" alt="" class="avatar-sm rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-1">{{ $show_reservation->user()->first()->username }}</h6>
                                            <p class="text-muted mb-0">Client</p>
                                        </div>
                                    </div>
                                </li>
                                <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $show_reservation->user()->first()->email }}</li>
                                <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>+({{ $show_reservation->user()->first()->dial_code }}) {{ $show_reservation->user()->first()->phone_number }}</li>
                            </ul>
                        </div>
                    </div>



                    @if($show_reservation->paiements()->count() > 0)
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
                                        <h6 class="mb-0 fs-10">#{{ $show_reservation->paiements()->first()->reference }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Méthode de P:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ $show_reservation->methode_payment }}</h6>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <p class="text-muted mb-0">Total Amount:</p>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ number_format($show_reservation->paiements()->first()->montant, 0) }}  FCFA</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--end card-->
                </div>
                <!--end col-->
            </div>


            <div class="row my-4" wire:ignore>
                <div class="col-lg-12">
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div><!--end col-->
            </div>


        </div>
    </div>



     <!-- Moddal -->
     <div wire:ignore.self class="modal fade" tabindex="-1" id="print-reservation" aria-hidden="true">
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
                                                    <h5 class="fs-14 mb-0">#<span id="invoice-no">{{$show_reservation->reference}}</span></h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                                    <h5 class="fs-14 mb-0"><span id="invoice-date">{{ date('d, M Y', strtotime($show_reservation->created_at)) }}</span> <small class="text-muted" id="invoice-time">{{ date('H:i', strtotime($show_reservation->created_at)) }}</small></h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Status Pay</p>
                                                    @if($show_reservation->status == "TERMINEE")
                                                    <span class="badge badge-soft-success fs-11" id="payment-status">régler</span>
                                                    @else
                                                    <span class="badge badge-soft-warning fs-11" id="payment-status">non régler</span>
                                                    @endif
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Montant Total</p>
                                                    <h5 class="fs-14 mb-0"><span id="total-amount">{{$show_reservation->montant }} fcfa </span></h5>
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
                                                    <p class="fw-medium mb-2" id="billing-name">{{$show_reservation->user()->first()->username}}</p>
                                                    <p class="text-muted mb-1"><span>Contact: </span><span id="billing-phone-no">{{$show_reservation->user()->first()->phone}}</span></p>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Adresse de Livraison</h6>

                                                        <p class="fw-medium mb-2" id="shipping-name">{{ $show_reservation->adresse_name }}</p>
                                                    <p class="text-muted mb-1" id="shipping-address-line-1">{{ $show_reservation->adresse_name }}</p>
                                                    {{-- <p class="text-muted mb-1"><span>Phone: +</span><span id="shipping-phone-no">(123) 456-7890</span></p> --}}

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

                                            </div>
                                            <div class="border-top border-top-dashed mt-2">
                                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                                    <tbody>

                                                        <tr class="border-top border-top-dashed fs-15">
                                                            <th scope="row">Total</th>
                                                            <th class="text-end">{{$show_reservation->montant}} fcfa</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end table-->
                                            </div>
                                            <div class="mt-3">
                                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Details Paiements:</h6>
                                                @if($show_reservation->methode_payment == "cash" || $show_reservation->methode_payment == "Cash")
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


@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNZfIwGs9Y1hlRDCyiw3LV8dpLu1biIbM&libraries=places" async></script>

<script>

async function initReservationMap() {
    const { Map } = await google.maps.importLibrary("maps");

    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer({
        polylineOptions: {
            strokeColor: 'blue' // Couleur de la ligne d'itinéraire
        },
        suppressMarkers: true // Supprime les marqueurs par défaut
    });

    var listCustomer = @json($show_reservation->location);


    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: { lat: 5.3432680297640, lng: -3.996286299639 },
        mapTypeId: 'roadmap'
    });

    directionsRenderer.setMap(map);


    var request = {
        origin: { lat: 5.355991574870066, lng: -3.9784689426916398 },
        destination: { lat: Number(listCustomer.latitude), lng: Number(listCustomer.longitude) },
        travelMode: 'DRIVING'
    };


    const infoWindow = new google.maps.InfoWindow();

    directionsService.route(request, function(result, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(result);

            // Marqueur pour le point de départ
            const startMarker = new google.maps.Marker({
                position: request.origin,
                map: map,
                title: "Ivoire transmission",
                icon: {
                    url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png", // Icône personnalisée pour le départ
                    scaledSize: new google.maps.Size(40, 40)
                }
            });


            // Afficher les informations au clic sur le marqueur de départ
            startMarker.addListener("click", () => {
                infoWindow.setContent("Ivoire transmission"); // Affiche l'adresse de départ
                infoWindow.open(map, startMarker);
            });

            const iconTravail = 'data:image/svg+xml;base64,' + btoa(`
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-276.95 -276.95 1023.30 1023.30" xml:space="preserve" width="64px" height="64px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#345e31;" cx="234.7" cy="234.7" r="234.7"></circle> <path style="fill:#296a34;" d="M78,409.4c41.6,37.3,96.5,60,156.7,60s115.2-22.7,156.7-60H78z"></path> <polygon style="fill:#e96958;" points="227.9,119.7 227.9,181 227.9,242.3 355.1,242.3 331.6,181 355.1,119.7 "></polygon> <rect x="150.6" y="106.8" style="fill:#ec4e32;" width="95.8" height="122.7"></rect> <g> <polygon style="fill:#e6e6e6;" points="246.4,229.4 227.9,242.3 227.9,229.4 "></polygon> <path style="fill:#e6e6e6;" d="M158.2,85.3c0-6.7-5.5-12.2-12.2-12.2s-12.2,5.5-12.2,12.2c0,5.1,3.2,9.5,7.6,11.3v313.2h9.1V96.6 C155,94.8,158.2,90.4,158.2,85.3z"></path> </g> </g></svg>
            `);

            // Marqueur pour le point de fin
            const endMarker = new google.maps.Marker({
                position: request.destination,
                map: map,
                title: "Lieu de la prestation",
                icon: iconTravail
            });

            // Afficher les informations au clic sur le marqueur de destination
            endMarker.addListener("click", () => {
                infoWindow.setContent("Lieu de la prestation : {{$show_reservation->location['adresse_name'] }}"); // Affiche l'adresse d'arrivée
                infoWindow.open(map, endMarker);
            });

        }
    });
}

document.addEventListener('DOMContentLoaded', (event) => {
        //init la MAp Générale
        window.setTimeout(() => {
            initReservationMap();
        },1000);
    });

</script>

{{-- <script>


    function initReservationMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: {lat: 5.3432680297640, lng: -3.996286299639},
            mapTypeId: 'roadmap',
            styles: [

                {
                    featureType: 'transit',
                    elementType: 'labels.icon',
                    stylers: [{ visibility: 'off' }]
                }
            ]
        });

        MarkerPlaceForCustomer(map);
    }

    function MarkerPlaceForCustomer(map) {
        var listCustomer = @json($show_reservation->location);

        console.log(listCustomer.latitude);

        const infowindow = new google.maps.InfoWindow();


            const iconTravail = 'data:image/svg+xml;base64,' + btoa(`
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-276.95 -276.95 1023.30 1023.30" xml:space="preserve" width="64px" height="64px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#345e31;" cx="234.7" cy="234.7" r="234.7"></circle> <path style="fill:#296a34;" d="M78,409.4c41.6,37.3,96.5,60,156.7,60s115.2-22.7,156.7-60H78z"></path> <polygon style="fill:#e96958;" points="227.9,119.7 227.9,181 227.9,242.3 355.1,242.3 331.6,181 355.1,119.7 "></polygon> <rect x="150.6" y="106.8" style="fill:#ec4e32;" width="95.8" height="122.7"></rect> <g> <polygon style="fill:#e6e6e6;" points="246.4,229.4 227.9,242.3 227.9,229.4 "></polygon> <path style="fill:#e6e6e6;" d="M158.2,85.3c0-6.7-5.5-12.2-12.2-12.2s-12.2,5.5-12.2,12.2c0,5.1,3.2,9.5,7.6,11.3v313.2h9.1V96.6 C155,94.8,158.2,90.4,158.2,85.3z"></path> </g> </g></svg>
            `);

                const contentStringDomicile = `
                    <div class="info-content">
                        <strong class="text-primary">Lieu de rdv :</strong><br><br>
                        <div class="details">
                            <strong>${listCustomer.adresse_name}</strong><br>
                            Lieu : <strong>fix</strong><br>
                            ${listCustomer.adresse}<br>
                        </div>
                    </div>
                `;

                var markerDomicile = new google.maps.Marker({
                    position: { lat: Number(listCustomer.latitude), lng: Number(listCustomer.longitude) },
                    map: map,
                    icon: iconTravail,
                    title: 'Adresse : ' + listCustomer.adresse
                });

                //ecouteur d'evenement avec la fonction anonyme
                (function(marker, content) {
                    marker.addListener('click', function () {
                        infowindow.setContent(content);
                        infowindow.open(map, marker);
                    });
                })(markerDomicile, contentStringDomicile);
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        //init la MAp Générale
        window.setTimeout(() => {
            initReservationMap();
        },1000);
    });
</script> --}}


@endpush
