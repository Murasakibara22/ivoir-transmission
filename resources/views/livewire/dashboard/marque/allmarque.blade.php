<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">marques</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">marques service</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                {{-- <div class="col-xl-6 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body bg-primary shadow">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-truncate mb-0 text-white"> Total marques</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0 text-white">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"><span>{{$list_marques->count()}}</span></h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-success rounded fs-3">
                                        <i class="bx bx-dollar-circle text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col --> --}}

                {{-- <div class="col-xl-6 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <a href="#" class="card-body bg-secondary shadow">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                 <p class="text-uppercase fw-medium text-truncate mb-0 text-white">Tous les services</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-danger fs-14 mb-0 text-white">
                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"><span>0</span></h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success rounded fs-3">
                                        <i class="bx bx-shopping-bag text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </a><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col --> --}}

            </div> <!-- end row-->

            <button type="button" class="btn btn-primary custom-toggle" wire:click='addtype'>
                <span class="icon-on"><i class=" ri-add-circle-fill align-bottom me-1" ></i> Ajouter un type</span>
            </button>

            <button type="button" class="btn btn-info custom-toggle" wire:click='addmarque'>
                <span class="icon-on"><i class=" ri-add-circle-fill align-bottom me-1" ></i> Ajouter une marque</span>
            </button>

            <div class="row mt-4">
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Marques de voiture</h4>
                            </div><!-- end card header -->

                            <div class="card-body">


                                <div class="live-preview">
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle table-nowrap mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">N'</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Date d'ajout</th>
                                                    <th scope="col" style="width: 150px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($list_marques && $list_marques->count() > 0)
                                                @foreach ($list_marques as $key => $item)
                                                <tr>
                                                    <td>
                                                        {{ $key+1 }}
                                                    </td>
                                                    <td class="text-uppercase text-primary">{{ Str::words($item->libelle, 10) }}</td>

                                                    <td>
                                                        {{ $item->created_at->format('d-m-Y') }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning" wire:click="editmarque({{ $item->id }})"><i class="ri-pencil-fill align-bottom me-1"></i> Modifier</button>
                                                        <button type="button" class="btn btn-sm btn-danger" wire:click="deletemarque({{ $item->id }})"><i class="ri-delete-bin-fill align-bottom me-1"></i> Supprimer</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center">
                                                            <h5 class="text-danger">Aucune marque de service</h5>
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


                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Type de Véhicule</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <p class="text-muted mb-4">
                                    Liste détaillée des Types de Véhicules
                                </p>

                                <div class="live-preview">
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle table-nowrap mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">N'</th>>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Date d'ajout</th>
                                                    <th scope="col" style="width: 150px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($list_type && $list_type->count() > 0)
                                                @foreach ($list_type as $key => $item)
                                                <tr>
                                                    <td>
                                                        {{ $key+1 }}
                                                    </td>
                                                    <td class="text-uppercase text-primary">{{ Str::words($item->libelle, 10) }}</td>

                                                    <td>
                                                        {{ $item->created_at->format('d-m-Y') }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning" wire:click="edittype({{ $item->id }})"><i class="ri-pencil-fill align-bottom me-1"></i> Modifier</button>
                                                        <button type="button" class="btn btn-sm btn-danger" wire:click="deletetype({{ $item->id }})"><i class="ri-delete-bin-fill align-bottom me-1"></i> Supprimer</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center">
                                                            <h5 class="text-danger fs-16">Aucun Type de voiture </h5>
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

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_marque" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                 {{-- chargement --}}
                <div wire:loading >
                    <div class="overlay">
                        <div class="spinner"></div>
                    </div>
                </div>


                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Nouvelle marque</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="alert alert-success  rounded-0 mb-0">
                    <p class="mb-0">Up to <span class="fw-semibold">50% OFF</span>, Hurry up before the stock ends</p>
                </div> --}}

                <div class="modal-body text-center p-4">
                    <form wire:submit.prevent='submitmarque'>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-start">Libelle marque</label>
                                    <input type="text" class="form-control" wire:model='libelle' placeholder="Entrer le nom de la category" id="firstNameinput">
                                    @error('libelle')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            {{-- <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Logo(facultatif)</label>
                                    <input type="file" class="form-control" accept=".png, .jpg, .jpeg" wire:model='Aslogo' placeholder="Enter your lastname" >
                                </div>
                            </div><!--end col--> --}}
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

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="edit_marque" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                   {{-- chargement --}}
                   <div wire:loading >
                        <div class="overlay">
                            <div class="spinner"></div>
                        </div>
                    </div>

                <div class="modal-header p-3 bg-warning">
                    <h4 class="card-title text-white mb-0">Modifier la marque : {{ $libelle }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="alert alert-success  rounded-0 mb-0">
                    <p class="mb-0">Up to <span class="fw-semibold">50% OFF</span>, Hurry up before the stock ends</p>
                </div> --}}

                <div class="modal-body text-center p-4">
                    <form wire:submit.prevent='updatemarque'>
                        <div class="row">

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-start">Libelle marque</label>
                                    <input type="text" class="form-control" wire:model='libelle' placeholder="Entrer le nom de la category" id="firstNameinput">
                                    @error('libelle')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            {{-- <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Logo(facultatif)</label>
                                    <input type="file" class="form-control" accept=".png, .jpg, .jpeg" wire:model='Aslogo' placeholder="Enter your lastname" >
                                </div>
                            </div><!--end col--> --}}
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



    {{-- Type  --}}


    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_type" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content">
                 {{-- chargement --}}
                <div wire:loading >
                    <div class="overlay">
                        <div class="spinner"></div>
                    </div>
                </div>


                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Nouveau type</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="alert alert-success  rounded-0 mb-0">
                    <p class="mb-0">Up to <span class="fw-semibold">50% OFF</span>, Hurry up before the stock ends</p>
                </div> --}}

                <div class="modal-body text-center p-4">
                    <form wire:submit.prevent='submittype'>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-start">Libelle Type</label>
                                    <input type="text" class="form-control"  wire:model='libelle_type' placeholder="Exemple: (SUV , Berling)" id="firstNameinput">
                                    @error('libelle_type')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            {{-- <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-start">Logo(facultatif)</label>
                                    <input type="file" class="form-control" accept=".png, .jpg, .jpeg" wire:model='Aslogo' placeholder="Enter your lastname" >
                                </div>
                            </div><!--end col--> --}}
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Valider</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="edit_type" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content">
                   {{-- chargement --}}
                   <div wire:loading >
                        <div class="overlay">
                            <div class="spinner"></div>
                        </div>
                    </div>

                <div class="modal-header p-3 bg-warning">
                    <h4 class="card-title text-white mb-0">Modifier Le type : {{ $libelle }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="alert alert-success  rounded-0 mb-0">
                    <p class="mb-0">Up to <span class="fw-semibold">50% OFF</span>, Hurry up before the stock ends</p>
                </div> --}}

                <div class="modal-body text-center p-4">
                    <form wire:submit.prevent='updatetype'>
                        <div class="row">

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-start">Libelle </label>
                                    <input type="text" class="form-control" wire:model='libelle_type' placeholder="Exemple: (SUV , Berling)" id="firstNameinput">
                                    @error('libelle_type')
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



    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="show_service_marque" aria-hidden="true">
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
                                @if ($list_produit && $list_produit->count() > 0)
                                @foreach ($list_produit as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ json_decode(App\Models\Produit::find($item->id)->images)[0] }}" alt="" class="avatar-xs rounded-2" />
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
                                        <a href="{{ route('dashboard.services') }}">Voir plus </a>
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
