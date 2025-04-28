<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">

                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">@if(Illuminate\Support\Carbon::now()->format('H') < 12) Bonjour @else Bonsoir @endif, {{ auth()->user()->username }}</h4>
                                        <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                                    </div>
                                    <div class="mt-3 mt-lg-0">
                                        <form action="javascript:void(0);">
                                            <div class="row g-3 mb-0 align-items-center">

                                                <div class="col-auto">
                                                    <a href="{{ route('dashboard.produits') }}" type="button" class="btn btn-soft-success"><i class="ri-add-circle-line align-middle me-1"></i> Ajouter un produit</a>
                                                </div>
                                                <!--end col-->
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                </div><!-- end card header -->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> BÉNÉFICE TOTAL </p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-success fs-14 mb-0">
                                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$benefice_total}}">0</span></h4>
                                                <a href="{{ route('dashboard.finance') }}" class="text-decoration-underline">Voir plus</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-success rounded fs-3">
                                                    <i class="bx bx-dollar-circle text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                             <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Commandes</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-danger fs-14 mb-0">
                                                    <i class="ri-arrow-right-down-line fs-13 align-middle"></i> @if($total_order) {{ App\Models\Commande::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count() * 100 / $total_order}} @else 0 @endif%
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$total_order}}">{{ $total_order }}</span></h4>
                                                <a href="{{ route('dashboard.orders') }}" class="text-decoration-underline">View les commandes</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded fs-3">
                                                    <i class="bx bx-shopping-bag text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Utilisateurs</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-success fs-14 mb-0">
                                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$total_user}}">0</span> </h4>
                                                <a href="{{ route('dashboard.users') }}" class="text-decoration-underline">Voir plus</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-warning rounded fs-3">
                                                    <i class="bx bx-user-circle text-warning"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Produits</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-muted fs-14 mb-0">
                                                    +0.00 %
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$total_produits}}">0</span> </h4>
                                                <a href="{{ route('dashboard.produits') }}" class="text-decoration-underline">afficher plus</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-primary rounded fs-3">
                                                    <i class="bx bx-wallet text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div> <!-- end row-->

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Statistiques</h4>
                                    </div><!-- end card header -->



                                    <div class="card-body p-0 pb-2">
                                        <div class="w-100">
                                            <div id="line_chart_datalabel2" data-value3="{{$stats_by_month_effectuer}}" data-value2="{{$stats_by_month_annuler}}" data-value="{{$stats_by_all_month}}"  data-colors='["--vz-danger", "--vz-success", "--vz-warning"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->


                            <div class="col-xl-4">
                                <div class="card card-height-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Produits Vendus</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown card-header-dropdown">
                                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Download Report</a>
                                                    <a class="dropdown-item" href="#">Export</a>
                                                    <a class="dropdown-item" href="#">Import</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div id="store-visits-source" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div> <!-- .card-->
                            </div> <!-- .col-->

                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Produits récents                                   </h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                <tbody>
                                                    @if($list_produits && count($list_produits) > 0)
                                                        @foreach($list_produits as $produit)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                        <img src="{{ json_decode($produit->images)[0] }}" alt="" class="img-fluid d-block" />
                                                                    </div>
                                                                    <div>
                                                                        <h5 class="fs-14 my-1"><a href="{{ route('dashboard.produits.show', $produit->slug) }}" class="text-reset">{{ Illuminate\Support\Str::limit($produit->libelle, 25,'...') }}</a></h5>
                                                                        <span class="text-muted">{{ $produit->categorie?->libelle }}</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if($produit->prix_fixe)
                                                                <h5 class="fs-14 my-1 fw-normal">{{ number_format($produit->prix_fixe, 0, ',','.') }} FCFA</h5>
                                                                @else
                                                                <h5 class="fs-14 my-1 fw-normal">{{ number_format($produit->variante_produit?->min('prix'), 0, ',', '.')  }} - {{ number_format($produit->variante_produit?->max('prix'), 0, ',', '.')  }} FCFA</h5>
                                                                @endif
                                                                <span class="text-muted">Prix</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-normal">62</h5>
                                                                <span class="text-muted">commandes</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-normal">{{ $produit->stock }}</h5>
                                                                <span class="text-muted">Stock</span>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card card-height-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Inscrits Récements</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown card-header-dropdown">
                                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">voir plus<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Tous</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                                <tbody>
                                                    @if($list_users && count($list_users) > 0)
                                                        @foreach($list_users as $user)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0 me-2">
                                                                        <img src="{{$user->photo_url ?? "https://api.dicebear.com/7.x/initials/svg?seed=$user->username" }}" alt="" class="avatar-sm p-2" />
                                                                    </div>
                                                                    <div>
                                                                        <h5 class="fs-14 my-1 fw-medium">
                                                                            <a href="{{route('dashboard.users.show', $user->slug)}}" class="text-reset">{{$user->username}}</a>
                                                                        </h5>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span class="text-muted">{{$user->email ?? 'Non renseigné'}}</span>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">{{$user->phone}}</p>
                                                                <span class="text-muted">contacts</span>
                                                            </td>

                                                            <td>
                                                                <a href="{{route('dashboard.users.show', $user->slug)}}" class="btn btn-sm btn-soft-primary">
                                                                    <i class="ri-eye-line"></i> détails
                                                                </a>
                                                            </td>
                                                        </tr><!-- end -->
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table><!-- end table -->
                                        </div>



                                    </div> <!-- .card-body-->
                                </div> <!-- .card-->
                            </div> <!-- .col-->
                        </div> <!-- end row-->

                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Commandes récentes </h4>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-soft-info btn-sm">
                                                <i class="ri-file-list-3-line align-middle"></i>  Report
                                            </button>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                <thead class="text-muted table-light">
                                                    <tr>
                                                        <th scope="col">références</th>
                                                        <th scope="col">utilisateurs</th>
                                                        <th scope="col">Produits</th>
                                                        <th scope="col">Montant</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($list_commandes && count($list_commandes) > 0)
                                                    @foreach($list_commandes as $order)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('dashboard.orders.show', $order->slug) }}" class="fw-medium link-primary">#{{Illuminate\Support\Str::limit($order->reference, 20)}}</a>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <img src="{{$order->user->photo_url ?? "https://api.dicebear.com/7.x/initials/svg?seed=$order->user->username"}}" alt="" class="avatar-xs rounded-circle" />
                                                                </div>
                                                                <div class="flex-grow-1">{{$order->user->username}}</div>
                                                            </div>
                                                        </td>
                                                        <td>{{$order->produit()->count()}}</td>
                                                        <td>
                                                            <span class="text-success">{{number_format($order->montant, 0, ',', '.')}} fcfa</span>
                                                        </td>
                                                        <td>
                                                            @if($order->status == "en attente")
                                                            <span class="badge badge-soft-warning">{{$order->status}}</span>
                                                            @elseif($order->status == "TERMINEE")
                                                            <span class="badge badge-soft-success">{{$order->status}}</span>
                                                            @elseif($order->status == "ANNULER")
                                                            <span class="badge badge-soft-danger">{{$order->status}}</span>
                                                            @elseif($order->status == "VALIDEE")
                                                            <span class="badge badge-soft-info">{{$order->status}}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('dashboard.orders.show', $order->slug) }}" class="btn btn-sm btn-soft-primary"><i class="ri-eye-line align-middle me-1"></i>voir plus</a>
                                                        </td>
                                                    </tr><!-- end tr -->
                                                   @endforeach
                                                   @endif
                                                </tbody><!-- end tbody -->
                                            </table><!-- end table -->
                                        </div>
                                    </div>
                                </div> <!-- .card-->
                            </div> <!-- .col-->
                        </div> <!-- end row-->

                    </div> <!-- end .h-100-->

                </div> <!-- end col -->

                <div class="col-auto layout-rightside-col">
                    <div class="overlay"></div>
                    <div class="layout-rightside">
                        <div class="card h-100 rounded-0">
                            <div class="card-body p-0">
                                <div class="p-3">
                                    <h6 class="text-muted mb-0 text-uppercase fw-semibold">Recent Activity</h6>
                                </div>
                                <div data-simplebar style="max-height: 410px;" class="p-3 pt-0">
                                    <div class="acitivity-timeline acitivity-main">
                                        <div class="acitivity-item d-flex">
                                            <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                <div class="avatar-title bg-soft-success text-success rounded-circle">
                                                    <i class="ri-shopping-cart-2-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Purchase by James Price</h6>
                                                <p class="text-muted mb-1">Product noise evolve smartwatch </p>
                                                <small class="mb-0 text-muted">02:14 PM Today</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                <div class="avatar-title bg-soft-danger text-danger rounded-circle">
                                                    <i class="ri-stack-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Added new <span class="fw-semibold">style collection</span></h6>
                                                <p class="text-muted mb-1">By Nesta Technologies</p>
                                                <div class="d-inline-flex gap-2 border border-dashed p-2 mb-2">
                                                    <a href="apps-ecommerce-product-details.html" class="bg-light rounded p-1">
                                                        <img src="assets/images/products/img-8.png" alt="" class="img-fluid d-block" />
                                                    </a>
                                                    <a href="apps-ecommerce-product-details.html" class="bg-light rounded p-1">
                                                        <img src="assets/images/products/img-2.png" alt="" class="img-fluid d-block" />
                                                    </a>
                                                    <a href="apps-ecommerce-product-details.html" class="bg-light rounded p-1">
                                                        <img src="assets/images/products/img-10.png" alt="" class="img-fluid d-block" />
                                                    </a>
                                                </div>
                                                <p class="mb-0 text-muted"><small>9:47 PM Yesterday</small></p>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Natasha Carey have liked the products</h6>
                                                <p class="text-muted mb-1">Allow users to like products in your WooCommerce store.</p>
                                                <small class="mb-0 text-muted">25 Dec, 2021</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div class="avatar-title rounded-circle bg-secondary">
                                                        <i class="mdi mdi-sale fs-14"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Today offers by <a href="apps-ecommerce-seller-details.html" class="link-secondary">Digitech Galaxy</a></h6>
                                                <p class="text-muted mb-2">Offer is valid on orders of Rs.500 Or above for selected products only.</p>
                                                <small class="mb-0 text-muted">12 Dec, 2021</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div class="avatar-title rounded-circle bg-soft-danger text-danger">
                                                        <i class="ri-bookmark-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Favoried Product</h6>
                                                <p class="text-muted mb-2">Esther James have favorited product.</p>
                                                <small class="mb-0 text-muted">25 Nov, 2021</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div class="avatar-title rounded-circle bg-secondary">
                                                        <i class="mdi mdi-sale fs-14"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Flash sale starting <span class="text-primary">Tomorrow.</span></h6>
                                                <p class="text-muted mb-0">Flash sale by <a href="javascript:void(0);" class="link-secondary fw-medium">Zoetic Fashion</a></p>
                                                <small class="mb-0 text-muted">22 Oct, 2021</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div class="avatar-title rounded-circle bg-soft-info text-info">
                                                        <i class="ri-line-chart-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Monthly sales report</h6>
                                                <p class="text-muted mb-2"><span class="text-danger">2 days left</span> notification to submit the monthly sales report. <a href="javascript:void(0);" class="link-warning text-decoration-underline">Reports Builder</a></p>
                                                <small class="mb-0 text-muted">15 Oct</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Frank Hook Commented</h6>
                                                <p class="text-muted mb-2 fst-italic">" A product that has reviews is more likable to be sold than a product. "</p>
                                                <small class="mb-0 text-muted">26 Aug, 2021</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3 mt-2">
                                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">Top 10 Categories
                                    </h6>

                                    <ol class="ps-3 text-muted">
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Mobile & Accessories <span class="float-end">(10,294)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Desktop <span class="float-end">(6,256)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Electronics <span class="float-end">(3,479)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Home & Furniture <span class="float-end">(2,275)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Grocery <span class="float-end">(1,950)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Fashion <span class="float-end">(1,582)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Appliances <span class="float-end">(1,037)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Beauty, Toys & More <span class="float-end">(924)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Food & Drinks <span class="float-end">(701)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Toys & Games <span class="float-end">(239)</span></a>
                                        </li>
                                    </ol>
                                    <div class="mt-3 text-center">
                                        <a href="javascript:void(0);" class="text-muted text-decoration-underline">View all Categories</a>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">Products Reviews</h6>
                                    <!-- Swiper -->
                                    <div class="swiper vertical-swiper" style="height: 250px;">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="card border border-dashed shadow-none">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 avatar-sm">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="assets/images/companies/img-1.png" alt="" height="30">
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <div>
                                                                    <p class="text-muted mb-1 fst-italic text-truncate-two-lines"> " Great product and looks great, lots of features. "</p>
                                                                    <div
                                                                        class="fs-11 align-middle text-warning">
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mb-0 text-muted">
                                                                    - by <cite title="Source Title">Force Medicines</cite>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="card border border-dashed shadow-none">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0">
                                                                <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-sm rounded">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <div>
                                                                    <p class="text-muted mb-1 fst-italic text-truncate-two-lines"> " Amazing template, very easy to understand and manipulate. "</p>
                                                                    <div class="fs-11 align-middle text-warning">
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-half-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mb-0 text-muted">
                                                                    - by <cite title="Source Title">Henry Baird</cite>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="card border border-dashed shadow-none">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 avatar-sm">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="assets/images/companies/img-8.png" alt="" height="30">
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <div>
                                                                    <p class="text-muted mb-1 fst-italic text-truncate-two-lines"> "Very beautiful product and Very helpful customer service."</p>
                                                                    <div class="fs-11 align-middle text-warning">
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-line"></i>
                                                                        <i class="ri-star-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mb-0 text-muted">
                                                                    - by <cite title="Source Title">Zoetic Fashion</cite>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="card border border-dashed shadow-none">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0">
                                                                <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-sm rounded">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <div>
                                                                    <p class="text-muted mb-1 fst-italic text-truncate-two-lines">" The product is very beautiful. I like it. "</p>
                                                                    <div class="fs-11 align-middle text-warning">
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-half-fill"></i>
                                                                        <i class="ri-star-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mb-0 text-muted">
                                                                    - by <cite title="Source Title">Nancy Martino</cite>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3">
                                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">Customer Reviews</h6>
                                    <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="fs-16 align-middle text-warning">
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-half-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h6 class="mb-0">4.5 out of 5</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-muted">Total <span class="fw-medium">5.50k</span> reviews</div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">5 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 50.16%" aria-valuenow="50.16" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">2758</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">4 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 29.32%" aria-valuenow="29.32" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">1063</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">3 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 18.12%" aria-valuenow="18.12" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">997</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">2 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 4.98%" aria-valuenow="4.98" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">227</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">1 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 7.42%" aria-valuenow="7.42" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">408</h6>
                                                </div>
                                            </div>
                                        </div><!-- end row -->
                                    </div>
                                </div>

                                <div class="card sidebar-alert bg-light border-0 text-center mx-4 mb-0 mt-3">
                                    <div class="card-body">
                                        <img src="assets/images/giftbox.png" alt="">
                                        <div class="mt-4">
                                            <h5>Invite New Seller</h5>
                                            <p class="text-muted lh-base">Refer a new seller to us and earn $100 per refer.</p>
                                            <button type="button" class="btn btn-primary btn-label rounded-pill"><i class="ri-mail-fill label-icon align-middle rounded-pill fs-16 me-2"></i> Invite Now</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end .rightbar-->

                </div> <!-- end col -->
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>




