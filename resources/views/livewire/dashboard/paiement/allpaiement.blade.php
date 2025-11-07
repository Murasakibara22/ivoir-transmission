<div>


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Liste des paiements </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                <li class="breadcrumb-item active">Paiements</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-muted mb-0">Total paiements</p>
                                </div>

                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$all_payment}}">{{ number_format($all_payment, 0, ',', ' ') }}</span> fcfa</h4>
                                     <span class="text-muted">Paiements </span>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-light rounded fs-3">
                                        <i data-feather="file-text" class="text-success icon-dual-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-muted mb-0">PAYÉES</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $paid_payment }}">{{ number_format($paid_payment,0, ',', ' ') }}</span>fcfa</h4>
                                   <span class="text-muted">Payé par les clients</span>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-light rounded fs-3">
                                        <i data-feather="check-square" class="text-success icon-dual-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-muted mb-0">EN ATTENTE</p>
                                </div>

                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$pending_payment}}">{{ number_format($pending_payment,0, ',', ' ') }}</span>fcfa</h4>
                                    <span class="badge bg-warning me-1">338</span> <span class="text-muted">paiements en attente</span>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-light rounded fs-3">
                                        <i data-feather="clock" class="text-success icon-dual-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-muted mb-0">ANNULÉES</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$canceled_payment}}">{{ number_format($canceled_payment,0, ',', ' ')}}</span>fcfa</h4>
                                    <span class="badge bg-warning me-1">502</span> <span class="text-muted">Annulé par les clients</span>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-light rounded fs-3">
                                        <i data-feather="x-octagon" class="text-success icon-dual-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="invoiceList">
                        <div class="card-header border-0">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1">Paiements</h5>
                                <div class="flex-shrink-0">
                                    <div class="d-flex gap-2 flex-wrap">
                                        <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
                            <form>
                                <div class="row g-3">
                                    <!-- Recherche par référence ou client -->
                                    <div class="col-xxl-3 col-sm-12">
                                        <div class="search-box">
                                            <input type="text" class="form-control search bg-light border-light"
                                                placeholder="Recherche par référence, client ou contact..."
                                                wire:model="search">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!-- Date de paiement : de / à -->
                                    <div class="col-xxl-2 col-sm-4">
                                        <input type="date" class="form-control bg-light border-light" wire:model="date_from" placeholder="Date début">
                                    </div>
                                    <div class="col-xxl-2 col-sm-4">
                                        <input type="date" class="form-control bg-light border-light" wire:model="date_to" placeholder="Date fin">
                                    </div>
                                    <!--end col-->

                                    <!-- Statut du paiement -->
                                    <div class="col-xxl-2 col-sm-4">
                                        <select class="form-control" wire:model="status">
                                            <option value="">Tous les statuts</option>
                                            <option value="{{ \App\Models\Paiement::PAID }}">Payé</option>
                                            <option value="{{ \App\Models\Paiement::PENDING }}">En attente</option>
                                            <option value="{{ \App\Models\Paiement::CANCELED }}">Annulé</option>
                                            <option value="{{ \App\Models\Paiement::FAILED }}">Échoué</option>
                                            <option value="{{ \App\Models\Paiement::INITIATED }}">Initié</option>
                                            <option value="{{ \App\Models\Paiement::EXPIRED }}">Expiré</option>
                                        </select>
                                    </div>
                                    <!--end col-->

                                    <!-- Méthode de paiement -->
                                    <div class="col-xxl-2 col-sm-4">
                                        <select class="form-control" wire:model="methode">
                                            <option value="">Toutes les méthodes</option>
                                            <option value="Orange Money">Orange Money</option>
                                            <option value="MTN Mobile Money">MTN Mobile Money</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Carte bancaire">Carte bancaire</option>
                                            <!-- ajoute ici toutes les méthodes disponibles -->
                                        </select>
                                    </div>
                                    <!--end col-->

                                    <!-- Bouton filtrer -->
                                    <div class="col-xxl-1 col-sm-4">
                                        <button type="button" class="btn btn-primary w-100" wire:click.prevent="$refresh">
                                            <i class="ri-equalizer-fill me-1 align-bottom"></i> Filtrer
                                        </button>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="d-flex float-end gap-2 mb-3">
                                <button wire:click="exportExcel" class="btn btn-success">
                                    <i class="ri-file-excel-2-fill"></i> Export Excel
                                </button>
                                <button wire:click="exportPdf" class="btn btn-danger">
                                    <i class="ri-file-pdf-fill"></i> Export PDF
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card">
                                    <table class="table align-middle table-nowrap" id="invoiceTable">
                                        <thead class="text-muted">
                                            <tr>
                                                <th class="sort text-uppercase" data-sort="invoice_id">ID</th>
                                                <th class="sort text-uppercase" data-sort="customer_name">Clients</th>
                                                <th class="sort text-uppercase" data-sort="email">Contacts</th>
                                                <th class="sort text-uppercase" data-sort="date">Date</th>
                                                <th class="sort text-uppercase" data-sort="invoice_amount">Montant</th>
                                                <th class="sort text-uppercase" data-sort="payment">Methode de paiements</th>
                                                <th class="sort text-uppercase" data-sort="status">Status</th>
                                                <th class="sort text-uppercase" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all" id="invoice-list-data">
                                            @if($list_paiements && count($list_paiements) > 0)
                                            @foreach($list_paiements as $paiement)
                                                <tr>
                                                    <td class="id"><a href="javascript:void(0);" onclick="ViewInvoice(this);" data-id="25000351" class="fw-medium link-primary">#{{ Illuminate\Support\Str::limit($paiement->reference, 10) }}</a></td>
                                                    <td class="customer_name">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ $paiement->user()->first()->photo_url ?? 'https://ui-avatars.com/api/?name=' . $paiement->user()->first()?->username }}" alt="" class="avatar-xs rounded-circle me-2">{{ $paiement->user()->first()?->username }}
                                                        </div>
                                                    </td>
                                                    <td class="email">{{ $paiement->user()->first()?->phone }}</td>
                                                    <td class="date">{{ date('d M, Y', strtotime($paiement->created_at)) }}</td>
                                                    <td class="invoice_amount">{{ number_format($paiement->montant, 0, ',', '.') }} fcfa</td>
                                                    <td class="payment">{{ $paiement->methode }}</td>
                                                    <td class="status">
                                                        @if($paiement->status == "en attente" || $paiement->status == "INITIATED")
                                                            <span class="badge badge-soft-warning text-uppercase">En attente</span>
                                                        @elseif($paiement->status == "TERMINEE" || $paiement->status == "PAYE")
                                                            <span class="badge badge-soft-success text-uppercase">Valider</span>
                                                        @elseif($paiement->status == "ANNULER" || $paiement->status == "EXPIRED")
                                                            <span class="badge badge-soft-danger text-uppercase">Annuler</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end" style="">

                                                                <li><a class="dropdown-item" href="javascript:void(0);" wire:click="exportPaiementUniquePdf({{ $paiement->id }})"><i class="ri-download-2-line align-bottom me-2 text-muted"></i>
                                                                        Télécharger</a></li>
                                                                <li class="dropdown-divider"></li>
                                                            </ul>
                                                        </div>
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
                                            <p class="text-muted mb-0">We've searched more than 150+ invoices We did not find any invoices for you search.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <div class="pagination-wrap hstack gap-2">
                                        {{$list_paiements->links()}}
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-labelledby="deleteOrderLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-5 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                            <div class="mt-4 text-center">
                                                <h4>You are about to delete a order ?</h4>
                                                <p class="text-muted fs-15 mb-4">Deleting your order will remove all of your information from our database.</p>
                                                <div class="hstack gap-2 justify-content-center remove">
                                                    <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                    <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
                        </div>
                    </div>

                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>
