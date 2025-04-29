<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">CATEGORIES DE Services</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">Catégories service</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body bg-primary shadow">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-truncate mb-0 text-white"> Total Catégories</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0 text-white">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"><span>{{$list_categories->count()}}</span></h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-success rounded fs-3">
                                        <i class="bx bx-dollar-circle text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-6 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <a href="#" class="card-body bg-secondary shadow">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                 <p class="text-uppercase fw-medium text-truncate mb-0 text-white">Tous les services</p>
                                </div>

                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"><span>{{ App\Models\Service::count() }}</span></h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success rounded fs-3">
                                        <i class="bx bx-shopping-bag text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </a><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

            </div> <!-- end row-->

            <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Catégories </h4>

                                <div class="flex-shrink-0">

                                    <button type="button" class="btn btn-primary custom-toggle" wire:click='addCategorieService'>
                                        <span class="icon-on"><i class=" ri-add-circle-fill align-bottom me-1" ></i> Ajouter une catégorie</span>
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <p class="text-muted mb-4">
                                    Liste détaillée des catégories de
                                </p>

                                <div class="live-preview">
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle table-nowrap mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">N'</th>
                                                    <th scope="col">logo</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Frais Service</th>
                                                    <th scope="col">Services</th>
                                                    <th scope="col">Date d'ajout</th>
                                                    <th scope="col" style="width: 150px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($list_categories && $list_categories->count() > 0)
                                                @foreach ($list_categories as $key => $item)
                                                <tr>
                                                    <td>
                                                        {{ $key+1 }}
                                                    </td>
                                                    <td class="d-flex">
                                                        <img src="{{ $item->logo ?? 'https://api.dicebear.com/9.x/adventurer-neutral/svg?seed=$item->libelle' }}" alt="" class="avatar-xs rounded-3 me-2">
                                                    </td>
                                                    <td class="text-uppercase text-primary">{{ Str::words($item->libelle, 5) }}</td>
                                                    @if($item->description)
                                                    <td>{!! Illuminate\Support\Str::words( $item->description, 40) !!}</td>
                                                    @else
                                                    <td>Aucune description</td>
                                                    @endif
                                                    <td>
                                                        {{ $item->frais_service ? number_format($item->frais_service, 0, ',', '.').' FCFA' : 'Aucun'}}
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-sm btn-light" wire:click="showServiceCategorieService({{ $item->id }})"><i class="ri-eye-fill align-bottom me-1"> </i> {{ $item->services->count() }}</button>
                                                    </td>
                                                    <td>
                                                        {{ $item->created_at->format('d-m-Y') }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning" wire:click="editCategorieService({{ $item->id }})"><i class="ri-pencil-fill align-bottom me-1"></i> Modifier</button>
                                                        <button type="button" class="btn btn-sm btn-danger" wire:click="deleteCategorieService({{ $item->id }})"><i class="ri-delete-bin-fill align-bottom me-1"></i> Supprimer</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center">
                                                            <h5 class="text-danger">Aucune catégorie de service</h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
            </div>
        </div>
    </div>



    {{-- Modal --}}

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_categorie" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                 {{-- chargement --}}
                <div wire:loading >
                    <div class="overlay">
                        <div class="spinner"></div>
                    </div>
                </div>


                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Nouvelle catégorie</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="alert alert-success  rounded-0 mb-0">
                    <p class="mb-0">Up to <span class="fw-semibold">50% OFF</span>, Hurry up before the stock ends</p>
                </div> --}}

                <div class="modal-body text-center p-4">
                    <form wire:submit.prevent='submitCategorieService'>
                        <div class="row">
                            @if (!is_null($Aslogo))
                            <div class="col-12">
                                <img class="image icon-shape icon-xxxl bg-light rounded-4" style="height: 150px ; width: 150px" @if (!is_null($Aslogo))  src="{{ $Aslogo->temporaryUrl()}}" @endif alt="logo categorie " />
                            </div>
                            @endif
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Libelle catégorie</label>
                                    <input type="text" class="form-control" wire:model='libelle' placeholder="Entrer le nom de la category" id="firstNameinput">
                                    @error('libelle')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Logo(facultatif)</label>
                                    <input type="file" class="form-control" accept=".png, .jpg, .jpeg" wire:model='Aslogo' placeholder="Enter your lastname" >
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3" wire:ignore>
                                    <label for="compnayNameinput" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" wire:model='description' rows="5"></textarea>
                                </div>
                                @error('description')
                                    <span class="feedback-text">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Frais de service <span class="text-muted">( FACULTATIF )</span> </label>
                                    <input type="number" class="form-control" wire:model='frais_service' placeholder="Entrer les frais de service" >
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Valider les informations</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="edit_categorie" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                   {{-- chargement --}}
                   <div wire:loading >
                        <div class="overlay">
                            <div class="spinner"></div>
                        </div>
                    </div>

                <div class="modal-header p-3 bg-warning">
                    <h4 class="card-title text-white mb-0">Modifier la catégorie : {{ $libelle }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="alert alert-success  rounded-0 mb-0">
                    <p class="mb-0">Up to <span class="fw-semibold">50% OFF</span>, Hurry up before the stock ends</p>
                </div> --}}

                <div class="modal-body text-center p-4">
                    <form wire:submit.prevent='updateCategorieService'>
                        <div class="row">
                            <div class="col-12">
                                <img class="image icon-shape icon-xxxl bg-light rounded-4" @if (!is_null($Aslogo)) src="{{ $Aslogo->temporaryUrl() }}" @elseif(!is_null(App\Models\CategorieService::find($idCategorieService)))
                                src="{{ App\Models\CategorieService::find($idCategorieService)->logo }}"
                                @else
                                src="../Backend/images"
                                @endif alt="logo categorie"  style="height: 150px ; width: 150px"/>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Libelle catégorie</label>
                                    <input type="text" class="form-control" wire:model='libelle' placeholder="Entrer le nom de la category" id="firstNameinput">
                                    @error('libelle')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Logo  <span class="text-muted">( FACULTATIF )</span> </label>
                                    <input type="file" class="form-control" accept=".png, .jpg, .jpeg" wire:model='Aslogo' placeholder="Enter your lastname" >
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Frais de service <span class="text-muted">( FACULTATIF )</span> </label>
                                    <input type="number" class="form-control" wire:model='frais_service' placeholder="Entrer les frais de service" >
                                </div>
                            </div><!--end col-->
                            <div class="col-6" wire:ignore>
                                <div class="mb-3" >
                                    <label for="compnayNameinput" class="form-label">Description</label>
                                    <textarea class="form-control" id="description2"  wire:model.lazy='description' name="description" rows="5"></textarea>
                                    @error('description')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-warning">Modifier</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="show_service_CategorieService" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title  mb-0">Tous les services de la catégorie: <strong>{{ $libelle }} </strong> </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- <div class="alert alert-success  rounded-0 mb-0">
                    <p class="mb-0">Up to <span class="fw-semibold">50% OFF</span>, Hurry up before the stock ends</p>
                </div> -->

                <div class="modal-body text-center p-4">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>

                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">prix</th>
                                    <th scope="col">status</th>
                                    <th scope="col">Marques</th>
                                    <th scope="col">category_id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list_service && $list_service->count() > 0)
                                @foreach ($list_service as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ json_decode(App\Models\Service::find($item->id)->images)[0] }}" alt="" class="avatar-xs rounded-2" />
                                            </div>
                                            <div class="flex-grow-1">
                                                {{ str::words($item->libelle, 3) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->prix_fixe)
                                            <span>{{ number_format($item->prix_fixe, 0, ',', '.') }} <span class="text-success"> fcfa</span> </span>
                                        @else
                                        {{-- recuperer le prix le plus bas de la variante produit --}}
                                            <span> {{ number_format($item->variante_produit?->min('prix'), 0, ',', '.')  }} <span class="text-success"> fcfa</span></span>
                                        @endif
                                    </td>
                                    <td>
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
                                    <td>
                                        @if($item->marque)
                                            {{ $item->marque->libelle }}
                                        @else
                                            Aucune marque
                                        @endif
                                    </td>
                                    <td>{{ $libelle }}</td>
                                </tr>

                                @if($key > 1)
                                    @break
                                @endif


                                @endforeach
                                @endif
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="6">
                                        <a href="#">Voir plus </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- end table responsive -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>





@push('styles')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <style>
        .feedback-text{
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
