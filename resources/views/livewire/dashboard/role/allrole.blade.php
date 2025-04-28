<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Roles</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Roles</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row g-4 mb-3">
                <div class="col-sm-auto">
                    <div>
                        <a href="javascript:void(0)" wire:click="createRole" class="btn btn-primary"><i class="ri-add-circle-line align-bottom me-1"></i>Ajouter un role</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Liste des rôles</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <p class="text-muted mb-4">Liste exhaustive <code> des rôles</code> existant</p>

                            <div class="live-preview">
                                <div class="table-responsive table-card">
                                    <table class="table align-middle table-nowrap table-striped-columns mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Libelle</th>
                                                <th scope="col">Menu assoccier</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Admins</th>
                                                <th scope="col">Date</th>
                                                <th scope="col" style="width: 150px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($list_roles && $list_roles->count() > 0)
                                            @foreach ($list_roles as $key => $role)
                                            <tr>
                                                <td><a href="#" class="fw-medium">#{{ $key + 1}}</a></td>
                                                <td>{{ $role->libelle }}</td>
                                                <td>
                                                    @if($role->libelle == "SuperAdmin")
                                                        <span class="badge bg-success fs-14">Accès illimité</span>
                                                    @else
                                                    <select @if(!$role->rolemenus()->exists()) disabled @endif class="form-select" aria-label="Default select example">
                                                        <option selected>Afficher les menus...</option>
                                                        @foreach ($role->rolemenus as $item)
                                                            <option value="#">{{ $item->menu->libelle}}</option>
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                </td>
                                                <td>{{ Illuminate\Support\Str::words($role->description,2)}}</td>
                                                <td>
                                                    <button wire:click="showAdmin({{ $role->id }})" type="button" class="btn btn-sm btn-light">Details <i class="ri-eye-fill align-bottom ms-2"></i></button>
                                                </td>
                                                <td @if($role->libelle == "SuperAdmin") colspan="2" @endif>{{ date('d M Y', strtotime($role->created_at))}}</td>

                                                <td>
                                                    @if($role->libelle != "SuperAdmin")
                                                        @if( checkifRight(auth()->user()->role_id, App\Models\Menu::where('libelle','Roles')->first()->id,'READ ONE') || App\Models\Role::where('id',auth()->user()->role_id)->first()->libelle == "SuperAdmin"  )
                                                            <a href="{{ route('dashboard.roles.show',$role->slug)}}"  class="btn btn-sm btn-soft-primary">
                                                                <i class="ri-check-double-fill align-bottom me-1"></i> Droits
                                                            </a>
                                                        @else
                                                            <button  class="btn btn-sm btn-soft-primary" disabled>
                                                                <i class="ri-check-double-fill align-bottom me-1"></i> Droits
                                                            </button>
                                                        @endif

                                                        @if( checkifRight(auth()->user()->role_id, App\Models\Menu::where('libelle','Roles')->first()->id,'UPDATE') || App\Models\Role::where('id',auth()->user()->role_id)->first()->libelle == "SuperAdmin"  )
                                                            <button  class="btn btn-sm btn-warning" wire:click="editRole({{ $role->id }})">
                                                                <i class="ri-edit-fill align-bottom me-1"></i> modifier
                                                            </button>
                                                        @else
                                                            <button  class="btn btn-sm btn-warning" disabled>
                                                                <i class="ri-edit-fill align-bottom me-1"></i> modifier
                                                            </button>
                                                        @endif
                                                        @if( checkifRight(auth()->user()->role_id, App\Models\Menu::where('libelle','Roles')->first()->id,'DELETE') || App\Models\Role::where('id',auth()->user()->role_id)->first()->libelle == "SuperAdmin"  )
                                                            <button  class="btn btn-sm btn-danger" wire:click="deleteRole({{ $role->id }})">
                                                                <i class="ri-delete-bin-fill align-bottom me-1"></i> Supprimer
                                                            </button>
                                                        @else
                                                        <button  class="btn btn-sm btn-danger" disabled>
                                                            <i class="ri-delete-bin-fill align-bottom me-1"></i> Supprimer
                                                        </button>
                                                        @endif

                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <div class="noresult" >
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                            <h5 class="mt-2">Désolé, aucun résultat trouvé</h5>
                                                            <p class="text-muted">aucune donnée n'a été trouvé</p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="align-items-center mt-4 pt-2 justify-content-between d-flex">
                                    {{ $list_roles->links() }}
                                </div>
                            </div>

                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

        </div>
    </div>

    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" tabindex="-1" id="add_role" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Ajouter un Rôle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @if($list_menus && $list_menus->count() > 0)
                    <form wire:submit.prevent="saveRole">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="firstName" class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="firstName" wire:model="libelle" placeholder="Entrer le nom du rôle">
                                    @error('libelle') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="lastName" class="form-label">Description</label>
                                   <textarea name="description" placeholder="Description du rôle.." wire:model="description" cols="30" rows="5" class="form-control"></textarea>
                                   @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <label for="genderInput" class="form-label">Menus (sélectionner un/plusieurs menus)</label>
                                <div>
                                    @foreach($list_menus as $menu)
                                    <div class="form-check form-check-inline mb-2">
                                        <input class="form-check-input" class="form-check-input" type="checkbox" id="formCheck{{ $menu->id }}" value="{{ $menu->id }}" wire:model='select_menu'>
                                        <label class="form-check-label" for="inlineRadio1">{{ $menu->libelle }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @error('select_menu') <span class="text-danger">{{ $message }}</span> @enderror
                            </div><!--end col-->

                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">fermer</button>
                                    <button type="submit" class="btn btn-primary">valider</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                @else
                    <div class="noresult" >
                        <div class="text-center">
                            <img src="{{ asset('resultnotfound.gif') }}" alt="">
                            <h5 class="mt-2">Aucun Menu enregistrer</h5>
                            <p class="text-muted">Veuillez enregistrer un ou plusieurs menus avant d'enregistrer un rôle</p>
                        </div>
                    </div>
                 @endif
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="edit_role" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-soft-warning">
                    <h5 class="modal-title" id="exampleModalgridLabel">Modifier le Rôle : {{ $libelle }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @if($list_menus && $list_menus->count() > 0)
                    <form wire:submit.prevent="updateRole">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="firstName" class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="firstName" wire:model="libelle" placeholder="Entrer le nom du rôle">
                                    @error('libelle') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="lastName" class="form-label">Description</label>
                                   <textarea name="description" placeholder="Description du rôle.." wire:model="description" cols="30" rows="5" class="form-control"></textarea>
                                   @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <label for="genderInput" class="form-label">Menus (sélectionner un/plusieurs menus)</label>
                                <div>
                                    @foreach($list_menus as $menu)
                                    <div class="form-check form-check-inline mb-2">
                                        <input class="form-check-input" class="form-check-input" type="checkbox" id="formCheck{{ $menu->id }}" value="{{ $menu->id }}" wire:model='select_menu'>
                                        <label class="form-check-label" for="inlineRadio1">{{ $menu->libelle }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @error('select_menu') <span class="text-danger">{{ $message }}</span> @enderror
                            </div><!--end col-->

                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">fermer</button>
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                @else
                    <div class="noresult" >
                        <div class="text-center">
                            <img src="{{ asset('resultnotfound.gif') }}" alt="">
                            <h5 class="mt-2">Aucun Menu enregistrer</h5>
                            <p class="text-muted">Veuillez enregistrer un ou plusieurs menus avant d'enregistrer un rôle</p>
                        </div>
                    </div>
                 @endif
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="show_admin" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalgridLabel">Liste des Administrateurs associeés au rôle : {{ $libelle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Noms & prenoms</th>
                                <th scope="col">Email</th>
                                <th scope="col">contact</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($list_admin_role && $list_admin_role->count() > 0)
                            @foreach ($list_admin_role as $key => $item)
                                <tr>
                                    <th>#{{ $key + 1 }}</th>
                                    <td>{{ Str::words($item->name, 2) }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        {{ $item->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center text-danger">Aucun administrateur enregistré</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
