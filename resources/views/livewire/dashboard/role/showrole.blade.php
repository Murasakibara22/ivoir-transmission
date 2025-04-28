<div>

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card rounded-0 bg-soft-success mx-n4 mt-n4 border-top">
                        <div class="px-4">
                            <div class="row">
                                <div class="col-xxl-5 align-self-center">
                                    <div class="py-4">
                                        <h4 class="display-6 coming-soon-text">Rôle: {{$show_role->libelle}}</h4>
                                        <p class="text-success fs-15 mt-3">Cette page vous permet de specfier les droits qu'un role aura sur un ou plusieurs Menus !</p>
                                    </div>
                                </div>
                                <div class="col-xxl-3 ms-auto">
                                    <div class="mb-n5 pb-1 faq-img d-none d-xxl-block">
                                        <img src="assets/images/faq-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="row justify-content-evenly">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0 me-1">
                                <i class="ri-question-line fs-24 align-middle text-success me-1"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-14 mb-0 fw-semibold">Cliquer sur un menu pour afficher les droits  </h5>
                            </div>

                            <div class="flex-grow-2">
                                    <a href="{{ route('dashboard.roles-menu') }}" class="btn btn-success"><i class="ri-check-double-fill align-bottom me-1"></i>Terminer</a>
                            </div>
                        </div>

                        @if($list_menus && $list_menus->count() > 0)
                        @foreach($list_menus as $key => $menu)
                            <div class="col-lg-4">
                                <div class="mt-3">
                                    <div class="accordion accordion-border-box" id="genques-accordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="genques-headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" wire:ignore.self data-bs-target="#genques-collapse{{$menu->id}}" aria-expanded="false" aria-controls="genques-collapse{{$menu->id}}">
                                                    {{ $menu->libelle}}
                                                </button>
                                            </h2>
                                            <div id="genques-collapse{{$menu->id}}" wire:ignore.self class="accordion-collapse collapse" aria-labelledby="genques-headingTwo" data-bs-parent="#genques-accordion">
                                                <div class="accordion-body">
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" wire:loading.class="disabled" id="formCheck1" @if($menu->rolemenus()->where('role_id',$show_role->id)->whereJsonContains('droit', 'READ')->count() > 0) checked=""  wire:click="distachRightMenu({{ $menu->id }},'READ')"  @else  wire:click="AttachRightMenu({{ $menu->id }},'READ')" @endif>
                                                        <label class="form-check-label" for="formCheck1">
                                                            Lire Tous
                                                        </label>
                                                    </div>

                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" wire:loading.class="disabled" type="checkbox" id="formCheck2" @if($menu->rolemenus()->where('role_id',$show_role->id)->whereJsonContains('droit', 'CREATE')->count() > 0) checked=""  wire:click="distachRightMenu({{ $menu->id }},'CREATE')"  @else  wire:click="AttachRightMenu({{ $menu->id }},'CREATE')" @endif>
                                                        <label class="form-check-label" for="formCheck2">
                                                            Creér
                                                        </label>
                                                    </div>

                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" wire:loading.class="disabled" type="checkbox" id="formCheck2" @if($menu->rolemenus()->where('role_id',$show_role->id)->whereJsonContains('droit', 'READ ONE')->count() > 0) checked=""  wire:click="distachRightMenu({{ $menu->id }},'READ ONE')"  @else   wire:click="AttachRightMenu({{ $menu->id }},'READ ONE')" @endif>
                                                        <label class="form-check-label" for="formCheck2">
                                                            Lire Un
                                                        </label>
                                                    </div>

                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" wire:loading.class="disabled" type="checkbox" id="formCheck2" @if($menu->rolemenus()->where('role_id',$show_role->id)->whereJsonContains('droit', 'UPDATE')->count() > 0) checked=""  wire:click="distachRightMenu({{ $menu->id }},'UPDATE')"  @else  wire:click="AttachRightMenu({{ $menu->id }},'UPDATE')" @endif>
                                                        <label class="form-check-label" for="formCheck2">
                                                            Modifier
                                                        </label>
                                                    </div>

                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" wire:loading.class="disabled" type="checkbox" id="formCheck2" @if($menu->rolemenus()->where('role_id',$show_role->id)->whereJsonContains('droit', 'DELETE')->count() > 0) checked=""  wire:click="distachRightMenu({{ $menu->id }},'DELETE')"  @else  wire:click="AttachRightMenu({{ $menu->id }},'DELETE')" @endif>
                                                        <label class="form-check-label" for="formCheck2">
                                                            Supprimer
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end accordion-->
                                </div>
                            </div>
                        @endforeach
                        @endif

                    </div>
                </div>
                <!--end col-->.
            </div>
            <!--end row-->


        </div>
    </div>
</div>
