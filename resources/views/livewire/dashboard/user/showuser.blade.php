<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- ==========================
                 Header User
            =========================== -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-n4 mx-n4">
                        <div class="bg-soft-info">
                            <div class="card-body pb-0 px-4">
                                <div class="row mb-3">
                                    <div class="col-md">
                                        <div class="row align-items-center g-3">
                                            <div class="col-md-auto">
                                                <div class="avatar-md">
                                                    <div class="avatar-title bg-white rounded-circle">
                                                        <img @if($show_user->photo_url) src="{{ $show_user->photo_url }}"
                                                             @else src="https://api.dicebear.com/7.x/initials/svg?seed={{ $show_user->username }}"
                                                             @endif
                                                             alt="" class="avatar-xs">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div>
                                                    <h4 class="fw-bold">{{ $show_user->username }}</h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div>Date d'inscription :
                                                            <span class="fw-medium">{{ $show_user->created_at->format('d M Y') }}</span>
                                                        </div>
                                                        <div class="vr"></div>
                                                        <div>Email :
                                                            <span class="fw-medium">{{ $show_user->email ?? 'Non renseigné' }}</span>
                                                        </div>
                                                        <div class="vr"></div>
                                                        <div>Téléphone :
                                                            <span class="fw-medium">{{ $show_user->phone ?? 'Non renseigné' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="hstack gap-1 flex-wrap">
                                            <button type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-flag-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglets -->
                                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link @if($currentPage == 'reservations') active @endif fw-semibold"
                                           wire:click="togglecurrentPage('reservations')" href="javascript:void(0);">
                                            Réservations
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($currentPage == 'paiements') active @endif fw-semibold"
                                           wire:click="togglecurrentPage('paiements')" href="javascript:void(0);">
                                            Paiements
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($currentPage == 'notes') active @endif fw-semibold"
                                           wire:click="togglecurrentPage('notes')" href="javascript:void(0);">
                                            Notes
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==========================
                 Contenu Onglets
            =========================== -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content text-muted">

                        <!-- Onglet Reservations -->
                        <div class="tab-pane fade @if($currentPage == 'reservations') active show @endif">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3">Réservations</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-centered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Réf</th>
                                                    <th>Chassis</th>
                                                    <th>Date début</th>
                                                    <th>Montant</th>
                                                    <th>Status</th>
                                                    <th>Adresse</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($list_reservations as $res)
                                                    <tr>
                                                        <td>#{{ $res->reference ?? $res->id }}</td>
                                                        <td>{{ $res->chassis ?? '-' }}</td>
                                                        <td>{{ optional($res->date_debut)->format('d/m/Y H:i') }}</td>
                                                        <td>{{ number_format($res->montant,0,',','.') }} Fcfa</td>
                                                        <td>
                                                            <span class="badge
                                                                @if($res->status=='PENDING') badge-soft-warning
                                                                @elseif($res->status=='TERMINEE') badge-soft-success
                                                                @elseif($res->status=='ANNULER') badge-soft-danger
                                                                @else badge-soft-info @endif">
                                                                {{ $res->status }}
                                                            </span>
                                                        </td>
                                                        <td>{{ \Illuminate\Support\Str::limit($res->adresse_name,30) }}</td>
                                                        <td>
                                                            <a href="{{ route('dashboard.reservations.show',$res->slug) }}" class="btn btn-sm btn-primary">
                                                                <i class="ri-eye-fill"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="7" class="text-center">Aucune réservation</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Onglet Paiements -->
                        <div class="tab-pane fade @if($currentPage == 'paiements') active show @endif">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3">Paiements</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-centered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Réf Réservation</th>
                                                    <th>Montant</th>
                                                    <th>Méthode</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($list_paiements as $pay)
                                                    <tr>
                                                        <td>#{{ $pay->reservation?->reference ?? '-' }}</td>
                                                        <td>{{ number_format($pay->montant,0,',','.') }} Fcfa</td>
                                                        <td>{{ $pay->methode ?? '-' }}</td>
                                                        <td>
                                                            <span class="badge
                                                                @if($pay->status=='SUCCESSFUL') badge-soft-success
                                                                @elseif($pay->status=='PENDING') badge-soft-warning
                                                                @else badge-soft-danger @endif">
                                                                {{ $pay->status }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $pay->created_at->format('d/m/Y H:i') }}</td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="5" class="text-center">Aucun paiement</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Onglet Notes -->
                        <div class="tab-pane fade @if($currentPage == 'notes') active show @endif">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3">Notes</h5>
                                    @forelse($list_notes as $note)
                                        <div class="border rounded p-3 mb-2">
                                            <strong>{{ $note->note }}/5</strong>
                                            <p class="mb-1">{{ $note->commentaire }}</p>
                                            <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
                                        </div>
                                    @empty
                                        <p class="text-center">Aucune note</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div><!-- tab-content -->
                </div>
            </div>
        </div>
    </div>
</div>
