@extends('Frontend.pages.dashboard.layouts.app')

@section('content')

{{-- Header de la page --}}
<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Mes Rendez-vous</h1>
            <p class="page-subtitle">Gérez vos réservations</p>
        </div>
        <button class="filter-btn" id="filterBtn">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
        </button>
    </div>
</div>

{{-- Tabs de filtrage --}}
<div class="tabs-container">
    <button class="tab-btn active" data-tab="tous">
        Tous <span class="tab-count">(5)</span>
    </button>
    <button class="tab-btn" data-tab="avenir">
        À venir <span class="tab-count">(2)</span>
    </button>
    <button class="tab-btn" data-tab="passes">
        Passés <span class="tab-count">(3)</span>
    </button>
</div>

{{-- Liste des réservations - Tous --}}
<div class="rdv-list" data-content="tous">
    
    {{-- Card RDV - À venir --}}
    <div class="rdv-card" data-status="avenir">
        <div class="rdv-card-header">
            <div class="rdv-card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="rdv-card-info">
                <h3 class="rdv-card-title">Vidange moteur</h3>
                <p class="rdv-card-date">15 Jan 2026 à 14h30</p>
            </div>
            <span class="rdv-badge avenir">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                À venir
            </span>
        </div>

        <div class="rdv-card-details">
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                <span>Peugeot 308</span>
            </div>
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Ivoire Transmission Abidjan</span>
            </div>
        </div>

        <div class="rdv-card-footer">
            <div class="rdv-price">35 000 F</div>
            <button class="rdv-details-btn" onclick="openModal('modal-vidange')">
                Détails
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Card RDV - À venir --}}
    <div class="rdv-card" data-status="avenir">
        <div class="rdv-card-header">
            <div class="rdv-card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="rdv-card-info">
                <h3 class="rdv-card-title">Diagnostic complet</h3>
                <p class="rdv-card-date">20 Jan 2026 à 10h00</p>
            </div>
            <span class="rdv-badge avenir">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                À venir
            </span>
        </div>

        <div class="rdv-card-details">
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                <span>Toyota Corolla</span>
            </div>
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Ivoire Transmission Abidjan</span>
            </div>
        </div>

        <div class="rdv-card-footer">
            <div class="rdv-price">25 000 F</div>
            <button class="rdv-details-btn" onclick="openModal('modal-diagnostic')">
                Détails
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Card RDV - Terminé --}}
    <div class="rdv-card" data-status="passe">
        <div class="rdv-card-header">
            <div class="rdv-card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="rdv-card-info">
                <h3 class="rdv-card-title">Changement pneus</h3>
                <p class="rdv-card-date">10 Jan 2026 à 09h00</p>
            </div>
            <span class="rdv-badge termine">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Terminé
            </span>
        </div>

        <div class="rdv-card-details">
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                <span>Peugeot 308</span>
            </div>
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Ivoire Transmission Abidjan</span>
            </div>
        </div>

        <div class="rdv-card-footer">
            <div class="rdv-price">120 000 F</div>
            <button class="rdv-details-btn" onclick="openModal('modal-pneus')">
                Détails
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Card RDV - Terminé --}}
    <div class="rdv-card" data-status="passe">
        <div class="rdv-card-header">
            <div class="rdv-card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="rdv-card-info">
                <h3 class="rdv-card-title">Révision générale</h3>
                <p class="rdv-card-date">05 Jan 2026 à 11h30</p>
            </div>
            <span class="rdv-badge termine">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Terminé
            </span>
        </div>

        <div class="rdv-card-details">
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                <span>Honda Civic</span>
            </div>
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Ivoire Transmission Abidjan</span>
            </div>
        </div>

        <div class="rdv-card-footer">
            <div class="rdv-price">85 000 F</div>
            <button class="rdv-details-btn" onclick="openModal('modal-revision')">
                Détails
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Card RDV - Annulé --}}
    <div class="rdv-card" data-status="passe">
        <div class="rdv-card-header">
            <div class="rdv-card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="rdv-card-info">
                <h3 class="rdv-card-title">Climatisation</h3>
                <p class="rdv-card-date">28 Dec 2025 à 15h00</p>
            </div>
            <span class="rdv-badge annule">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Annulé
            </span>
        </div>

        <div class="rdv-card-details">
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                <span>Toyota Corolla</span>
            </div>
            <div class="rdv-detail-item">
                <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Ivoire Transmission Abidjan</span>
            </div>
        </div>

        <div class="rdv-card-footer">
            <div class="rdv-price">45 000 F</div>
            <button class="rdv-details-btn" onclick="openModal('modal-clim')">
                Détails
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

