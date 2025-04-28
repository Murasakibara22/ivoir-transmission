<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Produits</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">produits</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>



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
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Tous</p>
                                                <h4 class=" mb-0"><span>{{ $list_produits->count() }}</span></h4>
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
                                                <span class="avatar-title bg-light text-success rounded-circle fs-3">
                                                    <i class="ri-arrow-up-circle-fill align-middle"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Activer</p>
                                                <h4 class=" mb-0"><span>{{ $list_produits->where('status', 'ACTIVATED')->count() }}</span></h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-end">
                                                <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>3.67 %<span> </span></span>
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
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Inactif</p>
                                                <h4 class=" mb-0"><span>{{ $list_produits->where('status', 'INACTIVATED')->count() }}</span></h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-end">
                                                <span class="badge badge-soft-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>4.80 %<span> </span></span>
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


                <div class="col-xl-12 col-lg-12">
                    <div>
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row g-4">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-success" wire:click='addproduit'
                                               ><i class="ri-add-line align-bottom me-1"></i> Ajouter
                                                un produit</a>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control" wire:model.live="search"
                                                    placeholder="Search Products...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- end card header -->
                            <div class="card-body">

                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" role="tabpanel">
                                        <div id="table-product-list-published" class="table-card gridjs-border-none">
                                            <div role="complementary" class="gridjs gridjs-container"
                                                style="width: 100%;">
                                                <div class="gridjs-wrapper" style="height: auto;">
                                                    <table role="grid" class="gridjs-table" style="height: auto;">
                                                        <thead class="gridjs-thead">
                                                            <tr class="gridjs-tr">
                                                                <th data-column-id="#" class="gridjs-th text-muted"
                                                                    style="width: 40px;">
                                                                    <div class="gridjs-th-content">#</div>
                                                                </th>
                                                                <th class="gridjs-th gridjs-th-sort text-muted"
                                                                    tabindex="0" style="width: 360px;">
                                                                    <div class="gridjs-th-content">Product</div>
                                                                </th>
                                                                <th class="gridjs-th gridjs-th-sort text-muted"
                                                                    tabindex="0" style="width: 94px;">
                                                                    <div class="gridjs-th-content">Stock</div>
                                                                </th>
                                                                <th data-column-id="price"
                                                                    class="gridjs-th gridjs-th-sort text-muted"
                                                                    tabindex="0" style="width: 101px;">
                                                                    <div class="gridjs-th-content">Price</div>
                                                                </th>
                                                                <th data-column-id="orders"
                                                                    class="gridjs-th gridjs-th-sort text-muted"
                                                                    tabindex="0" style="width: 84px;">
                                                                    <div class="gridjs-th-content">status</div>
                                                                </th>
                                                                <th class="gridjs-th gridjs-th-sort text-muted"
                                                                    tabindex="0" style="width: 105px;">
                                                                    <div class="gridjs-th-content">Rating</div>
                                                                </th>
                                                                <th data-column-id="published"
                                                                    class="gridjs-th gridjs-th-sort text-muted"
                                                                    tabindex="0" style="width: 220px;">
                                                                    <div class="gridjs-th-content">Published</div>
                                                                </th>
                                                                <th data-column-id="action" class="gridjs-th text-muted"
                                                                    style="width: 80px;">
                                                                    <div class="gridjs-th-content">Action</div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="gridjs-tbody">
                                                            @if($list_produits && $list_produits->count() > 0)
                                                                @foreach($list_produits as $key => $item)
                                                                <tr class="gridjs-tr">
                                                                    <td data-column-id="#" class="gridjs-td"><span>
                                                                            <div class="form-check checkbox-product-list">
                                                                                {{$key  + 1}}
                                                                            </div>
                                                                        </span></td>
                                                                    <td data-column-id="product" class="gridjs-td"><span>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="flex-shrink-0 me-3">
                                                                                    <div class="avatar-sm bg-light rounded p-1">
                                                                                        @if($item->images)
                                                                                        <img src="{{ json_decode($item->images)[0] }}"
                                                                                            alt=""
                                                                                            class="img-fluid d-block w-100 h-100">
                                                                                        @else
                                                                                        <img src="assets/images/products/img-2.png"
                                                                                            alt=""
                                                                                            class="img-fluid d-block">
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="flex-grow-1">
                                                                                    <h5 class="fs-14 mb-1"><a
                                                                                            href="apps-ecommerce-product-details.html"
                                                                                            class="text-dark">{{$item->libelle}}</a></h5>
                                                                                    <p class="text-muted mb-0">Categorie :
                                                                                        @if($item->categories()->count() > 0 )
                                                                                        <span
                                                                                            class="fw-medium"> @foreach( $item->categories() as $cat) {{ $cat->libelle }} | @endforeach</span>
                                                                                        @else
                                                                                        <span
                                                                                            class="fw-medium">{{ $item->categorie?->libelle}}</span>
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </span></td>
                                                                    <td  class="gridjs-td">{{$item->stock}}</td>
                                                                    <td  class="gridjs-td">
                                                                        @if($item->prix_fixe)
                                                                            <span>{{ number_format($item->prix_fixe, 0, ',', '.') }} <span class="text-success"> fcfa</span> </span>
                                                                        @else
                                                                        {{-- recuperer le prix le plus bas de la variante produit --}}
                                                                            <span> {{ number_format($item->variante_produit?->min('prix'), 0, ',', '.')  }} <span class="text-success"> fcfa</span></span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="gridjs-td">
                                                                        @if($item->status == "ACTIVATED" && $item->stock > 3)
                                                                            <span class="badge bg-success fs-12 ">activer</span>
                                                                        @elseif($item->status == "ACTIVATED" && $item->stock <= 3 && $item->stock > 0)
                                                                            <span class="badge bg-warning fs-12 ">faible stock</span>
                                                                        @elseif($item->status == "ACTIVATED" && $item->stock == 0)
                                                                            <span class="badge bg-danger fs-12 ">Rupture de stock</span>
                                                                        @else
                                                                            <span class="badge bg-danger fs-12 ">desactiver</span>
                                                                        @endif
                                                                    </td>
                                                                    <td  class="gridjs-td">
                                                                        <span><span
                                                                                class="badge bg-light text-body fs-12 fw-medium"><i
                                                                                    class="mdi mdi-star text-warning me-1"></i>{{ $item->moyenneNote() ? $item->moyenneNote() : 0 }}</span></span>
                                                                    </td>
                                                                    <td data-column-id="published" class="gridjs-td">
                                                                        <span>{{ date('d, M Y', strtotime($item->created_at))}}<small
                                                                                class="text-muted ms-1">{{ date('H:i', strtotime($item->created_at))}}</small></span>
                                                                    </td>
                                                                    <td data-column-id="action" class="gridjs-td"><span>
                                                                            <div class="dropdown"><button
                                                                                    class="btn btn-soft-secondary btn-sm dropdown"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false"><i
                                                                                        class="ri-more-fill"></i></button>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-end">
                                                                                    <li><a class="dropdown-item"
                                                                                            href="{{ route('dashboard.produits.show', $item->slug) }}"><i
                                                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                                            Détail</a></li>
                                                                                    <li><a class="dropdown-item" wire:click="showImages({{$item->id}})"
                                                                                            href="javascript:void(0)"><i
                                                                                                class="ri-image-fill align-bottom me-2 text-muted"></i>
                                                                                            Voir les images</a></li>
                                                                                    <li><a class="dropdown-item" wire:click="editProduit({{$item->id}})"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                            Modifier</a></li>
                                                                                    <li><a class="dropdown-item" wire:click="changeStatus({{$item->id}})"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="@if( $item->status == "ACTIVATED") ri-recycle-fill text-danger @else ri-play-fill text-success @endif align-bottom me-2 text-muted"></i>
                                                                                            @if($item->status == "ACTIVATED") Desactiver @else Activer @endif</a></li>
                                                                                    <li class="dropdown-divider"></li>
                                                                                    <li><a class="dropdown-item remove-list" wire:click="deleteProduit({{$item->id}})"
                                                                                            href="javascript:void(0);">
                                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                            Supprimer</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </span></td>
                                                                </tr>
                                                                @endforeach
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{-- <div class="gridjs-footer">
                                                    <div class="gridjs-pagination">
                                                        <div class="gridjs-pages"></div>
                                                    </div>
                                                </div> --}}

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- end tab content -->

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>


        </div>
    </div>




    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_produits"
        aria-hidden="true">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                {{-- chargement --}}
                <div wire:loading>
                    <div class="overlay">
                        <div class="spinner"></div>
                    </div>
                </div>

                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Enregistrer un produit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='SubmitProduit'>

                    <div class="modal-body text-center p-4">

                        <div class="row">
                            @if ($AsImages_produit)
                                @foreach ($AsImages_produit as $image)
                                    <div class="col-3">
                                        <div class="tex-center">
                                            <div class="position-relative d-inline-block mx-auto  mb-4">
                                                <img src="{{ $image->temporaryUrl() }}"
                                                    class="avatar-xl img-thumbnail user-profile-image"
                                                    alt="user-profile-image">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Nom du produit <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model='libelle'
                                        placeholder="Entrer le nom du produit" id="firstNameinput">
                                    @error('libelle')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Prix <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" wire:model='prix_fixe'
                                        placeholder="Veuillez renseigner le Prix ">
                                    @error('prix_fixe')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->

                            {{--
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Catégorie de produit <span
                                        class="text-danger">*</span> </label>
                                    <select  @if (!$list_categorie || $list_categorie->count() == 0) disanbled @endif class="form-select" id="multiselect-input" size="3" multiple aria-label="Multiple select example" wire:model='categories_select'>
                                        <option selected>selectionner des catégories...</option>
                                        @foreach ($list_categorie as $item)
                                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                        @endforeach
                                    </select>
                                    @error('categories_select')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                  </div>
                            </div> --}}
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Catégorie de produit <span
                                            class="text-danger">*</span> </label>
                                    <select @if (!$list_categorie || $list_categorie->count() == 0) disanbled @endif class="form-select mb-3"
                                        wire:model='categorie_id'>
                                        <option selected>selectionner une catégorie...</option>
                                        @foreach ($list_categorie as $item)
                                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                        @endforeach
                                    </select>
                                    @error('categorie_id')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->



                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Type <span
                                            class="text-muted">(Facultatif)</span> </label>
                                    <select @if (!$list_type) disanbled @endif class="form-select mb-3"
                                        wire:model='type'>
                                        <option selected>sélectionner un type...</option>
                                        @foreach ($list_type as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label text-start">Images du produit <span
                                            class="text-danger">*</span> </label>
                                    <input type="file" class="form-control" multiple wire:model='AsImages_produit'
                                        placeholder="ajouter des images">
                                    @error('AsImages_produit')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label text-start">Video <span class="text-muted">( Facultatif
                                            )</span> </label>
                                    <input type="file" class="form-control" accept="video/*" wire:model='AsVideo'
                                        placeholder="Une vidéo">
                                    @error('AsVideo')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label text-start">Stock Générale <span class="text-muted">(
                                            Facultatif )</span> </label>
                                    <input type="number" class="form-control" wire:model='stock_general'
                                        placeholder="Stock générale...">
                                    @error('stock_general')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->

                            {{-- <div class="col-12">
                                    <label for="placeholderInput" class="form-label">Couleurs générales <span class="text-muted">( Facultatif )</span></label>

                                        <div class="mb-3 mt-2">
                                            @foreach ($couleursDisponibles as $key => $couleur)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $key }}"
                                                        wire:model.defer="couleurs"
                                                        value="{{ $couleur }}">
                                                    <label class="form-check-label">{{ $couleur }}</label>
                                                </div>
                                            @endforeach
                                            @error('couleurs')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div><!--end col--> --}}

                            <div class="col-12" wire:ignore>
                                <div class="mb-3">
                                    <label for="compnayNameinput" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" wire:model.lazy='description' name="description" rows="5"></textarea>
                                    @error('description')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->





                            <h2>Variante Produit</h2>

                            @if ($inputsVariante != null)
                                @foreach ($inputsVariante as $key => $item)
                                    <div class="row mt-2">

                                        @if ($key != 0)
                                            <hr />
                                        @endif
                                        <div class="col-4 mt-4">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Taille <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    wire:model.lazy="inputsVariante.{{ $key }}.longeur"
                                                    placeholder="(Ex: XL, XXL, M, S)  ...">
                                            </div>
                                            @error('inputsVariante.' . $key . '.longeur')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        {{-- <div class="col-2 mt-4">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Le volume <span
                                                        class="text-muted">facultatif</span></label>
                                                <input type="text" class="form-control"
                                                    wire:model.lazy="inputsVariante.{{ $key }}.volume"
                                                    placeholder="(ex: 100g, 200g) ...">
                                            </div>
                                            @error('inputsVariante.' . $key . '.volume')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}


                                        <div class="col-3 mt-4">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Stocks <span
                                                        class="text-muted">(facultatif)</span></label>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="inputsVariante.{{ $key }}.stock"
                                                    placeholder="Entrer un stock ...">
                                            </div>
                                            @error('inputsVariante.' . $key . '.stock')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mt-4">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Coût <span
                                                        class="text-muted">(facultatif)</span></label>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="inputsVariante.{{ $key }}.prix"
                                                    placeholder="Entrer un prix ...">
                                            </div>
                                            @error('inputsVariante.' . $key . '.prix')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="col-3 mt-4">
                                            @foreach ($couleursDisponibles as $couleur)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model.defer="inputsVariante.{{ $key }}.couleurs"
                                                        value="{{ $couleur }}">
                                                    <label class="form-check-label">{{ $couleur }}</label>
                                                </div>
                                            @endforeach
                                            @error('inputsVariante.' . $key . '.couleurs')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}


                                        <div class="mt-5 col-md-1">
                                            <div class="input-group col-md-6">
                                                <button type="button"
                                                    wire:click='removeInputsVariante({{ $key }})'
                                                    class="btn btn-soft-danger light btn-icon-xs mt-1">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @endif


                            <div class="my-4 col-md-4 mx-auto">
                                <button type="button" wire:click='addInputsVariante'
                                    class="btn btn-soft-primary light btn-icon-xs">
                                    <i class="ri-add-line"></i> ajouter une variante
                                </button>
                            </div>


                        </div><!--end row-->
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Enregistrer</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="edit_produit"
        aria-hidden="true">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                {{-- chargement --}}
                <div wire:loading>
                    <div class="overlay">
                        <div class="spinner"></div>
                    </div>
                </div>

                <div class="modal-header p-3 bg-warning">
                    <h4 class="card-title text-white mb-0">Modifier le produit : {{$libelle}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='UpdateProduit'>

                    <div class="modal-body text-center p-4">


                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Nom du produit <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model='libelle'
                                        placeholder="Entrer le nom du produit" id="firstNameinput">
                                    @error('libelle')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Prix <span
                                            class="text-muted">(facultatif)</span></label>
                                    <input type="number" class="form-control" wire:model='prix_fixe'
                                        placeholder="Veuillez renseigner le Prix ">
                                    @error('prix_fixe')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->


                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Catégorie de produit <span
                                            class="text-danger">*</span> </label>
                                    <select @if (!$list_categorie || $list_categorie->count() == 0) disanbled @endif class="form-select mb-3"
                                        wire:model='categorie_id'>
                                        <option selected>selectionner une catégorie...</option>
                                        @foreach ($list_categorie as $item)
                                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                        @endforeach
                                    </select>
                                    @error('categorie_id')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->



                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Type <span
                                            class="text-muted">(Facultatif)</span> </label>
                                    <select @if (!$list_type) disanbled @endif class="form-select mb-3"
                                        wire:model='type'>
                                        <option selected>sélectionner une marque...</option>
                                        @foreach ($list_type as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->


                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label text-start">Video <span class="text-muted">( Facultatif
                                            )</span> </label>
                                    <input type="file" accept="video/*"  class="form-control" wire:model='AsVideo'
                                        placeholder="Une vidéo">
                                    @error('AsVideo')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label text-start">Stock Générale <span class="text-muted">(
                                            Facultatif )</span> </label>
                                    <input type="number" class="form-control" wire:model='stock_general'
                                        placeholder="Stock générale...">
                                    @error('stock_general')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->


                            <div class="col-12" wire:ignore>
                                <div class="mb-3">
                                    <label for="compnayNameinput" class="form-label">Description</label>
                                    <textarea class="form-control" id="description2" wire:model.lazy='description' name="description" rows="5"></textarea>
                                    @error('description')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->





                            <h2>Variante Produit</h2>

                            @if ($inputsVariante != null)
                                @foreach ($inputsVariante as $key => $item)
                                    <div class="row mt-2">

                                        @if ($key != 0)
                                            <hr />
                                        @endif
                                        <div class="col-4 mt-4">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Taille <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    wire:model.lazy="inputsVariante.{{ $key }}.longeur"
                                                    placeholder="(Ex: XL, XXL, M, S)  ...">
                                            </div>
                                            @error('inputsVariante.' . $key . '.longeur')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        {{-- <div class="col-2 mt-4">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Le volume <span
                                                        class="text-muted">facultatif</span></label>
                                                <input type="text" class="form-control"
                                                    wire:model.lazy="inputsVariante.{{ $key }}.volume"
                                                    placeholder="(ex: 100g, 200g) ...">
                                            </div>
                                            @error('inputsVariante.' . $key . '.volume')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}


                                        <div class="col-3 mt-4">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Stocks <span
                                                        class="text-muted">(facultatif)</span></label>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="inputsVariante.{{ $key }}.stock"
                                                    placeholder="Entrer un stock ...">
                                            </div>
                                            @error('inputsVariante.' . $key . '.stock')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mt-4">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Coût <span
                                                        class="text-muted">(facultatif)</span></label>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="inputsVariante.{{ $key }}.prix"
                                                    placeholder="Entrer un prix ...">
                                            </div>
                                            @error('inputsVariante.' . $key . '.prix')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="col-3 mt-4">
                                            @foreach ($couleursDisponibles as $couleur)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model.defer="inputsVariante.{{ $key }}.couleurs"
                                                        value="{{ $couleur }}">
                                                    <label class="form-check-label">{{ $couleur }}</label>
                                                </div>
                                            @endforeach
                                            @error('inputsVariante.' . $key . '.couleurs')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}


                                        <div class="mt-5 col-md-1">
                                            <div class="input-group col-md-6">
                                                <button type="button"
                                                    wire:click='removeInputsVariante({{ $key }})'
                                                    class="btn btn-soft-danger light btn-icon-xs mt-1">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @endif


                            <div class="my-4 col-md-4 mx-auto">
                                <button type="button" wire:click='addInputsVariante'
                                    class="btn btn-soft-primary light btn-icon-xs">
                                    <i class="ri-add-line"></i> ajouter une variante
                                </button>
                            </div>


                        </div><!--end row-->
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Enregistrer</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="view_img"
        aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                {{-- chargement --}}
                <div wire:loading>
                    <div class="overlay">
                        <div class="spinner"></div>
                    </div>
                </div>

                <div class="modal-header p-3 bg-light" >
                    <h4 class="card-title  mb-0">Images du produit : {{$libelle}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='Ajout_ImagesSecondaire_atProduct'>

                    <div class="modal-body text-center p-4">
                        <div class="row">



                            <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-1">
                                @if($list_images_preview )
                                    @foreach($list_images_preview as $key => $image)
                                        <div class="col">
                                            <div class="card">
                                                <img src="{{$image}}" alt="" class="object-cover card-img-top" height="120">
                                                <div class="card-body text-center">
                                                    <button class="btn btn-soft-danger w-100" type="button" wire:click="deleteOneImage_atProduct({{ $key }})">delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                            <div class="row">
                                <div class="col-8 mx-auto">
                                    <div class="mb-3">
                                        <label class="form-label text-start">ajouter d'autres images <span
                                                class="text-danger">*</span> </label>
                                        <input type="file" class="form-control" multiple wire:model='AsImages_produit'
                                            placeholder="ajouter des images">
                                        @error('AsImages_produit')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                            </div>

                            <div class="row">
                                @if ($AsImages_produit)
                                    @foreach ($AsImages_produit as $key => $image)
                                        <div class="col">
                                            <div class="card">
                                                <img src="{{$image->temporaryUrl() }}" alt="" class="object-cover card-img-top" height="120">
                                                <button class="btn btn-soft-danger w-100" type="button" wire:click="deleteOneImage_atSelection({{ $key }})">delete</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Enregistrer</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>



@push('styles')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <style>
        .feedback-text {
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #f06548;
        }
    </style>
@endpush



@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Entrer une bref description......',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $description) {
                        @this.set('description', contents);
                    }
                }
            });
        });

        $(document).ready(function() {
            $('#description2').summernote({
                placeholder: 'Entrer une bref description......',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $description) {
                        @this.set('description', contents);
                    }
                }
            });
        });

        $(document).ready(function() {
            $('#descriptionService').summernote({
                placeholder: 'Entrer une bref description......',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $descriptionService) {
                        @this.set('descriptionService', contents);
                    }
                }
            });
        });
    </script>
@endpush
