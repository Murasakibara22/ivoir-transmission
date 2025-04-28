<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-n4 mx-n4">
                        <div class="bg-soft-info">
                            <div class="card-body pb-0 px-4">
                                <div class="row mb-3">
                                    <div class="col-md">
                                        <div class="row align-items-center g-3">
                                            <div class="col-md-auto">
                                                <div class="avatar-md">
                                                    <div class="avatar-title bg-white rounded-circle">
                                                        <img @if($show_user->photo_url != null) src="{{ $show_user->photo_url }}" @else src="https://api.dicebear.com/7.x/initials/svg?seed={{ $show_user->username }}" @endif alt="" class="avatar-xs">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div>
                                                    <h4 class="fw-bold">{{ $show_user->username }}</h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div>Date D'inscription : <span class="fw-medium">{{ date('d M, Y', strtotime($show_user->created_at)) }}</span></div>
                                                        <div class="vr"></div>
                                                        <div>Email : <span class="fw-medium">{{ $show_user->email ?? 'Aucun email renseigner' }}</span></div>
                                                        <div class="vr"></div>
                                                        <div>Contact : <span class="fw-medium">{{ $show_user->phone ?? 'Aucun email renseigner' }}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="hstack gap-1 flex-wrap">
                                            <button type="button" class="btn py-0 fs-16 favourite-btn active">
                                                <i class="ri-star-fill"></i>
                                            </button>
                                            <button type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-share-line"></i>
                                            </button>
                                            <button type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-flag-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link @if($currentPage == 'Order') active @endif fw-semibold" data-bs-toggle="tab" href="#javascript:void(0);" wire:click="togglecurrentPage('Order')">
                                            Commandes
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($currentPage == 'Favoris') active @endif fw-semibold" data-bs-toggle="tab" href="#javascript:void(0);" wire:click="togglecurrentPage('Favoris')" role="tab">
                                            Favoris
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($currentPage == 'Note') active @endif fw-semibold" data-bs-toggle="tab" href="#javascript:void(0);" wire:click="togglecurrentPage('Note')" role="tab">
                                            notes
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>



             <!-- end row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content text-muted">
                        <div class="tab-pane fade @if($currentPage == 'Note') active show @endif"  role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h5 class="card-title flex-grow-1">Note</h5>
                                    </div>


                                    <div class="row">
                                        @if($list_avis && $list_avis->count() > 0)
                                        @foreach($list_avis as $note)
                                            <div class="col-lg-4">
                                                <div class="card">
                                                    <div class="content card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ json_decode($note->produit()->first()->images)[0] }}" alt="" class="avatar-sm rounded">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <a href="{{ route('dashboard.produits.show',$note->produit()->first()->slug) }}" class="fs-15 h5">{{ Illuminate\Support\Str::limit($note->produit()->first()->libelle,30) }} </a>
                                                                <div class="d-flex flex-wrap gap-2 align-items-center mt-0">
                                                                    @for($i = 0; $i < $note->note; $i++)
                                                                    <span class="mdi mdi-star text-warning"></span>
                                                                    @endfor
                                                                </div>
                                                                <p class="text-muted mb-3 mt-2">{{$note->commentaire}}</p>
                                                                <a href="javascript:void(0);" class="fs-15 h5 mt-2 mb-4"> <small class="text-muted fs-13 fw-normal">{{ $note->created_at->diffForHumans() }}</small></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif
                                        <!--end col-->
                                    </div>
                                    <!--end row-->

                                </div>
                            </div>
                        </div>
                        <!-- end tab pane -->
                        <div class="tab-pane fade @if($currentPage == 'Favoris') active show @endif"  role="tabpanel">
                           <div class="row">
                            @if($list_favoris_user && $list_favoris_user->count() > 0)
                                @foreach($list_favoris_user as $produits)
                                    <div class="col-lg-3">
                                        <div class="card explore-box card-animate rounded">
                                            <div class="explore-place-bid-img">
                                                <img src="{{json_decode($produits->images)[0]}}" alt="" class="img-fluid card-img-top explore-img" />
                                                <div class="bg-overlay"></div>
                                            </div>
                                            <div class="card-body">
                                                <p class="fw-medium mb-0 float-end"><i class="mdi mdi-heart text-danger align-middle"></i> {{ $produits->favoris()->count() }} </p>
                                                <h5 class="mb-1"><a href="{{ route('dashboard.produits.show',$produits->slug) }}">{{ Illuminate\Support\Str::limit($produits->libelle, 25,'...') }}</a></h5>

                                            </div>
                                            <div class="card-footer border-top border-top-dashed">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 fs-14">
                                                        <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> <span class="fw-medium"></span>
                                                    </div>
                                                    @if($produits->prix_fixes)
                                                    <h5 class="flex-shrink-0 fs-14 text-primary mb-0">{{ number_format($produits->prix_fixes, 0, ',', '.') }} fcfa</h5>
                                                    @else
                                                    <h5 class="flex-shrink-0 fs-14 text-primary mb-0"> {{ number_format($produits->variante_produit?->min('prix'), 0, ',', '.')  }} <span class="text-success"> fcfa</span></h5>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                           </div>

                            <div class="row g-0 text-center text-sm-start align-items-center mb-3">
                                        <div class="col-sm-6">
                                            <ul class="pagination pagination-rounded justify-content-center justify-content-sm-end mb-sm-0">
                                                {{ $list_favoris_user->links() }}
                                            </ul>
                                        </div>
                                    </div>

                        </div>
                        <!-- end tab pane -->
                        <div class="tab-pane fade  @if($currentPage == 'Order') active show @endif"  role="tabpanel">
                            <div class="row g-4 mb-3">
                                <div class="col-sm">
                                    <div class="d-flex">
                                        <div class="search-box me-2">
                                            <input type="text" class="form-control" placeholder="Search member...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-danger" onClick="window.location.href='/'"><i class="ri-eye-fill align-bottom me-1"></i>toutes les commandes</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Commandes</h4>

                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <thead class="text-muted table-light">
                                                        <tr>
                                                            <th scope="col">ref</th>
                                                            <th scope="col">Montant</th>
                                                            <th scope="col">Methode Pay</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if($list_order_user && $list_order_user->count() > 0)
                                                        @foreach($list_order_user as $order)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ route('dashboard.orders.show',$order->slug) }}" class="fw-medium link-primary">{{$order->reference}}</a>
                                                            </td>
                                                            <td>
                                                                <span class="text-success">{{ number_format($order->montant , 0, ',', '.') }} fcfa</span>
                                                            </td>
                                                            <td>{{ $order->methode_payment}}</td>
                                                            <td>
                                                                @if($order->status == "en attente")
                                                                <span class="badge badge-soft-warning">{{ $order->status }}</span>
                                                                @elseif($order->status == "TERMINEE")
                                                                <span class="badge badge-soft-success">{{ $order->status }}</span>
                                                                @elseif($order->status == "ANNULER")
                                                                <span class="badge badge-soft-danger">{{ $order->status }}</span>
                                                                @elseif($order->status == "VALIDEE")
                                                                <span class="badge badge-soft-info">{{ $order->status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('dashboard.orders.show',$order->slug) }}" class="btn btn-sm btn-primary">
                                                                    <i class="ri-eye-fill align-bottom"></i> détails
                                                                </a>
                                                            </td>
                                                        </tr><!-- end tr -->
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="5" class="text-center">Aucun resultat n'a été trouvé !!</td>
                                                        </tr>
                                                        @endif

                                                    </tbody><!-- end tbody -->
                                                </table><!-- end table -->
                                            </div>
                                        </div>
                                    </div> <!-- .card-->
                                </div>
                            </div>

                            <div class="row g-0 text-center text-sm-start align-items-center mb-3">
                                <div class="col-sm-6">
                                    <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                                        {{ $list_order_user->links() }}
                                    </ul>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                        <!-- end tab pane -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->



        </div>
    </div>
</div>