</div>

{{-- Modals --}}
{{-- Modal Vidange moteur --}}
<div class="modal" id="modal-vidange">
    <div class="modal-overlay" onclick="closeModal('modal-vidange')"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Détails du rendez-vous</h2>
            <button class="modal-close" onclick="closeModal('modal-vidange')">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="modal-body">
            <span class="modal-badge avenir">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                À venir
            </span>

            <div class="modal-section no-border">
                <h3 class="modal-section-title">Vidange moteur</h3>
                <div class="modal-info-group">
                    <div class="modal-info-row">
                        <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <div class="modal-label">Date:</div>
                            <div class="modal-value">15 Jan 2026 à 14h30</div>
                        </div>
                    </div>
                    <div class="modal-info-row">
                        <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <div>
                            <div class="modal-label">Prix:</div>
                            <div class="modal-value">35 000 F</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    Véhicule
                </h3>
                <div class="modal-info-group">
                    <div class="modal-info-item">
                        <span class="modal-label">Véhicule:</span>
                        <span class="modal-value">Peugeot 308 (2020)</span>
                    </div>
                    <div class="modal-info-item">
                        <span class="modal-label">Châssis:</span>
                        <span class="modal-value">VF3LCBHZ6JS123456</span>
                    </div>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Lieu
                </h3>
                <div class="modal-info-group">
                    <div class="modal-value" style="margin-bottom: 0.25rem;">Ivoire Transmission Abidjan</div>
                    <div class="modal-label">171 Rue Claude Isaac Dé, Abidjan</div>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Mécanicien
                </h3>
                <div class="modal-info-group">
                    <div class="modal-value" style="margin-bottom: 0.5rem;">Jean-Marc Kouassi</div>
                    <a href="tel:+2250707070707" class="modal-phone">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        +225 07 07 07 07 07
                    </a>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">Options sélectionnées</h3>
                <div class="modal-options">
                    <span class="option-chip">Filtre à huile</span>
                    <span class="option-chip">Vidange complète</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Changement pneus (Terminé) --}}
<div class="modal" id="modal-pneus">
    <div class="modal-overlay" onclick="closeModal('modal-pneus')"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Détails du rendez-vous</h2>
            <button class="modal-close" onclick="closeModal('modal-pneus')">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="modal-body">
            <span class="modal-badge termine">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Terminé
            </span>

            <div class="modal-section no-border">
                <h3 class="modal-section-title">Changement pneus</h3>
                <div class="modal-info-group">
                    <div class="modal-info-row">
                        <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <div class="modal-label">Date:</div>
                            <div class="modal-value">10 Jan 2026 à 09h00</div>
                        </div>
                    </div>
                    <div class="modal-info-row">
                        <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <div>
                            <div class="modal-label">Prix:</div>
                            <div class="modal-value">120 000 F</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    Véhicule
                </h3>
                <div class="modal-info-group">
                    <div class="modal-info-item">
                        <span class="modal-label">Véhicule:</span>
                        <span class="modal-value">Peugeot 308 (2020)</span>
                    </div>
                    <div class="modal-info-item">
                        <span class="modal-label">Châssis:</span>
                        <span class="modal-value">VF3LCBHZ6JS123456</span>
                    </div>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Lieu
                </h3>
                <div class="modal-info-group">
                    <div class="modal-value" style="margin-bottom: 0.25rem;">Ivoire Transmission Abidjan</div>
                    <div class="modal-label">171 Rue Claude Isaac Dé, Abidjan</div>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Mécanicien
                </h3>
                <div class="modal-info-group">
                    <div class="modal-value" style="margin-bottom: 0.5rem;">Konan Yao</div>
                    <a href="tel:+2250707070707" class="modal-phone">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        +225 07 07 07 07 07
                    </a>
                </div>
            </div>

            <div class="modal-section">
                <h3 class="modal-section-title">Options sélectionnées</h3>
                <div class="modal-options">
                    <span class="option-chip">4 pneus Michelin</span>
                </div>
            </div>
        </div>
    </div>
