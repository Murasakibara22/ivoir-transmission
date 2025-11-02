<!-- Modal Détails Facture -->
@if($showDetailsModal && $selectedFacture)
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary-subtle">
                <h5 class="modal-title">
                    <i class="ri-bill-line me-2"></i>Détails de la facture
                </h5>
                <button type="button" wire:click="closeDetailsModal" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <!-- Header Facture -->
                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="mb-2">{{ $selectedFacture->ref }}</h3>
                                <button wire:click="goToEntreprise({{ $selectedFacture->entreprise_id }})"
                                        class="btn btn-link btn-sm p-0 mb-2">
                                    <i class="ri-building-line me-1"></i>{{ $selectedFacture->entreprise->name }}
                                </button>
                                <p class="text-muted mb-0">
                                    @if($selectedFacture->entreprise->email)
                                        <i class="ri-mail-line me-1"></i>{{ $selectedFacture->entreprise->email }}<br>
                                    @endif
                                    @if($selectedFacture->entreprise->phone)
                                        <i class="ri-phone-line me-1"></i>{{ $selectedFacture->entreprise->phone }}
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                @if($selectedFacture->status_paiement === 'PAID')
                                    <span class="badge bg-success fs-5 mb-2">
                                        <i class="ri-checkbox-circle-line me-1"></i>Payée
                                    </span>
                                @elseif($selectedFacture->status_paiement === 'PENDING')
                                    <span class="badge bg-warning fs-5 mb-2">
                                        <i class="ri-time-line me-1"></i>En attente
                                    </span>
                                @elseif($selectedFacture->status_paiement === 'OVERDUE')
                                    <span class="badge bg-danger fs-5 mb-2">
                                        <i class="ri-alarm-warning-line me-1"></i>En retard
                                    </span>
                                @else
                                    <span class="badge bg-dark fs-5 mb-2">Annulée</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dates et informations -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-muted mb-3">Informations</h6>
                                <table class="table table-borderless table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" width="50%">Date d'émission</td>
                                            <td class="fw-semibold">
                                                {{ \Carbon\Carbon::parse($selectedFacture->date_emission)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Date d'échéance</td>
                                            <td class="fw-semibold">
                                                {{ \Carbon\Carbon::parse($selectedFacture->date_echeance)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                        @if($selectedFacture->date_paiement)
                                        <tr>
                                            <td class="text-muted">Date de paiement</td>
                                            <td class="fw-semibold text-success">
                                                {{ \Carbon\Carbon::parse($selectedFacture->date_paiement)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-muted mb-3">Entretien lié</h6>
                                @if($selectedFacture->entretien)
                                <table class="table table-borderless table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" width="50%">N° Entretien</td>
                                            <td>
                                                <span class="badge bg-primary-subtle text-primary">
                                                    #{{ $selectedFacture->entretien->numero_entretien }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Date entretien</td>
                                            <td class="fw-semibold">
                                                {{ \Carbon\Carbon::parse($selectedFacture->entretien->date_prevue)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Contrat</td>
                                            <td class="fw-semibold">
                                                {{ $selectedFacture->contrat->libelle ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else
                                <p class="text-muted mb-0">Aucun entretien lié</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails montants -->
                <div class="card border">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="ri-money-dollar-circle-line me-1"></i>Détails des montants</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted">Montant HT</td>
                                    <td class="text-end fw-semibold">{{ number_format($selectedFacture->montant) }} FCFA</td>
                                </tr>
                                @if($selectedFacture->montant_tva > 0)
                                <tr>
                                    <td class="text-muted">TVA ({{ $selectedFacture->taux_tva }}%)</td>
                                    <td class="text-end fw-semibold">{{ number_format($selectedFacture->montant_tva) }} FCFA</td>
                                </tr>
                                @endif
                                <tr class="border-top">
                                    <td class="fw-bold fs-5">Montant TTC</td>
                                    <td class="text-end fw-bold text-primary fs-4">
                                        {{ number_format($selectedFacture->montant_ttc) }} FCFA
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Remarques -->
                @if($selectedFacture->remarques)
                <div class="card border mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="ri-message-3-line me-1"></i>Remarques</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">{{ $selectedFacture->remarques }}</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeDetailsModal" class="btn btn-light">
                    <i class="ri-close-line me-1"></i>Fermer
                </button>
                <button wire:click="downloadFacture({{ $selectedFacture->id }})" class="btn btn-secondary">
                    <i class="ri-download-line me-1"></i>Télécharger PDF
                </button>
                @if($selectedFacture->status_paiement !== 'PAID')
                <button wire:click="marquerPayee({{ $selectedFacture->id }})" class="btn btn-success">
                    <i class="ri-check-line me-1"></i>Marquer comme payée
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

