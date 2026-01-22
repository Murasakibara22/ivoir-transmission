@extends('Frontend.pages.dashboard.layouts.app-paiement')

@section('content')

<div class="rdv-page">
    <div class="page-header">
        <div class="page-header-content">
            <div>
                <h1 class="page-title">Mes rendez-vous</h1>
                <p class="page-subtitle">Gérez vos rendez-vous passés et à venir</p>
            </div>
            <button class="filter-btn" onclick="openFilterModal()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="tabs-container">
        <button class="tab-btn active" data-tab="tous">
            Tous <span class="tab-count">(8)</span>
        </button>
        <button class="tab-btn" data-tab="avenir">
            À venir <span class="tab-count">(3)</span>
        </button>
        <button class="tab-btn" data-tab="termine">
            Terminés <span class="tab-count">(4)</span>
        </button>
        <button class="tab-btn" data-tab="annule">
            Annulés <span class="tab-count">(1)</span>
        </button>
    </div>

    <div class="rdv-list">
        
        <div class="rdv-card" onclick="openRdvModal()">
            <div class="rdv-card-header">
                <div class="rdv-card-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="rdv-card-info">
                    <h3 class="rdv-card-title">Vidange moteur</h3>
                    <p class="rdv-card-date">15 Jan 2026 • 10:00</p>
                </div>
                <span class="rdv-badge avenir">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <button class="rdv-details-btn">
                    Détails
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="rdv-card">
            <div class="rdv-card-header">
                <div class="rdv-card-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="rdv-card-info">
                    <h3 class="rdv-card-title">Diagnostic complet</h3>
                    <p class="rdv-card-date">10 Jan 2026 • 09:00</p>
                </div>
                <span class="rdv-badge termine">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <span>Toyota Corolla</span>
                </div>
                <div class="rdv-detail-item">
                    <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Garage Auto Plus Cocody</span>
                </div>
            </div>

            <div class="rdv-card-footer">
                <div class="rdv-price">25 000 F</div>
                <button class="rdv-details-btn">
                    Détails
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="rdv-card">
            <div class="rdv-card-header">
                <div class="rdv-card-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="rdv-card-info">
                    <h3 class="rdv-card-title">Changement pneus</h3>
                    <p class="rdv-card-date">05 Jan 2026 • 14:00</p>
                </div>
                <span class="rdv-badge annule">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <span>Peugeot 308</span>
                </div>
                <div class="rdv-detail-item">
                    <svg class="rdv-detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Mécanique Expert Plateau</span>
                </div>
            </div>

            <div class="rdv-card-footer">
                <div class="rdv-price">120 000 F</div>
                <button class="rdv-details-btn">
                    Détails
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Modal Détails RDV -->
<div class="rdv-modal" id="rdvModal">
    <div class="modal-overlay" onclick="closeRdvModal()"></div>
    <div class="modal-content">
        <button class="modal-close" onclick="closeRdvModal()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h2 class="modal-title">Détails du rendez-vous</h2>

        <span class="modal-badge avenir">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            À venir
        </span>

        <div class="modal-section">
            <h3 class="modal-section-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Informations
            </h3>
            <div class="modal-info-row">
                <div>
                    <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="modal-label">Date & Heure</span>
                </div>
                <div class="modal-value">15 Jan 2026 • 10:00</div>
            </div>
            <div class="modal-info-row">
                <div>
                    <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="modal-label">Service</span>
                </div>
                <div class="modal-value">Vidange moteur</div>
            </div>
            <div class="modal-info-row">
                <div>
                    <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="modal-label">Montant</span>
                </div>
                <div class="modal-value">35 000 F</div>
            </div>
        </div>

        <div class="modal-section">
            <h3 class="modal-section-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                Véhicule
            </h3>
            <div class="modal-info-row">
                <div>
                    <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    <span class="modal-label">Véhicule</span>
                </div>
                <div class="modal-value">Peugeot 308</div>
            </div>
            <div class="modal-info-row">
                <div>
                    <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span class="modal-label">Immatriculation</span>
                </div>
                <div class="modal-value">AB-1234-CI</div>
            </div>
        </div>

        <div class="modal-section">
            <h3 class="modal-section-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Garage
            </h3>
            <div class="modal-info-row">
                <div>
                    <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span class="modal-label">Lieu</span>
                </div>
                <div class="modal-value">Ivoire Transmission Abidjan</div>
            </div>
            <div class="modal-info-row">
                <div>
                    <svg class="modal-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="modal-label">Adresse</span>
                </div>
                <div class="modal-value">171 Rue Claude Isaac Dé, Abidjan</div>
            </div>
            <a href="tel:+2250707070707" class="modal-phone">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                +225 07 07 07 07 07
            </a>
        </div>
    </div>
</div>

<!-- Modal Filtres -->
<div class="filter-modal" id="filterModal">
    <div class="filter-overlay" onclick="closeFilterModal()"></div>
    <div class="filter-content">
        <div class="filter-header">
            <h2 class="filter-title">Filtres</h2>
            <button class="filter-close" onclick="closeFilterModal()">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="filter-body">
            <div class="filter-group">
                <div class="filter-label">Statut</div>
                <button class="filter-chip active">Tous</button>
                <button class="filter-chip">À venir</button>
                <button class="filter-chip">Terminés</button>
                <button class="filter-chip">Annulés</button>
            </div>

            <div class="filter-group">
                <div class="filter-label">Véhicule</div>
                <button class="filter-chip active">Tous les véhicules</button>
                <button class="filter-chip">Peugeot 308</button>
                <button class="filter-chip">Toyota Corolla</button>
            </div>
        </div>

        <div class="filter-footer">
            <button class="btn-reset-filter">Réinitialiser</button>
        </div>
    </div>
</div>

<script>
function openRdvModal() {
    document.getElementById('rdvModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeRdvModal() {
    document.getElementById('rdvModal').classList.remove('active');
    document.body.style.overflow = '';
}

function openFilterModal() {
    document.getElementById('filterModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeFilterModal() {
    document.getElementById('filterModal').classList.remove('active');
    document.body.style.overflow = '';
}

document.querySelectorAll('.tab-btn').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});

document.querySelectorAll('.filter-chip').forEach(chip => {
    chip.addEventListener('click', function() {
        const parent = this.parentElement;
        parent.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
        this.classList.add('active');
    });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRdvModal();
        closeFilterModal();
    }
});
</script>

@endsection