@push('scripts')

<!-- apexcharts -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>


<!-- linecharts init -->
<script src="{{ asset('assets/js/pages/apexcharts-line.init.js') }}"></script>

<script>
    var all_stats = document.getElementById('line_chart_datalabel2').getAttribute('data-value');
    all_stats = JSON.parse(all_stats);

    var echouer_stats = document.getElementById('line_chart_datalabel2').getAttribute('data-value2');
    echouer_stats = JSON.parse(echouer_stats);

    var paid_stats = document.getElementById('line_chart_datalabel2').getAttribute('data-value3');
    paid_stats = JSON.parse(paid_stats);

    var linechartBasicColors = getChartColorsArray('line_chart_basic'),
  linechartDatalabelColors =
    (linechartZoomColors &&
      ((options = {
        series: [
          {
            name: 'XYZ MOTORS',
            data: [
              { x: new Date('2018-01-12').getTime(), y: 140 },
              { x: new Date('2018-01-13').getTime(), y: 147 },
              { x: new Date('2018-01-14').getTime(), y: 150 },
              { x: new Date('2018-01-15').getTime(), y: 154 },
              { x: new Date('2018-01-16').getTime(), y: 160 },
              { x: new Date('2018-01-17').getTime(), y: 165 },
              { x: new Date('2018-01-18').getTime(), y: 162 },
              { x: new Date('2018-01-20').getTime(), y: 159 },
              { x: new Date('2018-01-21').getTime(), y: 164 },
              { x: new Date('2018-01-22').getTime(), y: 160 },
              { x: new Date('2018-01-23').getTime(), y: 165 },
              { x: new Date('2018-01-24').getTime(), y: 169 },
              { x: new Date('2018-01-25').getTime(), y: 172 },
              { x: new Date('2018-01-26').getTime(), y: 177 },
              { x: new Date('2018-01-27').getTime(), y: 173 },
              { x: new Date('2018-01-28').getTime(), y: 169 },
              { x: new Date('2018-01-29').getTime(), y: 163 },
              { x: new Date('2018-01-30').getTime(), y: 158 },
              { x: new Date('2018-02-01').getTime(), y: 153 },
              { x: new Date('2018-02-02').getTime(), y: 149 },
              { x: new Date('2018-02-03').getTime(), y: 144 },
              { x: new Date('2018-02-05').getTime(), y: 150 },
              { x: new Date('2018-02-06').getTime(), y: 155 },
              { x: new Date('2018-02-07').getTime(), y: 159 },
              { x: new Date('2018-02-08').getTime(), y: 163 },
              { x: new Date('2018-02-09').getTime(), y: 156 },
              { x: new Date('2018-02-11').getTime(), y: 151 },
              { x: new Date('2018-02-12').getTime(), y: 157 },
              { x: new Date('2018-02-13').getTime(), y: 161 },
              { x: new Date('2018-02-14').getTime(), y: 150 },
              { x: new Date('2018-02-15').getTime(), y: 154 },
              { x: new Date('2018-02-16').getTime(), y: 160 },
              { x: new Date('2018-02-17').getTime(), y: 165 },
              { x: new Date('2018-02-18').getTime(), y: 162 },
              { x: new Date('2018-02-20').getTime(), y: 159 },
              { x: new Date('2018-02-21').getTime(), y: 164 },
              { x: new Date('2018-02-22').getTime(), y: 160 },
              { x: new Date('2018-02-23').getTime(), y: 165 },
              { x: new Date('2018-02-24').getTime(), y: 169 },
              { x: new Date('2018-02-25').getTime(), y: 172 },
              { x: new Date('2018-02-26').getTime(), y: 177 },
              { x: new Date('2018-02-27').getTime(), y: 173 },
              { x: new Date('2018-02-28').getTime(), y: 169 },
              { x: new Date('2018-02-29').getTime(), y: 163 },
              { x: new Date('2018-02-30').getTime(), y: 162 },
              { x: new Date('2018-03-01').getTime(), y: 158 },
              { x: new Date('2018-03-02').getTime(), y: 152 },
              { x: new Date('2018-03-03').getTime(), y: 147 },
              { x: new Date('2018-03-05').getTime(), y: 142 },
              { x: new Date('2018-03-06').getTime(), y: 147 },
              { x: new Date('2018-03-07').getTime(), y: 151 },
              { x: new Date('2018-03-08').getTime(), y: 155 },
              { x: new Date('2018-03-09').getTime(), y: 159 },
              { x: new Date('2018-03-11').getTime(), y: 162 },
              { x: new Date('2018-03-12').getTime(), y: 157 },
              { x: new Date('2018-03-13').getTime(), y: 161 },
              { x: new Date('2018-03-14').getTime(), y: 166 },
              { x: new Date('2018-03-15').getTime(), y: 169 },
              { x: new Date('2018-03-16').getTime(), y: 172 },
              { x: new Date('2018-03-17').getTime(), y: 177 },
              { x: new Date('2018-03-18').getTime(), y: 181 },
              { x: new Date('2018-03-20').getTime(), y: 178 },
              { x: new Date('2018-03-21').getTime(), y: 173 },
              { x: new Date('2018-03-22').getTime(), y: 169 },
              { x: new Date('2018-03-23').getTime(), y: 163 },
              { x: new Date('2018-03-24').getTime(), y: 159 },
              { x: new Date('2018-03-25').getTime(), y: 164 },
              { x: new Date('2018-03-26').getTime(), y: 168 },
              { x: new Date('2018-03-27').getTime(), y: 172 },
              { x: new Date('2018-03-28').getTime(), y: 169 },
              { x: new Date('2018-03-29').getTime(), y: 163 },
              { x: new Date('2018-03-30').getTime(), y: 162 },
              { x: new Date('2018-04-01').getTime(), y: 158 },
              { x: new Date('2018-04-02').getTime(), y: 152 },
              { x: new Date('2018-04-03').getTime(), y: 147 },
              { x: new Date('2018-04-05').getTime(), y: 142 },
              { x: new Date('2018-04-06').getTime(), y: 147 },
              { x: new Date('2018-04-07').getTime(), y: 151 },
              { x: new Date('2018-04-08').getTime(), y: 155 },
              { x: new Date('2018-04-09').getTime(), y: 159 },
              { x: new Date('2018-04-11').getTime(), y: 162 },
              { x: new Date('2018-04-12').getTime(), y: 157 },
              { x: new Date('2018-04-13').getTime(), y: 161 },
              { x: new Date('2018-04-14').getTime(), y: 166 },
              { x: new Date('2018-04-15').getTime(), y: 169 },
              { x: new Date('2018-04-16').getTime(), y: 172 },
              { x: new Date('2018-04-17').getTime(), y: 177 },
              { x: new Date('2018-04-18').getTime(), y: 181 },
              { x: new Date('2018-04-20').getTime(), y: 178 },
              { x: new Date('2018-04-21').getTime(), y: 173 },
              { x: new Date('2018-04-22').getTime(), y: 169 },
              { x: new Date('2018-04-23').getTime(), y: 163 },
              { x: new Date('2018-04-24').getTime(), y: 159 },
              { x: new Date('2018-04-25').getTime(), y: 164 },
              { x: new Date('2018-04-26').getTime(), y: 168 },
              { x: new Date('2018-04-27').getTime(), y: 172 },
              { x: new Date('2018-04-28').getTime(), y: 169 },
              { x: new Date('2018-04-29').getTime(), y: 163 },
              { x: new Date('2018-04-30').getTime(), y: 162 },
              { x: new Date('2018-05-01').getTime(), y: 158 },
              { x: new Date('2018-05-02').getTime(), y: 152 },
              { x: new Date('2018-05-03').getTime(), y: 147 },
              { x: new Date('2018-05-04').getTime(), y: 142 },
              { x: new Date('2018-05-05').getTime(), y: 147 },
              { x: new Date('2018-05-07').getTime(), y: 151 },
              { x: new Date('2018-05-08').getTime(), y: 155 },
              { x: new Date('2018-05-09').getTime(), y: 159 },
              { x: new Date('2018-05-11').getTime(), y: 162 },
              { x: new Date('2018-05-12').getTime(), y: 157 },
              { x: new Date('2018-05-13').getTime(), y: 161 },
              { x: new Date('2018-05-14').getTime(), y: 166 },
              { x: new Date('2018-05-15').getTime(), y: 169 },
              { x: new Date('2018-05-16').getTime(), y: 172 },
              { x: new Date('2018-05-17').getTime(), y: 177 },
              { x: new Date('2018-05-18').getTime(), y: 181 },
              { x: new Date('2018-05-20').getTime(), y: 178 },
              { x: new Date('2018-05-21').getTime(), y: 173 },
              { x: new Date('2018-05-22').getTime(), y: 169 },
              { x: new Date('2018-05-23').getTime(), y: 163 },
              { x: new Date('2018-05-24').getTime(), y: 159 },
              { x: new Date('2018-05-25').getTime(), y: 164 },
              { x: new Date('2018-05-26').getTime(), y: 168 },
              { x: new Date('2018-05-27').getTime(), y: 172 },
              { x: new Date('2018-05-28').getTime(), y: 169 },
              { x: new Date('2018-05-29').getTime(), y: 163 },
              { x: new Date('2018-05-30').getTime(), y: 162 },
            ],
          },
        ],
        chart: {
          type: 'area',
          stacked: !1,
          height: 350,
          zoom: { type: 'x', enabled: !0, autoScaleYaxis: !0 },
          toolbar: { autoSelected: 'zoom' },
        },
        colors: linechartZoomColors,
        dataLabels: { enabled: !1 },
        markers: { size: 0 },
        title: {
          text: 'Stock Price Movement',
          align: 'left',
          style: { fontWeight: 500 },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [0, 90, 100],
          },
        },
        yaxis: {
          showAlways: !0,
          labels: {
            show: !0,
            formatter: function (e) {
              return (e / 1e6).toFixed(0);
            },
          },
          title: { text: 'Price', style: { fontWeight: 500 } },
        },
        xaxis: { type: 'datetime' },
        tooltip: {
          shared: !1,
          y: {
            formatter: function (e) {
              return (e / 1e6).toFixed(0);
            },
          },
        },
      }),
      (chart = new ApexCharts(
        document.querySelector('#line_chart_zoomable'),
        options
      )).render()),
    getChartColorsArray('line_chart_datalabel2')),
  linechartDashedColors =
    (linechartDatalabelColors &&
      ((options = {
        chart: {
          height: 380,
          type: 'line',
          zoom: { enabled: !1 },
          toolbar: { show: !1 },
        },
        colors: linechartDatalabelColors,
        dataLabels: { enabled: !1 },
        stroke: { width: [3, 3], curve: 'straight' },
        series: [
          { name: 'Annuler', data: [
                echouer_stats.janvier,
                echouer_stats.fevrier,
                echouer_stats.mars,
                echouer_stats.avril,
                echouer_stats.mai,
                echouer_stats.juin,
                echouer_stats.juillet,
                echouer_stats.aout,
                echouer_stats.septembre,
                echouer_stats.octobre,
                echouer_stats.novembre,
                echouer_stats.decembre
            ] },
          { name: 'Effectuer', data: [
                paid_stats.janvier,
                paid_stats.fevrier,
                paid_stats.mars,
                paid_stats.avril,
                paid_stats.mai,
                paid_stats.juin,
                paid_stats.juillet,
                paid_stats.aout,
                paid_stats.septembre,
                paid_stats.octobre,
                paid_stats.novembre,
                paid_stats.decembre
            ] },
          { name: 'Tous', data: [
            all_stats.janvier,
            all_stats.fevrier,
            all_stats.mars,
            all_stats.avril,
            all_stats.mai,
            all_stats.juin,
            all_stats.juillet,
            all_stats.aout,
            all_stats.septembre,
            all_stats.octobre,
            all_stats.novembre,
            all_stats.decembre
          ]},

        ],
        title: {
          text: 'Paiements',
          align: 'left',
          style: { fontWeight: 500 },
        },
        grid: {
          row: { colors: ['transparent', 'transparent'], opacity: 0.2 },
          borderColor: '#f1f1f1',
        },
        markers: { style: 'inverted', size: 5 },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aout', 'Sep', 'Oct', 'Nov', 'Dec'],
          title: { text: 'Month' },
        },
        yaxis: { title: { text: 'Temperature' }, min: 5, max: 40 },
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          floating: !0,
          offsetY: -25,
          offsetX: -5,
        },
        responsive: [
          {
            breakpoint: 600,
            options: { chart: { toolbar: { show: !1 } }, legend: { show: !1 } },
          },
        ],
      }),
      (chart = new ApexCharts(
        document.querySelector('#line_chart_datalabel2'),
        options
      )).render()),
    getChartColorsArray('line_chart_dashed'));


</script>

@endpush
