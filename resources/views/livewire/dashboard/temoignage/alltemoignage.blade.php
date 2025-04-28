<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Témoignages</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Témoignages</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                @if($list_temoignage && count($list_temoignage) > 0)
                    @foreach($list_temoignage as $key => $value)
                        <div class="timeline-item left">
                            <div class="content">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="https://api.dicebear.com/9.x/adventurer-neutral/svg?seed={{ $value->username }}" alt="" class="avatar-sm rounded">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-15">@Erica245 <small class="text-muted fs-13 fw-normal">- {{ $value->created_at->diffForHumans() }}</small></h5>
                                        <p class="text-muted mb-2">{!! $value->description !!}</p>
                                        <div class="hstack gap-2">
                                            @if($value->status == "ACTIVATED")
                                                <a class="btn btn-sm btn-warning" wire:click="ChangeStatusTemoignage({{ $value->id }})"><span class="me-1">&#10060;</span> desactiver</a>
                                            @else
                                                <a class="btn btn-sm btn-success" wire:click="ChangeStatusTemoignage({{ $value->id }})"><span class="me-1">&#9989;</span> activer</a>
                                            @endif
                                            <a class="btn btn-sm btn-danger" wire:click="DeleteTemoignage({{ $value->id }})"><span class="me-1">&#128465;</span> supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
</div>
