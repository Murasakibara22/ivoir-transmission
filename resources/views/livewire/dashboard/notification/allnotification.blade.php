<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">NOTIFICATIONS</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">Nos notifications</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">

                <!--end col-->
                <div class="@if($selected_notification) col-md-9 @else col-md-12 @endif">
                    <div class="card" id="contactList" >
                        <div class="card-header">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" wire:model.live='search' placeholder="Search for contact...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card mb-3">
                                    <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="name" scope="col">Titre</th>
                                                <th class="sort" data-sort="email_id" scope="col">subtitle </th>
                                                <th class="sort" data-sort="date" scope="col">type</th>
                                                <th class="sort" data-sort="date" scope="col">Date</th>
                                                <th class="sort" data-sort="date" scope="col">Read at </th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @if($list_notification && $list_notification->count() > 0)
                                            @foreach($list_notification as $key => $notification)
                                            <tr class="contact-list @if($notification->is_read == 1) bg-light @endif">
                                                <th scope="row">
                                                   {{ $key + 1}}
                                                </th>
                                                <td class="name">
                                                    {{ Illuminate\Support\Str::limit($notification->title, 100) }}
                                                    {{-- <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0"><img src="https://api.dicebear.com/7.x/initials/svg?seed={{ $notification->Admin?->name }}" alt="" class="avatar-xs rounded-circle"></div>
                                                        <div class="flex-grow-1 ms-2 name">{{ Illuminate\Support\Str::limit($notification->title, 10) }}</div>
                                                    </div> --}}
                                                </td>
                                                <td class="company_name">{{ Illuminate\Support\Str::limit($notification->subtitle, 60) }}</td>
                                                <td class="phone">{{ $notification->type }}</td>
                                                <td class="date">{{ date('d M, Y', strtotime($notification->created_at))}} <small class="text-muted">{{ date('h:i A', strtotime($notification->created_at))}}</small></td>
                                                <td class="phone">{{ $notification->is_read ? 'oui' : 'non' }}</td>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item edit">
                                                            <div class="dropdown">
                                                                <button class="btn btn-soft-success btn-sm dropdown" type="button" wire:click="viewNotification({{ $notification->id }})" >
                                                                   <i class="ri-eye-fill align-middle"></i>
                                                                </button>
                                                            </div>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <div class="dropdown">
                                                                <button class="btn btn-soft-danger btn-sm dropdown" wire:click="deleteNotification({{ $notification->id }})" type="button" >
                                                                   <i class="ri-delete-bin-fill align-middle"></i>
                                                                </button>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ notifications We did not find any notifications for you search.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <div class="pagination-wrap hstack gap-2">
                                       {{ $list_notification->links() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                @if($selected_notification)
                <div class="col-md-3">
                    <div class="card" id="contact-view-detail">
                        <div class="card-body text-center">
                            <h5 class="mt-4 mb-1"> Titre : {{ $selected_notification->title }}</h5>

                            @if($selected_notification->Admin)
                                <div class="position-relative d-inline-block">
                                    <img src="https://api.dicebear.com/7.x/initials/svg?seed={{ $selected_notification->Admin?->name }}" alt="" class="avatar-lg rounded-circle img-thumbnail">
                                    <span class="contact-active position-absolute rounded-circle bg-success"><span class="visually-hidden"></span>
                                </div>
                                <p class="text-muted">{{ $selected_notification->Admin?->name }}</p>
                            @endif

                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="fw-medium" scope="row">Service</td>
                                            <td>{{ $selected_notification->type_service }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium" scope="row">Reçu </td>
                                            <td>{{ $selected_notification->is_received ? 'Oui' : 'Non' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium" scope="row">Lu </td>
                                            <td>{{ $selected_notification->is_read ? 'Oui' : 'Non' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium" scope="row">Type</td>
                                            <td>{{ $selected_notification->type }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h6 class="text-muted text-uppercase fw-semibold mt-3">Description</h6>
                            <p class="text-muted mb-4">{{ $selected_notification->subtitle }}

                                <br />
                                <br />
                                @if($selected_notification->meta_data_id)
                                <a href="javascript:void(0);" wire:click="viewReservation({{ $selected_notification }})" class="link-success">voir la réservation</a>
                                @endif
                            </p>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                @endif
                <!--end col-->
            </div>
            <!--end row-->


        </div>
    </div>
</div>
