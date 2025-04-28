<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Product Details</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->




            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gx-lg-5">
                                <div class="col-xl-4 col-md-8 mx-auto">
                                    <div class="product-img-slider sticky-side-div">
                                        <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                            <div class="swiper-wrapper">
                                                @if($show_produit->images)
                                                    @foreach(json_decode($show_produit->images) as $img)
                                                    <div class="swiper-slide">
                                                        <img src="{{$img}}" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                        <!-- end swiper thumbnail slide -->
                                        <div class="swiper product-nav-slider mt-2">
                                            <div class="swiper-wrapper">
                                                @if($show_produit->images)
                                                    @foreach(json_decode($show_produit->images) as $img)
                                                        <div class="swiper-slide">
                                                            <div class="nav-slide-item">
                                                                <img src="{{$img}}" alt="" class="img-fluid d-block" />
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <!-- end swiper nav slide -->

                                        @if($show_produit->link_video)
                                        <div class="row">
                                            <div>
                                                <video controls height="318" style="width: 100%" controls  controlsList="nodownload" oncontextmenu="return false;" >
                                                    <source autoplay muted src="{{ $show_produit->link_video }}" type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                        @endif


                                    </div>

                                </div>
                                <!-- end col -->

                                <div class="col-xl-8">
                                    <div class="mt-xl-0 mt-5">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h4>{{ $show_produit->libelle }} </h4>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <div><a href="#" class="text-primary d-block">{{$show_produit->categorie?->libelle}}</a></div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">Marque : <span class="text-body fw-medium"> {{ $show_produit->marque ? $show_produit->marque->libelle : 'aucune' }}</span></div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">date : <span class="text-body fw-medium">{{ date('d-m-Y', strtotime($show_produit->created_at)) }}</span></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                            <div class="text-muted fs-16">
                                                <span class="mdi mdi-star text-warning"></span>
                                                <span class="mdi mdi-star text-warning"></span>
                                                <span class="mdi mdi-star text-warning"></span>
                                                <span class="mdi mdi-star text-warning"></span>
                                                <span class="mdi mdi-star text-warning"></span>
                                            </div>
                                            <div class="text-muted">( 5k {{$show_produit->note?->count()}} utilisateurs ont notés)</div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Prix :</p>
                                                    @if($show_produit->prix_fixe)
                                                        <h3 class="mb-0">{{number_format($show_produit->prix_fixe, 0, ',', '.')}} <span class="text-success"> fcfa</span> </h3>
                                                    @else
                                                    {{-- recuperer le prix le plus bas de la variante produit --}}
                                                        @if($show_produit->variante_produit->count() > 1)
                                                        <h3 class="mb-0"> {{ number_format($show_produit->variante_produit?->min('prix'), 0, ',', '.')  }} </h3> - <h3>{{ number_format($show_produit->variante_produit?->max('prix'), 0, ',', '.')  }} <span class="text-success"> fcfa</span> </h3>
                                                        @else
                                                        <h3 class="mb-0"> {{ number_format($show_produit->variante_produit?->min('prix'), 0, ',', '.')  }} <span class="text-success"> fcfa</span></h3>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="mt-4">
                                                    @if($show_produit->variante_produit && $show_produit->variante_produit->count() > 0)
                                                    <h5 class="fs-14">Variantes :</h5>
                                                    <div class="d-flex flex-wrap gap-2">

                                                        @foreach($show_produit->variante_produit as $variante)
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="p-2 border border-dashed rounded">
                                                                <div class="d-flex align-items-center">

                                                                    <div class="flex-grow-1">
                                                                        <p class="text-muted mb-1">longeur: {{$variante->longeur}}</p>
                                                                        <p class="mb-1">stock: {{$variante->stock}}, </p>
                                                                        <p class=" mb-1">volume: {{$variante->volume}}</p>
                                                                        <hr>
                                                                        <h5 class="mb-0 text-success">{{ number_format($variante->prix, 0, ',', '.')  }} fcfa</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <div class="col-xl-6">
                                                <div class=" mt-4">
                                                    <h5 class="fs-14">Couleurs :</h5>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @if($show_couleurs)
                                                            @foreach($show_couleurs as $color)
                                                                <p>{{$color}}</p>,
                                                            @endforeach
                                                        @endif

                                                        {{-- <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Out of Stock">
                                                            <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-primary" disabled>
                                                                <i class="ri-checkbox-blank-circle-fill"></i>
                                                            </button>
                                                        </div>
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="03 Items Available">
                                                            <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-secondary">
                                                                <i class="ri-checkbox-blank-circle-fill"></i>
                                                            </button>
                                                        </div>
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="03 Items Available">
                                                            <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-success">
                                                                <i class="ri-checkbox-blank-circle-fill"></i>
                                                            </button>
                                                        </div>
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="02 Items Available">
                                                            <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-info">
                                                                <i class="ri-checkbox-blank-circle-fill"></i>
                                                            </button>
                                                        </div>
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="01 Items Available">
                                                            <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-warning">
                                                                <i class="ri-checkbox-blank-circle-fill"></i>
                                                            </button>
                                                        </div>
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="04 Items Available">
                                                            <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-danger">
                                                                <i class="ri-checkbox-blank-circle-fill"></i>
                                                            </button>
                                                        </div>
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="03 Items Available">
                                                            <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-light">
                                                                <i class="ri-checkbox-blank-circle-fill"></i>
                                                            </button>
                                                        </div>
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="04 Items Available">
                                                            <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-dark">
                                                                <i class="ri-checkbox-blank-circle-fill"></i>
                                                            </button>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="mt-4 text-muted">
                                            @if($show_produit->description)
                                            <h5 class="fs-14">Description :</h5>
                                            <p>{!!$show_produit->description!!}</p>
                                            @endif
                                        </div>



                                        <div class="product-content mt-5">
                                            @if($show_produit->description)
                                            <h5 class="fs-14 mb-3">Description du produit:</h5>
                                            @endif
                                            <nav>
                                                <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab" href="#nav-speci" role="tab" aria-controls="nav-speci" aria-selected="true">Specification</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">Details</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-speci" role="tabpanel" aria-labelledby="nav-speci-tab">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row" style="width: 200px;">Categorie</th>
                                                                    <td>{{ $show_produit->categorie?->libelle }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Marque</th>
                                                                    <td>{{ $show_produit->marque ? $show_produit->marque->libelle : 'aucune'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Couleurs</th>
                                                                    <td>@if($show_couleurs)
                                                                        @foreach($show_couleurs as $color)
                                                                            {{$color}},
                                                                        @endforeach
                                                                    @endif</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Weight</th>
                                                                    <td> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                                                    <div>
                                                        <h5 class="font-size-16 mb-3">{{$show_produit->libelle}}</h5>
                                                        <p>{!! $show_produit->description !!}</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product-content -->

                                        <div class="mt-5">
                                            <div>
                                                <h5 class="fs-14 mb-3">Notes & Revues</h5>
                                            </div>
                                            <div class="row gy-4 gx-0">
                                                <div class="col-lg-8">
                                                    <div>
                                                        <div class="pb-3">
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
                                                                        <h6 class="mb-0">{{$moyenne_note}}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                                <div class="text-muted">Total <span class="fw-medium">5.50k</span> notes
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-3">
                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">5 étoiles</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-success" role="progressbar" @if($list_note->count() > 0) style="width: {{ $nb_person_note_five * 100 / $list_note->count() .'%'}}" @endif  aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">{{$nb_person_note_five}}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->

                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">4 étoiles</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-success" role="progressbar" @if($list_note->count() > 0) style="width: {{ $nb_person_note_four * 100 / $list_note->count() .'%'}}" @endif aria-valuenow="19.32" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">{{$nb_person_note_four}}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->

                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">3 étoiles</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-success" role="progressbar" @if($list_note->count() > 0) style="width: {{ $nb_person_note_three * 100 / $list_note->count() .'%'}}" @endif aria-valuenow="18.12" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">{{$nb_person_note_three}}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->

                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">2 étoiles</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-warning" role="progressbar" @if($list_note->count() > 0) style="width: {{ $nb_person_note_two * 100 / $list_note->count() .'%'}}" @endif aria-valuenow="7.42" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">{{$nb_person_note_two}}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->

                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">1 étoile</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-danger" role="progressbar" @if($list_note->count() > 0) style="width: {{ $nb_person_note_one * 100 / $list_note->count() .'%'}}" @endif aria-valuenow="4.98" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">{{$nb_person_note_one}}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->

                                                <!-- end col -->
                                            </div>
                                            <!-- end Ratings & Reviews -->
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
</div>



@push('scripts')

<script>
    document.addEventListener('contextmenu', event => event.preventDefault());
</script>

@endpush
