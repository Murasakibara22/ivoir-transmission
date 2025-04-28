@extends('Dashboard.layouts.app')

@push('title')
    Factures
@endpush

@section('content')

<div class="page-content">
    <div class="container-fluid">

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
                                                    <p class="text-muted mb-0">longueur: <span class="fw-medium">{{ App\Models\VarianteProduit::find($produit->variante_id)->longeur ?? "" }}</span></p>
                                                    <p class="text-muted mb-0">volume: <span class="fw-medium">{{ App\Models\VarianteProduit::find($produit->variante_id)->volume ?? "" }} </span></p>
                                                @endif
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
                                {{-- <a href="javascript:void(0);" onclick="printPageAsPDF()" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Télécharger</a> --}}
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

@endsection
