<div>
     <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">CONTACTS</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">Nos contacts</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card-body pt-0" align="left">
                        <button type="button" wire:click='addEntreprise' class="btn btn-primary btn-sm shadow"><i
                                class="fa fa-plus color-info"></i> AJOUTER UNE NOUVELLE ENTREPRISE</button>
                    </div>
                </div>
            </div>


            <!-- Section de filtres -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-6 mb-2 mb-lg-0">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="ri-search-line text-muted"></i>
                                        </span>
                                        <input type="text"
                                            class="form-control border-0 bg-light"
                                            wire:model.live="search"
                                            placeholder="Rechercher des entreprises...">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-6 mb-2 mb-lg-0">
                                    <select class="form-select border-0 bg-light" wire:model.live="filter_type">
                                        <option value="">Tous les types</option>
                                        <option value="SARL">SARL</option>
                                        <option value="SA">SA</option>
                                        <option value="SAS">SAS</option>
                                        <option value="EIRL">EIRL</option>
                                        <option value="Auto-entrepreneur">Auto-entrepreneur</option>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-6 mb-2 mb-lg-0">
                                    <select class="form-select border-0 bg-light" wire:model.live="filter_status">
                                        <option value="">Tous les statuts</option>
                                        <option value="ACTIVATED">Actif</option>
                                        <option value="INACTIVATED">Inactif</option>
                                        <option value="PENDING">En attente</option>
                                        <option value="SUSPENDED">Suspendu</option>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-6 mb-2 mb-lg-0">
                                    <input type="date"
                                        class="form-control border-0 bg-light"
                                        wire:model.live="filter_date"
                                        title="Filtrer par date d'inscription">
                                </div>

                                <div class="col-lg-3 col-md-12">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-outline-secondary btn-sm flex-fill"
                                                wire:click="resetFilters">
                                            <i class="ri-refresh-line me-1"></i>
                                            Réinitialiser
                                        </button>
                                        <button class="btn btn-primary btn-sm flex-fill"
                                                wire:click="exportData">
                                            <i class="ri-download-line me-1"></i>
                                            Exporter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section des statistiques améliorée -->
            <div class="row g-4 mb-4">
                <!-- Total Entreprises -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden position-relative">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-sm bg-primary bg-gradient rounded-circle me-3">
                                            <i class="ri-building-2-line text-white fs-18"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-muted mb-0 text-uppercase fw-semibold fs-13">Total Entreprises</h6>
                                        </div>
                                    </div>
                                    <h3 class="mb-1 fw-bold text-primary">{{$stats_all_entreprise ?? 0}}</h3>
                                   <p class="text-muted mb-0">
                                        <span class="badge bg-light text-{{ $stats_progression_entreprise['direction'] == 'up' ? 'success' : 'danger' }} me-1">
                                            <i class="ri-arrow-{{ $stats_progression_entreprise['direction'] }}-line align-middle"></i>
                                            {{ $stats_progression_entreprise['direction'] == 'up' ? '+' : '-' }}{{ $stats_progression_entreprise['percentage'] }}%
                                        </span>
                                        <small>vs mois dernier</small>
                                    </p>
                                </div>
                                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                                    <i class="ri-building-2-fill display-4 text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-light bg-opacity-25 p-2">
                            <div class="d-flex justify-content-between align-items-center text-muted">
                                <small>Nombre total des entreprises</small>
                                <i class="ri-information-line"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Commerciaux -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden position-relative">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-sm bg-success bg-gradient rounded-circle me-3">
                                            <i class="ri-team-line text-white fs-18"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-muted mb-0 text-uppercase fw-semibold fs-13">Total Commerciaux</h6>
                                        </div>
                                    </div>
                                    <h3 class="mb-1 fw-bold text-success">{{$stats_all_commerciale ?? 0}}</h3>
                                    <p class="text-muted mb-0">
                                        <span class="badge bg-light text-{{ $stats_progression_commerciale['direction'] == 'up' ? 'success' : 'danger' }} me-1">
                                            <i class="ri-arrow-{{ $stats_progression_commerciale['direction'] }}-line align-middle"></i>
                                            {{ $stats_progression_commerciale['direction'] == 'up' ? '+' : '-' }}{{ $stats_progression_commerciale['percentage'] }}%
                                        </span>
                                        <small>vs mois dernier</small>
                                    </p>
                                </div>
                                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                                    <i class="ri-team-fill display-4 text-success"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-light bg-opacity-25 p-2">
                            <div class="d-flex justify-content-between align-items-center text-muted">
                                <small>Nombre de commerciaux actifs</small>
                                <i class="ri-information-line"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Utilisateurs -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden position-relative">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-sm bg-warning bg-gradient rounded-circle me-3">
                                            <i class="ri-user-3-line text-white fs-18"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-muted mb-0 text-uppercase fw-semibold fs-13">Total Utilisateurs</h6>
                                        </div>
                                    </div>
                                    <h3 class="mb-1 fw-bold text-warning">{{$stats_all_user ?? 0}}</h3>
                                    <p class="text-muted mb-0">
                                        <span class="badge bg-light text-{{ $stats_progression_user['direction'] == 'up' ? 'success' : 'danger' }} me-1">
                                            <i class="ri-arrow-{{ $stats_progression_user['direction'] }}-line align-middle"></i>
                                            {{ $stats_progression_user['direction'] == 'up' ? '+' : '-' }}{{ $stats_progression_user['percentage'] }}%
                                        </span>
                                        <small>vs mois dernier</small>
                                    </p>
                                </div>
                                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                                    <i class="ri-user-3-fill display-4 text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-light bg-opacity-25 p-2">
                            <div class="d-flex justify-content-between align-items-center text-muted">
                                <small>Utilisateurs au total</small>
                                <i class="ri-information-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section de statistiques supplémentaires (optionnelle) -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-lg-6">
                    <div class="card border-0 bg-gradient-primary text-white">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-white bg-opacity-25 rounded-circle me-3">
                                    <i class="ri-eye-line text-white fs-16"></i>
                                </div>
                                <div>
                                    <h6 class="text-white-50 mb-0 text-uppercase fs-12">Connectés aujourd'hui</h6>
                                    <h5 class="text-white mb-0">1,245</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6">
                    <div class="card border-0 bg-gradient-success text-white">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-white bg-opacity-25 rounded-circle me-3">
                                    <i class="ri-user-add-line text-white fs-16"></i>
                                </div>
                                <div>
                                    <h6 class="text-white-50 mb-0 text-uppercase fs-12">Nouvelles inscriptions</h6>
                                    <h5 class="text-white mb-0">42</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6">
                    <div class="card border-0 bg-gradient-warning text-white">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-white bg-opacity-25 rounded-circle me-3">
                                    <i class="ri-time-line text-white fs-16"></i>
                                </div>
                                <div>
                                    <h6 class="text-white-50 mb-0 text-uppercase fs-12">En attente</h6>
                                    <h5 class="text-white mb-0">8</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6">
                    <div class="card border-0 bg-gradient-danger text-white">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-white bg-opacity-25 rounded-circle me-3">
                                    <i class="ri-error-warning-line text-white fs-16"></i>
                                </div>
                                <div>
                                    <h6 class="text-white-50 mb-0 text-uppercase fs-12">Problèmes</h6>
                                    <h5 class="text-white mb-0">3</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                                <th class="sort" >Type</th>
                                                {{-- <th class="sort" >Adresse</th> --}}
                                                <th class="sort">Insccrit il y a </th>
                                                <th class="sort" >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">


                                                @if($list_entreprise && $list_entreprise->count() > 0)
                                                    @foreach ($list_entreprise as $item)
                                                    <tr>
                                                        <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <img @if($item->logo) src="{{ $item->logo }}" @else src="https://api.dicebear.com/7.x/initials/svg?seed={{ $item->name }}" @endif alt="" class="avatar-xxs rounded-circle image_src object-cover">
                                                                </div>
                                                                <div class="flex-grow-1 ms-2 name">{{ $item->name }}</div>
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
                                                        <td class="phone">{{ $item->type ? $item->type : 'A' }}</td>
                                                        <td class="date">{{ $item->created_at->diffForHumans() }}</td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item edit" >
                                                                    <a href="{{ route('dashboard.entreprise.show', $item->slug) }}" class="text-primary d-inline-block">
                                                                        <i class="ri-eye-fill fs-16 "></i>
                                                                    </a>
                                                                </li>


                                                                <li class="list-inline-item"  title="Edit">
                                                                    <a class="edit-item-btn" href="javascript:void(0);" wire:click="editEntreprise({{ $item->id }})"><i class="ri-pencil-fill align-bottom text-warning"></i></a>
                                                                </li>


                                                                    <li class="list-inline-item"  title="Delete">
                                                                        <a class="remove-item-btn" href="javascript:void(0);" wire:click="deleteEntreprise({{ $item->id }})">
                                                                            <i class="ri-delete-bin-fill align-bottom text-danger"></i>
                                                                        </a>
                                                                    </li>


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

                                        </tbody>
                                    </table>

                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2 pagination pagination-rounded">
                                        {{ $list_entreprise->links() }}
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>

                </div>
                <!--end col-->
            </div>
            <!--end row-->





        </div>
    </div>

    {{-- Modal --}}


    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_entreprise" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                {{-- Chargement --}}
                <div wire:loading>
                    <div class="overlay">
                        <div class="spinner"></div>
                    </div>
                </div>

                <div class="modal-header p-3 bg-success">
                    <h4 class="card-title text-white mb-0">
                        <i class="ri-building-2-line me-2"></i>
                        Ajouter une nouvelle entreprise
                    </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center p-4">
                    <form wire:submit.prevent='storeEntreprise'>
                        <div class="row">
                            <!-- Logo de l'entreprise -->
                            <div class="col-12 mb-4">
                                <div class="text-center">
                                    <img class="image icon-shape rounded-circle border border-3 border-light shadow-sm"
                                        @if (!is_null($AsImage))
                                            src="{{ $AsImage->temporaryUrl() }}"
                                        @else
                                            src="../Backend/images/default-company.png"
                                        @endif
                                        alt="Logo entreprise"
                                        style="height: 120px; width: 120px; object-fit: cover"/>
                                    <div class="mt-2">
                                        <small class="text-muted">Logo de l'entreprise</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations de base -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-building-line me-1 text-primary"></i>
                                        Nom de l'entreprise <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        wire:model='name'
                                        placeholder="Entrer le nom de l'entreprise">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-image-line me-1 text-success"></i>
                                        Logo <span class="text-muted">(Facultatif)</span>
                                    </label>
                                    <input type="file"
                                        class="form-control @error('AsImage') is-invalid @enderror"
                                        accept=".png, .jpg, .jpeg"
                                        wire:model='AsImage'>
                                    @error('AsImage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-phone-line me-1 text-info"></i>
                                        Téléphone <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">+225</span>
                                        <input type="tel"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            wire:model='phone'
                                            placeholder="Ex: 0123456789">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Format: 10 chiffres sans espaces</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-mail-line me-1 text-warning"></i>
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        wire:model='email'
                                        placeholder="exemple@entreprise.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Adresse -->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-map-pin-line me-1 text-secondary"></i>
                                        Adresse <span class="text-muted">(Facultatif)</span>
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror"
                                            wire:model='address'
                                            rows="2"
                                            placeholder="Adresse complète de l'entreprise"></textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type d'entreprise -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-organization-chart me-1 text-purple"></i>
                                        Type d'entreprise <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('type') is-invalid @enderror"
                                            wire:model='type'>
                                        <option value="">Sélectionner un type</option>
                                        <option value="FREE">Gratuit</option>
                                        <option value="SARL">SARL</option>
                                        <option value="SA">SA</option>
                                        <option value="SAS">SAS</option>
                                        <option value="SASU">SASU</option>
                                        <option value="EI">Entreprise Individuelle</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Info mot de passe -->
                            <div class="col-md-6">
                                <div class="alert alert-info mb-3 d-flex align-items-center">
                                    <i class="ri-information-line fs-4 me-2"></i>
                                    <div class="text-start">
                                        <small class="mb-0">
                                            <strong>Mot de passe automatique</strong><br>
                                            Un mot de passe sécurisé sera généré et envoyé par email
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">
                                <i class="ri-close-line me-1"></i>
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="ri-save-line me-1"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="edit_entreprise" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                {{-- Chargement --}}
                <div wire:loading>
                    <div class="overlay">
                        <div class="spinner"></div>
                    </div>
                </div>

                <div class="modal-header p-3 bg-primary">
                    <h4 class="card-title text-white mb-0">
                        <i class="ri-building-2-line me-2"></i>
                        Modifier l'entreprise : {{ $name }}
                    </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center p-4">
                    <form wire:submit.prevent='updateEntreprise'>
                        <div class="row">
                            <!-- Logo de l'entreprise -->
                            <div class="col-12 mb-4">
                                <div class="text-center">
                                    <img class="image icon-shape rounded-circle border border-3 border-light shadow-sm"
                                        @if (!is_null($AsImage))
                                            src="{{ $AsImage->temporaryUrl() }}"
                                        @elseif(!is_null(App\Models\Entreprise::find($id_entreprise)) && App\Models\Entreprise::find($id_entreprise)->logo)
                                            src="{{ App\Models\Entreprise::find($id_entreprise)->logo }}"
                                        @else
                                            src="../Backend/images/default-company.png"
                                        @endif
                                        alt="Logo entreprise"
                                        style="height: 120px; width: 120px; object-fit: cover"/>
                                    <div class="mt-2">
                                        <small class="text-muted">Logo de l'entreprise</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations de base -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-building-line me-1 text-primary"></i>
                                        Nom de l'entreprise <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        wire:model='name'
                                        placeholder="Entrer le nom de l'entreprise">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-image-line me-1 text-success"></i>
                                        Logo <span class="text-muted">(Facultatif)</span>
                                    </label>
                                    <input type="file"
                                        class="form-control @error('AsImage') is-invalid @enderror"
                                        accept=".png, .jpg, .jpeg"
                                        wire:model='AsImage'>
                                    @error('AsImage')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-phone-line me-1 text-info"></i>
                                        Téléphone <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">+225</span>
                                        <input type="tel"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            wire:model='phone'
                                            placeholder="Ex: 0123456789">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Format: 10 chiffres sans espaces</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-mail-line me-1 text-warning"></i>
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        wire:model='email'
                                        placeholder="exemple@entreprise.com">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Adresse -->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-map-pin-line me-1 text-secondary"></i>
                                        Adresse <span class="text-muted">(Facultatif)</span>
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror"
                                            wire:model='address'
                                            rows="2"
                                            placeholder="Adresse complète de l'entreprise"></textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type et Status -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-organization-chart me-1 text-purple"></i>
                                        Type d'entreprise <span class="text-muted">(Facultatif)</span>
                                    </label>
                                    <select class="form-select @error('type') is-invalid @enderror" wire:model='type'>
                                        <option value="">-- Sélectionner le type --</option>
                                        <option value="SARL">SARL</option>
                                        <option value="SA">SA</option>
                                        <option value="SAS">SAS</option>
                                        <option value="EIRL">EIRL</option>
                                        <option value="Auto-entrepreneur">Auto-entrepreneur</option>
                                        <option value="Association">Association</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-start fw-semibold">
                                        <i class="ri-checkbox-circle-line me-1 text-success"></i>
                                        Statut
                                    </label>
                                    <select class="form-select @error('status') is-invalid @enderror" wire:model='status'>
                                        <option value="ACTIVE">
                                            <i class="ri-checkbox-circle-fill text-success"></i> Actif
                                        </option>
                                        <option value="INACTIVE">
                                            <i class="ri-close-circle-fill text-danger"></i> Inactif
                                        </option>
                                        <option value="PENDING">
                                            <i class="ri-time-fill text-warning"></i> En attente
                                        </option>
                                        <option value="SUSPENDED">
                                            <i class="ri-pause-circle-fill text-secondary"></i> Suspendu
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mot de passe -->
                            <div class="col-12">
                                <div class="card border-0 bg-light">
                                    <div class="card-body p-3">
                                        <h6 class="card-title mb-3">
                                            <i class="ri-lock-line me-1 text-danger"></i>
                                            Modification du mot de passe
                                            <small class="text-muted">(Laissez vide pour conserver l'actuel)</small>
                                        </h6>

                                        <div class="mb-3">
                                            <label class="form-label text-start">
                                                <i class="ri-key-line me-1"></i>
                                                Nouveau mot de passe
                                            </label>
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    wire:model='password'
                                                    placeholder="Minimum 8 caractères">
                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                                    <i class="ri-eye-line" id="toggleIcon"></i>
                                                </button>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mt-1">
                                                <small class="text-muted">
                                                    <i class="ri-information-line"></i>
                                                    Laissez ce champ vide si vous ne souhaitez pas modifier le mot de passe
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="col-12 mt-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                        <i class="ri-close-line me-1"></i>
                                        Annuler
                                    </button>
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                        <span wire:loading.remove>
                                            <i class="ri-save-line me-1"></i>
                                            Modifier l'entreprise
                                        </span>
                                        <span wire:loading>
                                            <i class="ri-loader-4-line spin me-1"></i>
                                            Modification en cours...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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


    <style>
.spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
</style>



<style>
.avatar-sm {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.badge {
    font-size: 0.75rem;
}

.fs-18 {
    font-size: 18px;
}

.fs-16 {
    font-size: 16px;
}

.fs-13 {
    font-size: 13px;
}

.fs-12 {
    font-size: 12px;
}

.bg-opacity-25 {
    background-color: rgba(var(--bs-bg-opacity), 0.25) !important;
}

.text-white-50 {
    color: rgba(255, 255, 255, 0.5) !important;
}
</style>

@endpush


@push('scripts')

<script>
function togglePassword() {
    const passwordInput = document.querySelector('input[wire\\:model="password"]');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.className = 'ri-eye-off-line';
    } else {
        passwordInput.type = 'password';
        toggleIcon.className = 'ri-eye-line';
    }
}
</script>

@endpush


