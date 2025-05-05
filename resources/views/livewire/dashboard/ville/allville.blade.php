<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">VILLES / COMMUNES</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">Villes / communes</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->




            <div class="row mb-4">
                <div class="col-sm-auto" >
                    <div>

                        <a href="javascript: void(0);"  wire:click='addVille' class="btn btn-primary btn-sm" ><i class="ri-add-circle align-bottom me-1"></i>Ajouter une ville</a>
                        <a href="javascript: void(0);"  wire:click='addCommune' class="btn btn-info btn-sm" ><i class="ri-add-line align-bottom me-1"></i>Ajouter une commune</a>

                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-xl-5">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Liste des villes</h4>
                            <div class="flex-shrink-0">
                                {{-- search --}}
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control" wire:model.live='search' placeholder="Recherche...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">N'</th>
                                            <th scope="col">Nom de la ville</th>
                                            <th scope="col">Date d'ajout</th>
                                            <th scope="col" style="width: 150px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($list_ville && $list_ville->count() > 0)
                                        @foreach ($list_ville as $key => $ville)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $ville->nom }}</h6>
                                            </td>
                                            <td>
                                                {{ date('d/m/Y', strtotime($ville->created_at)) }}
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="#!" wire:click="editVille({{ $ville->id }})" class="btn btn-sm btn-info"><i class="ri-pencil-fill align-bottom"></i> Modifier</a>
                                                    <a href="#!" wire:click="deleteVille({{ $ville->id }})" class="btn btn-sm btn-danger"><i class="ri-delete-bin-fill align-bottom"></i> Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="align-items-center mt-4 pt-2 justify-content-between d-flex">
                                <div class="flex-shrink-0">
                                    <div class="text-muted">
                                        Afficher <span class="fw-semibold">10</span> of <span class="fw-semibold"></span> Resultats
                                    </div>
                                </div>
                                <ul class="pagination pagination-separated pagination-sm mb-0">

                                </ul>
                            </div>

                        </div>
                    </div> <!-- .card-->
                </div><!--end col-->
                <div class="col-xl-7">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Liste des communes</h4>
                            <div class="flex-shrink-0">
                                {{-- search --}}
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control" wire:model.live='search' placeholder="Recherche...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">N'</th>
                                            <th scope="col">Nom de la commune</th>
                                            <th scope="col">Ville</th>
                                            <th scope="col">Jours Disponible </th>
                                            <th scope="col" style="width: 150px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($list_commune && $list_commune->count() > 0)
                                        @foreach ($list_commune as $key => $commune)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $commune->nom }}</h6>
                                            </td>

                                            <td>
                                                {{ $commune->Ville->nom }}
                                            </td>

                                            <td>
                                                @if ($commune->jours)
                                                    {{ implode(', ', array_map(fn($jour) => ucfirst($jour), json_decode($commune->jours))) }}
                                                @else
                                                    <span class="text-muted">Aucun jour défini</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="#!" wire:click="editCommune({{ $commune->id }})" class="btn btn-sm btn-info"><i class="ri-pencil-fill align-bottom"></i> Modifier</a>
                                                    <a href="#!" wire:click="deleteCommune({{ $commune->id }})" class="btn btn-sm btn-danger"><i class="ri-delete-bin-fill align-bottom"></i> Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="align-items-center mt-4 pt-2 justify-content-between d-flex">
                                <div class="flex-shrink-0">
                                    <div class="text-muted">
                                        Afficher <span class="fw-semibold">10</span> of <span class="fw-semibold"></span> Resultats
                                    </div>
                                </div>
                                <ul class="pagination pagination-separated pagination-sm mb-0">

                                </ul>
                            </div>

                        </div>
                    </div> <!-- .card-->
                </div><!--end col-->

            </div><!--end row-->

        </div>
    </div>




    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_ville" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Ajouter une ville </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='submitVille'>

                    <div class="modal-body text-center p-4">
                            <div class="row">

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Nom  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='nom_ville' min="1" placeholder="Entrer le nom de la ville" id="firstNameinput">
                                        @error('nom_ville')
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
                            <button type="submit" class="btn btn-success" id="add-btn">Valider</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="edit_ville" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light-secondary">
                    <h4 class="card-title mb-0">modifier une ville </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='updateVille'>

                    <div class="modal-body text-center p-4">
                            <div class="row">

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='nom_ville' min="1" placeholder="Entrer le nom de la ville" id="firstNameinput">
                                        @error('nom_ville')
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
                            <button type="submit" class="btn btn-warning" id="add-btn">Modifier</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_commune" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Ajouter une commune </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='submitCommune'>

                    <div class="modal-body text-center p-4">
                            <div class="row">

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Nom de la commune <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='nom_commune' min="1" placeholder="Entrer le nom de la ville" id="firstNameinput">
                                        @error('nom_commune')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->


                                <div class="col-12">

                                    <div class="mb-3">
                                        <label class="form-label text-start">Ville <span class="text-danger">*</span> </label>
                                        <select @if(!$list_ville || $list_ville->count() == 0 ) disabled @endif class="form-select mb-3" wire:model.live='ville_id'>
                                            <option selected>selectionner un ville...</option>
                                            @foreach($list_ville as $item)
                                                <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('ville_id')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                </div><!--end col-->


                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start mb-3">Jours disponible <span class="text-muted">( FACULTATIF )</span> </label>
                                        @if(!empty($joursDisponibles))
                                            <div class="grid grid-cols-2 gap-2">
                                                @foreach($joursDisponibles as $key => $jour)
                                                    <label class="flex items-center space-x-2 me-3">
                                                        <input type="checkbox" id="formCheck{{ $key }}" wire:model="JoursChoice" value="{{ $jour }}">
                                                        <span>{{ ucfirst($jour) }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-red-500">Aucun jour disponible pour cette ville.</p>
                                        @endif
                                        @error('joursChoice')
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
                            <button type="submit" class="btn btn-success" id="add-btn">Valider</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="edit_commune" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 bg-warning">
                    <h4 class="card-title mb-0">modifier la commune </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='updateCommune'>

                    <div class="modal-body text-center p-4">
                            <div class="row">

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='nom_commune' min="1" placeholder="Entrer le nom de la ville" id="firstNameinput">
                                        @error('nom_commune')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->


                                <div class="col-12">

                                    <div class="mb-3">
                                        <label class="form-label text-start">Ville <span class="text-danger">*</span> </label>
                                        <select @if(!$list_ville || $list_ville->count() == 0 ) disabled @endif class="form-select mb-3" wire:model='ville_id'>
                                            <option selected>selectionner un ville...</option>
                                            @foreach($list_ville as $item)
                                                <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('ville_id')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                </div><!--end col-->



                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start mb-3">Jours disponible <span class="text-muted">( FACULTATIF )</span> </label>
                                        @if(!empty($joursDisponibles))
                                            <div class="grid grid-cols-2 gap-2">
                                                @foreach($joursDisponibles as $key => $jour)
                                                    <label class="flex items-center space-x-2 me-3">
                                                        <input type="checkbox" id="formCheck{{ $key }}" wire:model.live="JoursChoice" value="{{ $jour }}">
                                                        <span>{{ ucfirst($jour) }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-red-500">Aucun jour disponible pour cette ville.</p>
                                        @endif
                                        @error('joursChoice')
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
                            <button type="submit" class="btn btn-warning" id="add-btn">Modifier</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



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
