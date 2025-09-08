<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">SERVICES</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">Services</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <a href="{{ route('dashboard.services') }}" class="card card-animate shadow-lg">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                        <i class="text-primary ri-briefcase-4-line"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total des besoins</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span>{{ $all_stats_service }}</span></h4>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Lister tous les services</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </a>
                </div><!-- end col -->

                <div class="col-xl-4 col-md-6">
                    <a href="javascript:void(0)" class="card card-animate shadow-lg">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                        <i class="text-warning ri-award-line"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted mb-3">Meilleurs besoins</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span>0</span></h4>
                                    </div>
                                    <p class="text-muted mb-0">Liste des services les plus réservés</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </a>
                </div><!-- end col -->

                <div class="col-xl-4 col-md-6">
                    <a href="#" class="card card-animate shadow-lg">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
                                        <i class="text-info ri-file-list-3-line"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Réservation</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span>{{ App\Models\Reservation::count() }}</span></h4>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Lister toutes les réservations</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </a>
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row g-4 mb-3">
                <div class="col-sm-auto">
                    <div>
                        <a href="javascript:void(0)" wire:click='addService' class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Ajouter un besoin</a>
                    </div>
                </div>
                {{-- <div class="col-sm-auto">
                    <div>
                        <a href="javascript:void(0)" wire:click='addFraisService' class="btn btn-info"><i class="ri-add-circle-line align-bottom me-1"></i>Frais de service nounou</a>
                    </div>
                </div> --}}
                <div class="col-sm">
                    <div class="d-flex justify-content-sm-end gap-2">
                        <div class="search-box ms-2">
                            <input type="text" class="form-control" wire:keydown.enter='searchService' wire:model='search' placeholder="Recherche...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Tous les services</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold text-uppercase fs-12">Trier par: </span><span class="text-muted">{{ $filter}}<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a wire:click='filterService("Todays")' class="dropdown-item" href="#">Aujourd'hui</a>
                                        <a wire:click='filterService("Hier")' class="dropdown-item" href="#">Hier</a>
                                        <a wire:click='filterService("SevenDays")' class="dropdown-item" href="#">Il y a 7 jours</a>
                                        <a wire:click='filterService("Month")' class="dropdown-item" href="#">Ce Mois</a>
                                        <a wire:click='filterService("LastMonth")' class="dropdown-item" href="#">Mois dernier</a>
                                        <a wire:click='filterService("Autre")'  class="dropdown-item" href="#">Autre</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-nowrap align-middle mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col">Services</th>
                                            <th scope="col">categories</th>
                                            <th scope="col">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($list_service && $list_service->count() > 0)
                                        @foreach($list_service as $service)
                                        <tr>
                                            <td class="d-flex">
                                                <img src="{{ 'https://ui-avatars.com/api/?name=' . $service->libelle . '&background=0D8ABC&color=fff' }}" alt="" class="avatar-xs rounded-3 me-2">
                                                <div>
                                                    <h5 class="fs-13 mb-0">{{ $service->libelle }}</h5>
                                                    <p class="fs-12 mb-0 text-muted">Actif </p>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                {{ number_format($service->frais_service, 0, ',','.') }} fcfa
                                            </td> --}}

                                            <td>
                                                {{ $service->categorieService ?  $service->categorieService->libelle : 'Aucune' }}
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" wire:click="edit({{ $service->id }})">
                                                    <i class="ri-pencil-fill align-bottom me-1"></i> Modifier
                                                </button>
                                                <button class="btn btn-sm btn-danger" wire:click="delete_service({{ $service->id }})">
                                                    <i class="ri-delete-bin-fill align-bottom me-1"></i> Supprimer
                                                </button>
                                            </td>
                                        </tr><!-- end tr -->
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">
                                                <div class="noresult" >
                                                    <div class="text-center">
                                                        <img src="{{asset('resultnotfound.gif')}}" alt="not found">
                                                        <h5 class="mt-2">Désolé, aucun résultat trouvé</h5>
                                                        <p class="text-muted">Aucune donnée n'a été trouvé</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

        </div>
    </div>


    {{-- Modal --}}


    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_service" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Enregistrer un besoin</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='store'>

                    <div class="modal-body text-center p-4">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Titre du service <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='libelle'  placeholder="Entrer le nom du service" id="firstNameinput">
                                        @error('libelle')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Catégorie de service <span class="text-danger">*</span> </label>
                                        <select @if(!$list_categorie || $list_categorie->count() == 0 ) disanbled @endif  class="form-select mb-3" wire:model='category_id'>
                                            <option  selected>selectionner une catégorie...</option>
                                                @foreach($list_categorie as $item)
                                                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                                @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div><!--end col-->

                                {{-- <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Frais de service <span class="text-muted">( FACULTATIF)</span></label>
                                        <input type="number" class="form-control" wire:model='price' placeholder="Veuillez renseigner le montant ">
                                        @error('price')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div><!--end col--> --}}



                                {{-- <div class="col-12" wire:ignore>
                                    <div class="mb-3" >
                                        <label for="compnayNameinput" class="form-label">Description</label>
                                        <textarea class="form-control" id="description"  wire:model.lazy='description' name="description" rows="5"></textarea>
                                        @error('description')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col--> --}}



                            </div><!--end row-->
                    </div>
                    <div class="modal-footer" >
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Valider</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_frais_service" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Frais de service</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='SubmitFraisService'>

                    <div class="modal-body text-center p-4">
                            <div class="row">

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Montnant <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" wire:model='montant_frais' placeholder="( XOF )" >
                                        @error('montant_frais')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div><!--end col-->


                                <div class="col-12">
                                    <div class="mb-3" >
                                        <label for="compnayNameinput" class="form-label">Description <span class="text-muted">( Facultatif )</span></label>
                                        <textarea class="form-control"   wire:model='description_frais' rows="5"></textarea>
                                        @error('description_frais')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->


                            </div><!--end row-->
                    </div>
                    <div class="modal-footer" >
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-info">Valider</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="edit_service" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Modifier un besoin : {{ $libelle }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='update_service'>

                    <div class="modal-body text-center p-4">
                            <div class="row">

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Titre du service <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='libelle'  placeholder="Entrer le nom du service" id="firstNameinput">
                                        @error('libelle')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->



                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Catégorie de service <span class="text-danger">*</span> </label>
                                        <select @if(!$list_categorie || $list_categorie->count() == 0 ) disanbled @endif  class="form-select mb-3" wire:model='category_id'>
                                            <option  selected>selectionner une catégorie...</option>
                                                @foreach($list_categorie as $item)
                                                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                                @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div><!--end col-->


                                {{-- <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Frais de service <span class="text-muted">( FACULTATIF)</span></label>
                                        <input type="number" class="form-control" wire:model='price' placeholder="Veuillez renseigner le montant ">
                                        @error('price')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div><!--end col--> --}}


                                {{-- <div class="col-12" wire:ignore>
                                    <div class="mb-3" >
                                        <label for="compnayNameinput" class="form-label">Description</label>
                                        <textarea class="form-control" id="description2"  wire:model.lazy='description' name="description" rows="5"></textarea>
                                        @error('description')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col--> --}}


                            </div><!--end row-->
                    </div>
                    <div class="modal-footer" >
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="select_filter" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 bg-soft-secondary">
                    <h4 class="card-title mb-0 text-black">Filtrer selon une selection </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='FilterAutreOption'>

                    <div class="modal-body text-center p-4">
                            <div class="row">

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Date de début <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control"  max="{{ Illuminate\Support\Carbon::now()->format('Y-m-d') }}" wire:model='start_date'  placeholder="Selectionner la date de debut" >
                                        @error('start_date')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Date de fin <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" wire:model='end_date'  placeholder="Selectionner la date de fin" id="firstNameinput">
                                        @error('end_date')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->



                            </div><!--end row-->
                    </div>
                    <div class="modal-footer" >
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler </button>
                            <button type="submit" class="btn btn-secondary" id="add-btn">Valider la recherche</button>
                        </div>
                    </div>
                </form>
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
</script>
@endpush
