<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Réservations</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tableau de bord</a></li>
                                <li class="breadcrumb-item active">Réservations</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">
                <div class="col-xxl-12 order-xxl-0 order-first">
                    <div class="d-flex flex-column h-100">
                        <div class="row h-100">
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                    <i class=" ri-bar-chart-2-fill align-middle"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Réservations</p>
                                                <h4 class=" mb-0"><span>{{$all_order ?? 0}}</span></h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-end">
                                                <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>6.24 %<span> </span></span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-light text-danger rounded-circle fs-3">
                                                    <i class="ri-arrow-down-circle-fill align-middle"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Commande en attente</p>
                                                <h4 class=" mb-0"><span>{{ $pending_order }}</span></h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-end">
                                                <span class="badge badge-soft-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>4.80 %<span> </span></span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-light text-success rounded-circle fs-3">
                                                    <i class="ri-checkbox-circle-fill align-middle"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Commande Terminé</p>
                                                <h4 class=" mb-0"><span >{{ $finish_order }}</span></h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-end">
                                                <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>6.24 %<span> </span></span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Historique des Commandes</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form wire:submit.prevent='filterCommande'>
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-6">
                                        <div class="search-box">
                                            <input type="text" wire:model="search_filter"  class="form-control search" placeholder="rechercher une commande....">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-2 col-sm-6">
                                        <div>
                                            <input type="date" class="form-control" wire:model="date_before_filter" placeholder="Select date">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-2 col-sm-4">
                                        <div>
                                            <select class="form-control" wire:model="status_filter">
                                                <option value="">Status</option>
                                                <option value="en attente">En attente</option>
                                                <option value="ANNULER">Annuler</option>
                                                <option value="TERMINEE">Terminer</option>
                                                <option value="VALIDEE">Valider</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-2 col-sm-4">
                                        <div>
                                            <select class="form-control" wire:model="methode_payment_filter">
                                                <option value="">Select Payment</option>
                                                <option value="cash">cash</option>
                                                <option value="Mobile Money">Mobile Money</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-1 col-sm-4">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-100" > <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                                Filters
                                            </button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link @if($currentPage == 'all') active @endif All py-3" wire:click="selectPage('all')"  href="javascript:void(0);" role="tab" @if($currentPage == 'all') aria-selected="true" @else aria-selected="false" @endif>
                                            <i class="ri-store-2-fill me-1 align-bottom"></i> Toutes les commandes
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($currentPage == 'Terminer') active @endif py-3 Pickups"  wire:click="selectPage('Terminer')" href="javascript:void(0);" role="tab" @if($currentPage == 'Terminer') aria-selected="true" @else aria-selected="false" @endif>
                                            <i class="ri-truck-line me-1 align-bottom"></i> Livrer <span class="badge bg-danger align-middle ms-1">2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($currentPage == 'Annuler') active @endif py-3 Cancelled"  wire:click="selectPage('Annuler')" href="javascript:void(0);" role="tab" @if($currentPage == 'Annuler') aria-selected="true" @else aria-selected="false" @endif>
                                            <i class="ri-close-circle-line me-1 align-bottom"></i> Annuler
                                        </a>
                                    </li>
                                </ul>

                                <div class="table-responsive table-card mb-1">
                                    <table class="table table-nowrap align-middle" id="orderTable">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">

                                                <th class="sort" data-sort="id">REF</th>
                                                <th class="sort" data-sort="customer_name">Clients</th>
                                                <th class="sort" data-sort="product_name">Produits</th>
                                                <th class="sort" data-sort="date">Date</th>
                                                <th class="sort" data-sort="amount">Montant</th>
                                                <th class="sort" data-sort="payment">Methode de paiements</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="lieu">Lieu de livraison</th>
                                                <th class="sort" data-sort="city">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @if($list_order_filter && $list_order_filter->count() > 0)
                                                @foreach($list_order_filter as $order)
                                                    <tr>
                                                        <td class="id">
                                                            <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#{{ Illuminate\Support\Str::limit($order->reference, 10) }}</a>
                                                        </td>
                                                        <td class="customer_name">{{$order->user->username}}</td>
                                                        <td class="product_name">
                                                            <button type="button" wire:click="showProducts({{$order->id}})" class="btn btn-link link-success fw-medium text-decoration-none"> voir les produits <i class="ri-arrow-right-s-line"></i></button>
                                                        </td>
                                                        <td class="date">{{ $order->created_at->diffForHumans()}}</td>
                                                        <td class="amount text-success">{{ number_format($order->montant , 0, ',', '.') }} fcfa</td>
                                                        <td class="payment">{{$order->methode_payment}}</td>
                                                        <td class="status">
                                                            @if($order->status == "en attente")
                                                            <span class="badge badge-soft-warning text-uppercase">En attente</span>
                                                            @elseif($order->status == "TERMINEE")
                                                            <span class="badge badge-soft-success text-uppercase">Terminer</span>
                                                            @elseif($order->status == "ANNULER")
                                                            <span class="badge badge-soft-danger text-uppercase">Annuler</span>
                                                            @elseif($order->status == "VALIDEE")
                                                            <span class="badge badge-soft-info text-uppercase">Valider</span>
                                                            @endif
                                                        </td>
                                                        <td class="status">{{$order->adresse ?? 'Récuperation (PDV)'}}</td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                                    <a href="{{ route('dashboard.orders.show', $order->slug) }}" class="text-primary d-inline-block">
                                                                        <i class="ri-eye-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item" title="Télécharger">
                                                                    <a class="text-warning d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder">
                                                                        <i class="ri-download-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @if($list_order && $list_order->count() > 0)
                                                    @foreach($list_order as $order)
                                                        <tr>
                                                            <td class="id">
                                                                <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#{{ Illuminate\Support\Str::limit($order->reference, 10) }}</a>
                                                            </td>
                                                            <td class="customer_name">{{$order->user->username}}</td>
                                                            <td class="product_name">
                                                                <button type="button" wire:click="showProducts({{$order->id}})" class="btn btn-link link-success fw-medium text-decoration-none"> voir les produits <i class="ri-arrow-right-s-line"></i></button>
                                                            </td>
                                                            <td class="date">{{ $order->created_at->diffForHumans()}}</td>
                                                            <td class="amount text-success">{{ number_format($order->montant , 0, ',', '.') }} fcfa</td>
                                                            <td class="payment">{{$order->methode_payment}}</td>
                                                            <td class="status">
                                                                @if($order->status == "en attente")
                                                                <span class="badge badge-soft-warning text-uppercase">En attente</span>
                                                                @elseif($order->status == "TERMINEE")
                                                                <span class="badge badge-soft-success text-uppercase">Terminer</span>
                                                                @elseif($order->status == "ANNULER")
                                                                <span class="badge badge-soft-danger text-uppercase">Annuler</span>
                                                                @elseif($order->status == "VALIDEE")
                                                                <span class="badge badge-soft-info text-uppercase">Valider</span>
                                                                @endif
                                                            </td>
                                                            <td class="status">{{$order->adresse ?? 'Récuperation (PDV)'}}</td>
                                                            <td>
                                                                <ul class="list-inline hstack gap-2 mb-0">
                                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                                        <a href="{{ route('dashboard.orders.show', $order->slug) }}" class="text-primary d-inline-block">
                                                                            <i class="ri-eye-fill fs-16"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li class="list-inline-item" title="Télécharger">
                                                                        <a class="text-warning d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder">
                                                                            <i class="ri-download-fill fs-16"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted">We've searched more than 150+ Commandes We did not find any Commandes for you search.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                   {{$list_order->links()}}
                                </div>
                            </div>
                            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form class="tablelist-form" autocomplete="off">
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <div class="mb-3" id="modal-id">
                                                    <label for="orderId" class="form-label">ID</label>
                                                    <input type="text" id="orderId" class="form-control" placeholder="ID" readonly />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Customer Name</label>
                                                    <input type="text" id="customername-field" class="form-control" placeholder="Enter name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="productname-field" class="form-label">Product</label>
                                                    <select class="form-control" data-trigger name="productname-field" id="productname-field" required />
                                                        <option value="">Product</option>
                                                        <option value="Puma Tshirt">Puma Tshirt</option>
                                                        <option value="Adidas Sneakers">Adidas Sneakers</option>
                                                        <option value="350 ml Glass Grocery Container">350 ml Glass Grocery Container</option>
                                                        <option value="American egale outfitters Shirt">American egale outfitters Shirt</option>
                                                        <option value="Galaxy Watch4">Galaxy Watch4</option>
                                                        <option value="Apple iPhone 12">Apple iPhone 12</option>
                                                        <option value="Funky Prints T-shirt">Funky Prints T-shirt</option>
                                                        <option value="USB Flash Drive Personalized with 3D Print">USB Flash Drive Personalized with 3D Print</option>
                                                        <option value="Oxford Button-Down Shirt">Oxford Button-Down Shirt</option>
                                                        <option value="Classic Short Sleeve Shirt">Classic Short Sleeve Shirt</option>
                                                        <option value="Half Sleeve T-Shirts (Blue)">Half Sleeve T-Shirts (Blue)</option>
                                                        <option value="Noise Evolve Smartwatch">Noise Evolve Smartwatch</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="date-field" class="form-label">Order Date</label>
                                                    <input type="date" id="date-field" class="form-control" data-provider="flatpickr" required data-date-format="d M, Y" data-enable-time required placeholder="Select date" />
                                                </div>

                                                <div class="row gy-4 mb-3">
                                                    <div class="col-md-6">
                                                        <div>
                                                            <label for="amount-field" class="form-label">Amount</label>
                                                            <input type="text" id="amount-field" class="form-control" placeholder="Total amount" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div>
                                                            <label for="payment-field" class="form-label">Payment Method</label>
                                                            <select class="form-control" data-trigger name="payment-method" required id="payment-field">
                                                                <option value="">Payment Method</option>
                                                                <option value="Mastercard">Mastercard</option>
                                                                <option value="Visa">Visa</option>
                                                                <option value="COD">COD</option>
                                                                <option value="Paypal">Paypal</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="delivered-status" class="form-label">Delivery Status</label>
                                                    <select class="form-control" data-trigger name="delivered-status" required id="delivered-status">
                                                        <option value="">Delivery Status</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Inprogress">Inprogress</option>
                                                        <option value="Cancelled">Cancelled</option>
                                                        <option value="Pickups">Pickups</option>
                                                        <option value="Delivered">Delivered</option>
                                                        <option value="Returns">Returns</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" id="add-btn">Add Order</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-5 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                            <div class="mt-4 text-center">
                                                <h4>You are about to delete a order ?</h4>
                                                <p class="text-muted fs-15 mb-4">Deleting your order will remove all of your information from our database.</p>
                                                <div class="hstack gap-2 justify-content-center remove">
                                                    <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                    <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
                        </div>
                    </div>

                </div>
                <!--end col-->
            </div>
            <!--end row-->


        </div>
    </div>



    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="show_products" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title  mb-0">Commande: <strong> # {{ $show_commande?->reference }} </strong> </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center p-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th style="width: 90px;" scope="col">Produit</th>
                                            <th scope="col"> Informations produit</th>
                                            <th scope="col" class="text-end">Prix total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($list_products && $list_products->count() > 0)
                                        @foreach($list_products as $key => $produit)
                                            <tr>
                                                <td>
                                                    <div class="avatar-md bg-light rounded p-1">
                                                        <img src="{{ json_decode($produit->images)[0] }}" alt="" class="img-fluid d-block">
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14"><a href="{{ route('dashboard.produits.show', $produit->slug) }}" class="text-dark">{{ Illuminate\Support\Str::limit($produit->libelle, 50) }}</a></h5>
                                                    <p class="text-muted mb-0">{{  number_format($produit->prix_unitaire, 0, ',','.') }} x {{ $produit->quantite }}</p>
                                                    @if($produit->variante_id != null)
                                                    <div class="fs-xs">longueur : {{ App\Models\VarianteProduit::find($produit->variante_id)->longeur ?? "" }} </div>
                                                    <div class="fs-xs">volume : x {{ App\Models\VarianteProduit::find($produit->variante_id)->volume ?? "" }} </div>
                                                    @endif
                                                </td>
                                                <td class="text-end text-success">{{ number_format($produit->prix_total, 0, ',','.') }} FCFA</td>
                                            </tr>
                                        @endforeach
                                        @endif
                                        <tr class="table-active">
                                            <th colspan="2">Montant Total :</th>
                                            <td class="text-end">
                                                <span class="fw-semibold h4 text-info">
                                                    {{ number_format($show_commande?->montant, 0, ',','.') }} fcfa
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>




@push('styles')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <style>
        .feedback-text{
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #f06548;
        }
    </style>
@endpush
