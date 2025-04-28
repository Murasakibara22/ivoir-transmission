<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Terms & conditions</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                                <li class="breadcrumb-item active">Terms & conditions</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="flex-grow-1 fs-16 mb-0" id="filetype-title"></h5>
                    <div class="flex-shrink-0">
                        <button class="btn @if($list_terms)  btn-warning @else btn-primary @endif createFile-modal" @if($list_terms) wire:click="edit" @else wire:click="addPrivacy" @endif ><i class="ri-add-circle-line align-bottom me-1"></i> @if($list_terms) Modifier @else Ajouter @endif  </button>
                    </div>
                </div>
            </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card">
                                <div class="bg-soft-warning position-relative">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <h3>Terms & conditions</h3>
                                            <p class="mb-0 text-muted">{{ $list_terms ? date('d M, Y', strtotime($list_terms->created_at)) : '' }}</p>
                                        </div>
                                    </div>
                                    <div class="shape">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="1440" height="60" preserveAspectRatio="none" viewBox="0 0 1440 60">
                                            <g mask="url(&quot;#SvgjsMask1001&quot;)" fill="none">
                                                <path d="M 0,4 C 144,13 432,48 720,49 C 1008,50 1296,17 1440,9L1440 60L0 60z" style="fill: var(--vz-card-bg-custom);"></path>
                                            </g>
                                            <defs>
                                                <mask id="SvgjsMask1001">
                                                    <rect width="1440" height="60" fill="#ffffff"></rect>
                                                </mask>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-4">

                                        {!!  $list_terms->content ?? 'Aucune description' !!}

                                    <div class="text-end">
                                        <a href="javascript:void(0)" class="btn btn-danger">Activer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


        </div>
    </div>

    <!-- Modal -->

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="add_privacy" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h4 class="card-title mb-0">Ajouter une Politique de Confidentialité</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center p-4">
                    <form @if($list_terms) wire:submit.prevent='updatePrivacy' @else wire:submit.prevent='store' @endif>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3" wire:ignore>
                                    <label for="compnayNameinput" class="form-label">Description</label>
                                    <textarea class="form-control" id="descriptionPrivacy" wire:model='description' rows="5"></textarea>
                                </div>
                                @error('description')
                                    <span class="feedback-text">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


</div>





@push('styles')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endpush


@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#descriptionPrivacy').summernote({
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
        $('#description_additionnal_service2').summernote({
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
