<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">UTILISATEURS</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">Utilisateurs</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                            <div class="col-md-4 col-6">
                                        <a href="javascript:void" wire:click="FilterByBloc('all')" class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Total Client</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span >{{ $all_stats_client }}</span></h2>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                                <i class="ri-star-fill text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </a> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-md-4 col-6">
                                        <a href="javascript:void" wire:click="FilterByBloc('Hommes')" class="card card-animate bg-primary">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-white-50 mb-0">Hommes</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold text-white"><span >{{ $stats_client_masculin }}</span></h2>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                <i class="ri-user-fill text-white"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </a> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-md-4 col-6">
                                        <a href="javascript:void" wire:click="FilterByBloc('Femmes')" class="card card-animate bg-danger">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-white mb-0">Femmes</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold text-white"> <span>{{ $stats_client_feminin }}</span></h2>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                <i class="ri-user-2-fill text-white"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </a> <!-- end card-->
                            </div> <!-- end col-->
{{--
                            <div class="col-md-3 col-6">
                                        <a href="javascript:void" wire:click="FilterByBloc('Deleted')" class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Clients supprimer</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold text-black"><span >{{ $stats_client_delete }}</span></h2>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-danger rounded-circle fs-2">
                                                                <i class="ri-delete-bin-2-fill text-black"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </a> <!-- end card-->
                            </div> <!-- end col--> --}}

            </div>



                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="leadsList">
                                <div class="card-header border-0">

                                    <div class="row g-4 align-items-center">
                                        <div class="col-sm-3">
                                            <div class="search-box">
                                                <input type="text" class="form-control search" wire:model.live="search" placeholder="Rechercher des clients...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto ms-auto">
                                            <div class="hstack gap-2">
                                                <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                                <button type="button" class="btn btn-info" wire:click="showFilter" href="javascript:void(0)"><i class="ri-filter-3-line align-bottom me-1"></i> Filtrer</button>
                                                <!-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Leads</button> -->
                                                <button type="button" class="btn btn-primary" wire:click='ExportExcelList'><i class="ri-file-download-line align-bottom me-1"></i> Exporter</button>
                                                <button type="button" class="btn btn-warning" wire:click='exportPdfList'><i class="ri-file-pdf-line align-bottom me-1"></i> Exporter Pdf</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive table-card">
                                            <table class="table align-middle" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" >Noms et prenoms</th>
                                                        <th class="sort" >Contact</th>
                                                        <th class="sort" >Email</th>
                                                        <th class="sort" >Genre</th>
                                                        {{-- <th class="sort" >Adresse</th> --}}
                                                        <th class="sort">Insccrit il y a </th>
                                                        <th class="sort" >Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @if($list_client && $list_client->count() > 0)

                                                        @foreach ($list_client as $item)
                                                        <tr>
                                                            <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0">
                                                                        <img @if($item->photo_url) src="{{ $item->photo_url }}" @else src="https://api.dicebear.com/7.x/initials/svg?seed={{ $item->name }}" @endif alt="" class="avatar-xxs rounded-circle image_src object-cover">
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-2 name">{{ $item->username }}</div>
                                                                </div>
                                                            </td>
                                                            @if($item->phone)
                                                            <td class="company_name">{{ $item->phone }}</td>
                                                            @else
                                                            <td class="company_name text-danger">Pas de contact</td>
                                                            @endif
                                                            @if($item->email)
                                                            <td class="leads_score">{{ $item->email}}</td>
                                                            @else
                                                            <td class="leads_score text-danger">Aucun</td>
                                                            @endif
                                                            <td class="phone">{{ $item->gender ? $item->gender : 'A' }}</td>
                                                            {{-- @if($item->addresses)
                                                            <td class="location">{{  $item->addresses->address_name }}</td>
                                                            @else
                                                            <td class="location text-danger">Aucune</td>
                                                            @endif
                                                             --}}
                                                            <td class="date">{{ $item->created_at->diffForHumans() }}</td>
                                                            <td>
                                                                <ul class="list-inline hstack gap-2 mb-0">
                                                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Call">
                                                                        <a href="tel:{{ $item->phone }}" class="text-success d-inline-block">
                                                                            <i class="ri-phone-line fs-16 "></i>
                                                                        </a>
                                                                    </li>
                                                                    {{-- @if( checkifRight(auth()->user()->role_id, App\Models\Menu::where('libelle','UTILISATEURS')->first()->id,'READ ONE') || App\Models\Role::where('id',auth()->user()->role_id)->first()->libelle == "SuperAdmin"  )
                                                                    <li class="list-inline-item ">
                                                                        <a href="{{ route('dashboard.users.show', $item->id)}}"><i class="ri-eye-fill align-bottom text-primary"></i></a>
                                                                    </li>
                                                                    @endif --}}

                                                                    @if( checkifRight(auth()->user()->role_id, App\Models\Menu::where('libelle','UTILISATEURS')->first()->id,'UPDATE') || App\Models\Role::where('id',auth()->user()->role_id)->first()->libelle == "SuperAdmin"  )
                                                                    <li class="list-inline-item"  title="Edit">
                                                                        <a class="edit-item-btn" href="javascript:void(0);" wire:click="editClient({{ $item->id }})"><i class="ri-pencil-fill align-bottom text-warning"></i></a>
                                                                    </li>
                                                                    @endif
                                                                    @if( checkifRight(auth()->user()->role_id, App\Models\Menu::where('libelle','UTILISATEURS')->first()->id,'DELETE') || App\Models\Role::where('id',auth()->user()->role_id)->first()->libelle == "SuperAdmin"  )
                                                                        @if($item->deleted_at == null)
                                                                        <li class="list-inline-item"  title="Delete">
                                                                            <a class="remove-item-btn" href="javascript:void(0);" wire:click="deleteClient({{ $item->id }})">
                                                                                <i class="ri-delete-bin-fill align-bottom text-danger"></i>
                                                                            </a>
                                                                        </li>
                                                                        @endif
                                                                    @endif
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        @endforeach


                                                    @else

                                                        @if($list_all_client && $list_all_client->count() > 0)
                                                            @foreach ($list_all_client as $item)
                                                            <tr>
                                                                <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0">
                                                                            <img @if($item->photo_url) src="{{ $item->photo_url }}" @else src="https://api.dicebear.com/7.x/initials/svg?seed={{ $item->username }}" @endif alt="" class="avatar-xxs rounded-circle image_src object-cover">
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-2 name">{{ $item->username }}</div>
                                                                    </div>
                                                                </td>
                                                                @if($item->phone)
                                                                <td class="company_name">{{ $item->phone }}</td>
                                                                @else
                                                                <td class="company_name text-danger">Pas de contact</td>
                                                                @endif
                                                                @if($item->email)
                                                                <td class="leads_score">{{ $item->email}}</td>
                                                                @else
                                                                <td class="leads_score text-danger">Aucun</td>
                                                                @endif
                                                                <td class="phone">{{ $item->gender ? $item->gender : 'A' }}</td>
                                                                {{-- @if($item->addresses)
                                                                <td class="location">{{  $item->addresses->address_name }}</td>
                                                                @else
                                                                <td class="location text-danger">Aucune</td>
                                                                @endif --}}
                                                                <td class="date">{{ $item->created_at->diffForHumans() }}</td>
                                                                <td>
                                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Call">
                                                                            <a href="tel:{{ $item->phone }}" class="text-success d-inline-block">
                                                                                <i class="ri-phone-line fs-16 "></i>
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-inline-item edit" >
                                                                            <a href="{{ route('dashboard.users.show', $item->slug) }}" class="text-primary d-inline-block">
                                                                                <i class="ri-eye-fill fs-16 "></i>
                                                                            </a>
                                                                        </li>

                                                                        @if( checkifRight(auth()->user()->role_id, App\Models\Menu::where('libelle','UTILISATEURS')->first()->id,'UPDATE') || App\Models\Role::where('id',auth()->user()->role_id)->first()->libelle == "SuperAdmin"  )
                                                                        <li class="list-inline-item"  title="Edit">
                                                                            <a class="edit-item-btn" href="javascript:void(0);" wire:click="editClient({{ $item->id }})"><i class="ri-pencil-fill align-bottom text-warning"></i></a>
                                                                        </li>
                                                                        @endif
                                                                        @if( checkifRight(auth()->user()->role_id, App\Models\Menu::where('libelle','UTILISATEURS')->first()->id,'DELETE') || App\Models\Role::where('id',auth()->user()->role_id)->first()->libelle == "SuperAdmin"  )
                                                                            @if($item->deleted_at == null)
                                                                            <li class="list-inline-item"  title="Delete">
                                                                                <a class="remove-item-btn" href="javascript:void(0);" wire:click="deleteClient({{ $item->id }})">
                                                                                    <i class="ri-delete-bin-fill align-bottom text-danger"></i>
                                                                                </a>
                                                                            </li>
                                                                            @endif
                                                                        @endif
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                <td colspan="8">
                                                                    <div class="noresult" style="display: block">
                                                                        <div class="text-center">
                                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                                                            <h5 class="mt-2">Désolé! Aucun resultat trouvé</h5>
                                                                            <p class="text-muted mb-0">Nous n'avons trouver aucun client pour cette recherche</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                </tbody>
                                            </table>

                                        </div>
                                        @if(!$list_client )
                                        <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2 pagination pagination-rounded">
                                                {{ $list_all_client->links() }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>


                                    <!-- Modal Delete Reservation -->
                                    <!-- <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                </div>
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="fs-semibold">You are about to delete a lead ?</h4>
                                                        <p class="text-muted fs-14 mb-4 pt-1">Deleting your lead will remove all of your information from our database.</p>
                                                        <div class="hstack gap-2 justify-content-center remove">

                                                            <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                            <button class="btn btn-danger" id="delete-record">Yes, Delete It!!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!--end modal -->


                                </div>
                            </div>

                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

        </div>
    </div>

    <!-- Modal edit and delete -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="edit_client" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 bg-soft-warning">
                    <h4 class="card-title mb-0">Modifier les informations de <strong> {{ $prenom }} </strong> </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='updateClient'>

                    <div class="modal-body text-center p-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='nom'  placeholder="Entrer le nom" id="firstNameinput">
                                        @error('nom')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Prenoms <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='prenom'  placeholder="Entrer le / les prrenoms" id="firstNameinput">
                                        @error('prenom')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-2">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Dial code <span class="text-danger">*</span></label>
                                        <select class="form-select mb-3" wire:model='dial_code'>
                                            <option selected value="+225">
                                                +225
                                             </option>
                                        </select>
                                        @error('dial_code')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Contacct <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" wire:model='phone_number' placeholder="Veuillez renseigner  le numéro de telephone" >
                                        @error('phone_number')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div><!--end col-->

                                <div class="col-4">
                                    <div class="mb-3">
                                            <label class="form-label text-start">Genre <span class="text-danger">*</span></label>
                                            <select  class="form-select mb-3" wire:model='gender'>
                                                        <option value="M">Masculin </option>
                                                        <option value="F">Feminin </option>
                                                        <option value="A">Autre </option>
                                            </select>
                                            @error('gender')
                                                <span class="feedback-text">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                </div><!--end col-->

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" wire:model='email' placeholder="Veuillez renseigner l'adrresse email....." >
                                        @error('email')
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
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="confirm_delete_client" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent='confirmDeleteClient'>

                    <div class="modal-body text-center p-4">
                            <div class="row text-black">
                                <h6>Etes-vous sur ?</h6>
                                <div class="col-12 mb-3">
                                    Si oui, saisissez le nom du Client suivant : <strong class="bg-soft-warning p-1 rounded text-dark"> {{$nom}} </strong> ci-dessous
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-7">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" wire:model.live='verify_nom'  placeholder="Entrer le nom" id="firstNameinput">
                                        @error('verify_nom')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-5">
                                    <div class="mb-3">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button @if(!$activate_delete_client) disabled @endif type="submit" class="btn btn-danger" id="add-btn">Supprimer</button>
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                        </div>
                                    </div>
                                </div><!--end col-->

                            </div><!--end row-->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="filter_client" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <form wire:submit.prevent='validateFilter'>
                    <div class="modal-body text-center p-4">
                            <div class="row">

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Genre <span class="text-muted">(Optionnel)</span> </label>
                                        <select  class="form-select mb-3" wire:model='filter_genre'>
                                            <option value="">selectionner...</option>
                                            <option value="Hommes">Hommes</option>
                                            <option value="Femmes">Femmes</option>
                                            <option value="Trans">Trans</option>
                                        </select>
                                        @error('filter_genre')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Sexe <span class="text-muted">(Optionnel)</span> </label>
                                        <select  class="form-select mb-3" wire:model='filter_sexe'>
                                            <option value="">selectionner...</option>
                                            <option value="Masculin">Masculin</option>
                                            <option value="Feminin">Feminin</option>
                                        </select>
                                        @error('filter_sexe')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">Date de début <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control"  wire:model='filter_start_date' placeholder="selectionner la date de debut" >
                                        @error('filter_start_date')
                                        <span class="feedback-text">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div><!--end col-->

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label text-start">date de fin <span class="text-danger">*</span> </label>
                                        <input type="date" class="form-control" wire:model='filter_end_date' placeholder="Enter" >
                                        @error('filter_end_date')
                                            <span class="feedback-text">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->

                                <div class="col-6 mx-auto">
                                     <button type="submit" class="btn btn-success" id="add-btn">Valider la sélection</button>
                                </div>

                            </div><!--end row-->
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
        color: #ec593c;
    }
</style>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
@endpush

