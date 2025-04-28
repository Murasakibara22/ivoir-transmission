<div>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Avis</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Avis</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">
                @if($list_note && $list_note->count() > 0)
                @foreach($list_note as $note)
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="content card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="{{ json_decode($note->produit()->first()->images)[0] }}" alt="" class="avatar-sm rounded">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <a href="{{ route('dashboard.produits.show',$note->produit()->first()->slug) }}" class="fs-15 h5">{{ Illuminate\Support\Str::limit($note->produit()->first()->libelle,30) }} </a>
                                        <div class="d-flex flex-wrap gap-2 align-items-center mt-0">
                                            @for($i = 0; $i < $note->note; $i++)
                                            <span class="mdi mdi-star text-warning"></span>
                                            @endfor
                                        </div>
                                        <p class="text-muted mb-3 mt-2">{{$note->commentaire}}</p>
                                        <a href="javascript:void(0);" class="fs-15 h5 mt-2 mb-4"> {{ '@'.$note->user()->first()->username }} <small class="text-muted fs-13 fw-normal">- 10 min Ago</small></a>
                                        <div class="hstack gap-2 mt-3">
                                            @if($note->status == "Activer")
                                                <a class="btn btn-sm btn-warning" href="javascript:void(0);" wire:click="toggleAvis({{$note->id}})"><span class="me-1">&#13065;</span> désactiver</a>
                                            @else
                                                <a class="btn btn-sm btn-success" href="javascript:void(0);" wire:click="toggleAvis({{$note->id}})"><span class="me-1">&#13065;</span> activer</a>
                                            @endif
                                            <a class="btn btn-sm btn-danger" href="javascript:void(0);" wire:click="DeleteNote({{$note->id}})"><span class="me-1">&#128465;</span> supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                <!--end col-->
            </div>
            <!--end row-->

        </div>
    </div>


</div>