</div>






{{-- Ajoute ça avant le dernier </div> de @endsection dans rdv.blade.php --}}

{{-- Modal Filtre --}}
<div class="filter-modal" id="filterModal">
    <div class="filter-overlay" onclick="closeFilter()"></div>
    <div class="filter-content">
        <div class="filter-header">
            <h2 class="filter-title">Filtrer les rendez-vous</h2>
            <button class="filter-close" onclick="closeFilter()">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="filter-body">
            <div class="filter-group">
                <h3 class="filter-label">Service</h3>
                <button class="filter-chip active" data-group="service">Tous</button>
                <button class="filter-chip" data-group="service">Vidange moteur</button>
                <button class="filter-chip" data-group="service">Diagnostic complet</button>
                <button class="filter-chip" data-group="service">Changement pneus</button>
                <button class="filter-chip" data-group="service">Révision générale</button>
                <button class="filter-chip" data-group="service">Climatisation</button>
            </div>

            <div class="filter-group">
                <h3 class="filter-label">Statut</h3>
                <button class="filter-chip active" data-group="statut">Tous les statuts</button>
                <button class="filter-chip" data-group="statut">À venir</button>
                <button class="filter-chip" data-group="statut">Terminé</button>
                <button class="filter-chip" data-group="statut">Annulé</button>
            </div>
        </div>

        <div class="filter-footer">
            <button class="btn-reset-filter" onclick="resetFilters()">Réinitialiser les filtres</button>
        </div>
    </div>
</div>


@endsection


@push('srcipts')
        
    {{-- Ajoute ce script avant le </script> existant --}}
    <script>
    function openFilter() {
        document.getElementById('filterModal').classList.add('active');
    }

    function closeFilter() {
        document.getElementById('filterModal').classList.remove('active');
    }

    document.getElementById('filterBtn').addEventListener('click', openFilter);

    document.querySelectorAll('.filter-chip').forEach(btn => {
        btn.addEventListener('click', function() {
            const group = this.dataset.group;
            document.querySelectorAll(`[data-group="${group}"]`).forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    function resetFilters() {
        document.querySelectorAll('.filter-chip').forEach(btn => {
            btn.classList.remove('active');
            if(btn.textContent.trim() === 'Tous' || btn.textContent.trim() === 'Tous les statuts') {
                btn.classList.add('active');
            }
        });
    }
    </script>


<script>
// Gestion des tabs
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const tab = this.dataset.tab;
        
        // Remove active class from all tabs
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Filter cards
        const cards = document.querySelectorAll('.rdv-card');
        cards.forEach(card => {
            if (tab === 'tous') {
                card.style.display = 'block';
            } else if (tab === 'avenir') {
                card.style.display = card.dataset.status === 'avenir' ? 'block' : 'none';
            } else if (tab === 'passes') {
                card.style.display = card.dataset.status === 'passe' ? 'block' : 'none';
            }
        });
    });
});

// Gestion des modals
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal.active').forEach(modal => {
            modal.classList.remove('active');
        });
        document.body.style.overflow = '';
    }
});
</script>

@endpush