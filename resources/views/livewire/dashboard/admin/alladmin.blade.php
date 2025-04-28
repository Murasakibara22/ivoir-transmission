<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">NOS ADMINISTRATEURS</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">administrateurs</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row g-4 mb-3">
                <div class="col-sm-auto">
                    <div>
                        <a href="javascript:void(0)" wire:click='addAdmin' class="btn btn-primary"><i class="ri-add-circle-line align-bottom me-1"></i> Ajouter</a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Liste des addministrateurs</h4>
                            <div class="flex-shrink-0">
                                <div class="col-sm">
                                    <div class="d-flex justify-content-sm-end gap-2">
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control" wire:model.live='search' placeholder="Recherche...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-nowrap align-middle mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col" style="width: 20%;">Nom & Prenoms</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">email</th>
                                            <th scope="col">gender</th>
                                            <th scope="col">Ajouter le</th>
                                            <th scope="col" style="width: 20%;">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($list_users && $list_users->count() > 0)
                                        @foreach($list_users as $admin)
                                        <tr>
                                            <td class="d-flex">
                                                <img @if($admin->photo_url) src="{{ $admin->photo_url }}" @else src="https://api.dicebear.com/7.x/initials/svg?seed={{ $admin->username }}" @endif alt="" class="avatar-xs rounded-circle me-2">
                                                <h5 class="fs-13 mb-0">{{ $admin->username }}</h5>
                                            </td>
                                            <td>
                                                {{ $admin->phone ?? 'Non renseigné' }}
                                            </td>
                                            <td>
                                                {{ $admin->email }}
                                            </td>
                                            <td>
                                                {{ $admin->gender == 'M'  ? 'Masculin' : 'Feminin' }}
                                            </td>

                                            <td>
                                                {{ date('d-m-Y', strtotime($admin->created_at)) }}
                                            </td>
                                            <td>
                                                {{-- <button class="btn btn-sm btn-primary" wire:click='showActivityAddmin({{ $admin->id }})'>
                                                    <i class="ri-eye-fill align-bottom me-1"></i> Activiter
                                                </button> --}}
                                                @if($admin->id != Auth::user()->id)
                                                <button class="btn btn-sm btn-warning" wire:click='editAdmin({{ $admin->id }})' >
                                                    <i class="ri-pencil-fill align-bottom me-1"></i> Modifier
                                                </button>
                                                @endif
                                                @if($admin->id != Auth::user()->id)
                                                    @if(!$admin->deleted_at)
                                                        <button  class="btn btn-sm btn-danger" wire:click='deleteAdmin({{ $admin->id }})'>
                                                            <i class="ri-delete-bin-fill align-bottom me-1"></i> Supprimer
                                                        </button>
                                                    @else
                                                        <button  class="btn btn-sm btn-secondary" wire:click='restoreAdmin({{ $admin->id }})'>
                                                            <i class="ri-refresh-line align-bottom me-1"></i> restaurer
                                                        </button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr><!-- end tr -->
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">
                                                <div class="text-center ">
                                                    <h6 class="text-danger">Aucun administrateur enrgistrer</h6>
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

    <!-- Moddal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" id="add_admin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">

                <div class="modal-body">
                    <form autocomplete="off" wire:submit.prevent="store">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="px-1 pt-1">
                                    <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                                        <img src="{{ asset('assets/images/small/img-9.jpg')}}" alt="" id="cover-img" class="img-fluid">

                                        <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                                            <div class="flex-grow-1">
                                                <h5 class="modal-title text-white" id="createMemberLabel">Ajouter un administrateur</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="d-flex gap-3 align-items-center">

                                                    <button type="button" class="btn-close btn-close-white"  id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mb-4 mt-n5 pt-2">
                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute bottom-0 end-0">
                                            <label for="member-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Member Image">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                        <i class="ri-image-fill"></i>
                                                    </div>
                                                </div>
                                            </label>
                                            <input class="form-control d-none" wire:model='AsImage' id="member-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded-circle">
                                                <img @if($AsImage) src="{{ $AsImage->temporaryUrl() }}"  @else src="{{ asset('assets/images/users/user-dummy-img.jpg')}}" @endif id="member-img" class="avatar-md rounded-circle" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Nom  <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" wire:model='nom'  placeholder="Enter name"  required>
                                    @error('nom')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Prenoms  <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" wire:model='prenom'  placeholder="Enter name"  required>
                                    @error('prenom')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="teammembersName" class="form-label">Dial Code</label>
                                            <select   class="form-select mb-3" wire:model='dial_code'>
                                                <option value="">Selection....</option>

                                                        <option value="+225">
                                                            +225
                                                        </option>

                                            </select>
                                            @error('dial_code')
                                            <div class="feedback-text">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-9">
                                            <label for="teammembersName" class="form-label">Téléphone  <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon11"><i class="ri-phone-line"></i></span>
                                                <input type="number"  minLength="10" class="form-control" wire:model='phone_number'  placeholder="Enter phone number"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Email  <span class="text-danger">*</span> </label>
                                    <input type="email" class="form-control" wire:model='email'  placeholder="Enter email"  required>
                                    @error('email')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Genre <span class="text-danger">*</span> </label>
                                    <select class="form-select mb-3" wire:model='gender'>
                                        <option value="M">Masculin</option>
                                        <option value="F">Feminin</option>
                                    </select>
                                    @error('gender')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Role <span class="text-danger">*</span> </label>
                                    <select @if(!$lsit_role) disabled @endif class="form-select mb-3" wire:model='role_id'>
                                        <option selected>Select</option>
                                        @if($lsit_role->count() > 0)
                                            @foreach($lsit_role as $role)
                                                <option value="{{$role->id}}">{{$role->libelle}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('role_id')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Password -->
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <label for="passwordInput" class="form-label">Mot de passe (Générer)</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" id="passwordInput" class="form-control" wire:model='password' placeholder="Enter password" required>
                                            </div>
                                            @error('password')
                                            <div class="feedback-text">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-primary mt-4" wire:click='generatePasswordAleatoire'> <i class="mdi mdi-auto-fix"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="addNewMember">Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end modal-->

    <div wire:ignore.self class="modal fade" tabindex="-1" id="edit_admin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">

                <div class="modal-body">
                    <form autocomplete="off" wire:submit.prevent="updateAdmin">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="px-1 pt-1">
                                    <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                                        <img src="{{ asset('assets/images/small/img-9.jpg')}}" alt="" id="cover-img" class="img-fluid">

                                        <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                                            <div class="flex-grow-1">
                                                <h5 class="modal-title text-white" id="createMemberLabel">Modifier l'administrateur {{$nom}}</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="d-flex gap-3 align-items-center">

                                                    <button type="button" class="btn-close btn-close-white"  id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mb-4 mt-n5 pt-2">
                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute bottom-0 end-0">
                                            <label for="member-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Member Image">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                        <i class="ri-image-fill"></i>
                                                    </div>
                                                </div>
                                            </label>
                                            <input class="form-control d-none" wire:model='AsImage' id="member-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded-circle">
                                                <img @if($AsImage) src="{{ $AsImage->temporaryUrl() }}" @elseif(!is_null(App\Models\User::find($id_admin)) && App\Models\User::find($id_admin)->photo_url != null) src="{{ App\Models\User::find($id_admin)->photo_url}}" @else src="{{ asset('assets/images/users/user-dummy-img.jpg')}}" @endif id="member-img" class="avatar-md rounded-circle" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Nom  <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" wire:model='nom'  placeholder="Enter name"  required>
                                    @error('nom')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Prenoms  <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" wire:model='prenom'  placeholder="Enter name"  required>
                                    @error('prenom')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="teammembersName" class="form-label">Dial Code</label>
                                            <select   class="form-select mb-3" wire:model='dial_code'>
                                                <option value="">Select</option>

                                                        <option value="+225">
                                                            +225
                                                        </option>

                                            </select>
                                            @error('dial_code')
                                            <div class="feedback-text">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-9">
                                            <label for="teammembersName" class="form-label">Téléphone  <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon11"><i class="ri-phone-line"></i></span>
                                                <input type="number"  minLength="10" class="form-control" wire:model='phone_number'  placeholder="Enter phone number"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Email  <span class="text-danger">*</span> </label>
                                    <input type="email" class="form-control" wire:model='email'  placeholder="Enter email"  required>
                                    @error('email')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="teammembersName" class="form-label">Genre <span class="text-danger">*</span> </label>
                                    <select class="form-select mb-3" wire:model='gender'>
                                        <option selected>Select</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Feminin</option>
                                    </select>
                                    @error('gender')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Role <span class="text-danger">*</span> </label>
                                    <select @if(!$lsit_role) disabled @endif class="form-select mb-3" wire:model='role_id'>
                                        <option selected>Select</option>
                                        @if($lsit_role->count() > 0)
                                            @foreach($lsit_role as $role)
                                                <option value="{{$role->id}}">{{$role->libelle}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('role_id')
                                    <div class="feedback-text">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning" id="addNewMember">Modifier</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end modal-->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="delete_admin" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent='destroyUser'>

                    <div class="modal-body text-center p-4">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-12 col-xl-12">



                                        <div class="text-center mt-2">
                                            <h5 class="text-primary">Validation Requise</h5>
                                            <p class="text-muted">Confirmer votre mot de passe pour pouvoir continuer !!!</p>
                                        </div>
                                        <div class="user-thumb text-center">
                                            <img @if(!is_null(App\Models\User::find($id_admin)) && App\Models\User::find($id_admin)->photo_url) src="{{ App\Models\User::find($id_admin)->photo_url}}" @else src="https://api.dicebear.com/7.x/initials/svg?seed={{ $username_admin }}" @endif class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                                            <h5 class="font-size-15 mt-3">{{ $username_admin }}</h5>
                                        </div>
                                        <div class="p-2 mt-4">
                                            <form>
                                                <div class="mb-3">
                                                    <label class="form-label" for="userpassword">Password</label>
                                                    <input type="password" class="form-control" id="userpassword" wire:model='passord_confirm' placeholder="Enter password" required>
                                                </div>
                                                <div class="mb-2 mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Continuer</button>
                                                </div>
                                            </form><!-- end form -->

                                        </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="show_activity_admin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
            <div class="modal-content">

                    <div class="modal-body text-center p-4">
                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div>
                                <h5 class="mb-4">Historique des activités</h5>
                                <div class="timeline-2">
                                    @if($list_activity_admin && $list_activity_admin->count() > 0)
                                    @foreach($list_activity_admin as $key => $value)
                                    <div class="timeline-continue">
                                        <div class="row timeline-right">
                                            <div class="col-12">
                                                <p class="timeline-date">
                                                    {{ date('d, m Y H:i', strtotime($value->created_at)) }}
                                                </p>
                                            </div>
                                            <div class="col-12">
                                                <div class="timeline-box">
                                                    <div class="timeline-text">
                                                        <div class="d-flex">
                                                            <img src="https://api.dicebear.com/7.x/initials/svg?seed={{ $name_admin }}" alt="" class="avatar-sm rounded" />
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="mb-1">{{ $value->libelle_mouvement }}</h5>
                                                                <p class="text-muted mb-0">device : {{ $value->device }} , Pays : {{ $value->country_name }} ,  ville : {{ $value->city_name }} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="timeline-continue">
                                        <div class="row timeline-right">
                                            <div class="col-12">
                                                <p class="timeline-date">
                                                    Aucune activité !
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                    </div>

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

