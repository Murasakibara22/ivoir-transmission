@extends('Frontend.pages.dashboard.layouts.app-paiement')

@section('content')

    <!-- MAIN CONTENT -->
    <div class="paiements-page">
        <h1 class="page-title">Paiements</h1>
        <p class="page-subtitle">Gérez vos paiements et factures</p>

        <!-- Stats Cards -->
        <div class="payment-stats">
            <div class="payment-stat-card">
                <div class="stat-icon-circle success">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <div class="stat-label">Total payé</div>
                    <div class="stat-value">145 000 F</div>
                </div>
            </div>

            <div class="payment-stat-card">
                <div class="stat-icon-circle warning">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <div class="stat-label">En attente</div>
                    <div class="stat-value">120 000 F</div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="payment-tabs">
            <button class="payment-tab active" data-tab="historique">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                Historique
            </button>
            <button class="payment-tab" data-tab="moyens">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Moyens de paiement
            </button>
        </div>

        <!-- Tab Historique -->
        <div class="tab-content active" id="tab-historique">
            <div class="payment-list">

                <div class="payment-card" onclick="openPaymentModal()">
                    <div class="payment-card-header">
                        <div>
                            <h3 class="payment-title">Vidange moteur</h3>
                            <p class="payment-date">15 Jan 2026</p>
                        </div>
                        <span class="payment-status-badge success">Payé</span>
                    </div>
                    <div class="payment-card-footer">
                        <div>
                            <div class="payment-amount">35 000 F</div>
                            <div class="payment-method">Mobile Money</div>
                        </div>
                        <button class="btn-details">
                            Détails
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="payment-card" onclick="openPaymentModal()">
                    <div class="payment-card-header">
                        <div>
                            <h3 class="payment-title">Diagnostic complet</h3>
                            <p class="payment-date">10 Jan 2026</p>
                        </div>
                        <span class="payment-status-badge success">Payé</span>
                    </div>
                    <div class="payment-card-footer">
                        <div>
                            <div class="payment-amount">25 000 F</div>
                            <div class="payment-method">Carte bancaire</div>
                        </div>
                        <button class="btn-details">
                            Détails
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="payment-card" onclick="openPaymentModal()">
                    <div class="payment-card-header">
                        <div>
                            <h3 class="payment-title">Changement pneus</h3>
                            <p class="payment-date">05 Jan 2026</p>
                        </div>
                        <span class="payment-status-badge warning">En attente</span>
                    </div>
                    <div class="payment-card-footer">
                        <div>
                            <div class="payment-amount">120 000 F</div>
                            <div class="payment-method">Mobile Money</div>
                        </div>
                        <button class="btn-details">
                            Détails
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="payment-card" onclick="openPaymentModal()">
                    <div class="payment-card-header">
                        <div>
                            <h3 class="payment-title">Révision générale</h3>
                            <p class="payment-date">28 Dec 2025</p>
                        </div>
                        <span class="payment-status-badge success">Payé</span>
                    </div>
                    <div class="payment-card-footer">
                        <div>
                            <div class="payment-amount">85 000 F</div>
                            <div class="payment-method">Espèces</div>
                        </div>
                        <button class="btn-details">
                            Détails
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Tab Moyens de paiement -->
        <div class="tab-content" id="tab-moyens">
            <div class="payment-methods-list">

                <div class="payment-method-card">
                    <div class="method-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="method-info">
                        <div class="method-name">Orange Money</div>
                        <div class="method-number">**** 1234</div>
                    </div>
                    <span class="method-default-badge">Par défaut</span>
                    <svg class="method-arrow" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>

                <div class="payment-method-card">
                    <div class="method-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <div class="method-info">
                        <div class="method-name">Visa</div>
                        <div class="method-number">**** 5678</div>
                    </div>
                    <svg class="method-arrow" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>

                <button class="add-method-btn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Ajouter un moyen de paiement
                </button>

            </div>
        </div>
    </div>

    <!-- Modal Détails Paiement -->
    <div class="payment-detail-modal" id="paymentModal">
        <div class="modal-overlay" onclick="closePaymentModal()"></div>
        <div class="modal-content">
            <button class="modal-close" onclick="closePaymentModal()">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <h2 class="modal-title">Détails du paiement</h2>

            <span class="modal-status-badge success">Payé</span>

            <div class="modal-amount-box">
                <div class="modal-amount-label">Montant total</div>
                <div class="modal-amount-value">35 000 F</div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Informations
                </h3>
                <div class="modal-info-row">
                    <span class="modal-label">Référence:</span>
                    <span class="modal-value">PAY-2026-001234</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-label">Date:</span>
                    <span class="modal-value">15 Jan 2026</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-label">Méthode:</span>
                    <span class="modal-value">Mobile Money</span>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Service
                </h3>
                <div class="modal-info-row">
                    <span class="modal-label">Service:</span>
                    <span class="modal-value">Vidange moteur</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-label">Mécanicien:</span>
                    <span class="modal-value">Jean-Marc Kouassi</span>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    Véhicule
                </h3>
                <div class="modal-info-row">
                    <span class="modal-label">Véhicule:</span>
                    <span class="modal-value">Peugeot 308</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-label">Lieu:</span>
                    <span class="modal-value">Ivoire Transmission Abidjan</span>
                </div>
            </div>

            <button class="btn-download-invoice">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Télécharger la facture
            </button>
        </div>
    </div>

@endsection

