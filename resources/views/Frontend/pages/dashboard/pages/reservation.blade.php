@extends('Frontend.pages.dashboard.layouts.app-paiement')

@section('content')

<div class="reservation-page">
    <h1 class="reservation-page-title">PRENEZ UN RENDEZ-VOUS</h1>

    <div class="stepper-container">
        <div class="stepper-item active" data-step="1">
            <svg class="stepper-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="stepper-label">Rendez-vous</span>
        </div>

        <div class="stepper-line"></div>

        <div class="stepper-item" data-step="2">
            <svg class="stepper-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
            <span class="stepper-label">Véhicule</span>
        </div>

        <div class="stepper-line"></div>

        <div class="stepper-item" data-step="3">
            <svg class="stepper-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <span class="stepper-label">Paiement</span>
        </div>
    </div>

    <!-- Step 1 -->
    <div class="step-content active" id="step1">
        <div class="form-card">
            <h2 class="form-card-title">INFORMATIONS SUR LE RENDEZ-VOUS</h2>
            <p class="form-card-subtitle">Veuillez renseigner les détails de votre rendez-vous.</p>

            <div class="form-group">
                <label class="form-label">
                    <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Situation géographique <span class="required">*</span>
                </label>
                <input type="text" class="form-input" placeholder="riverapalmeraie" value="riverapalmeraie">
            </div>

            <div class="form-group">
                <label class="form-label">J'ai besoin de <span class="required">*</span></label>
                <select class="form-select">
                    <option>Vidange de boîte</option>
                    <option>Vidange moteur</option>
                    <option>Diagnostic complet</option>
                </select>
            </div>

            <div class="besoins-section">
                <label class="form-label">Besoins</label>
                <div class="besoins-row">
                    <label class="besoin-checkbox">
                        <input type="checkbox" checked disabled>
                        <span>Filtre de boîte <span style="color: #6b7280; font-size: 0.8125rem;">(obligatoire)</span></span>
                    </label>
                    <label class="besoin-checkbox">
                        <input type="checkbox">
                        <span>Produits</span>
                    </label>
                </div>
                <div class="besoins-row">
                    <label class="besoin-checkbox">
                        <input type="checkbox">
                        <span>Huile transfect</span>
                    </label>
                    <label class="besoin-checkbox">
                        <input type="checkbox">
                        <span>Scanner électrique</span>
                    </label>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">
                        <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Date du rendez-vous <span class="required">*</span>
                    </label>
                    <input type="date" class="form-input" value="2025-12-31">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Heure du rendez-vous <span class="required">*</span>
                    </label>
                    <input type="time" class="form-input" value="13:00">
                </div>
            </div>

            <div class="price-summary">
                <div class="price-indicator">
                    <span class="price-dot"></span>
                    <span class="price-label">Frais de main d'œuvre</span>
                </div>
                <div class="price-amount">40 000 fcfa</div>
            </div>
        </div>

        <button class="btn-next" onclick="nextStep(2)">
            Suivant
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <!-- Step 2 -->
    <div class="step-content" id="step2">
        <div class="form-card">
            <h2 class="form-card-title">INFORMATIONS SUR LE VÉHICULE</h2>
            <p class="form-card-subtitle">Sélectionnez un véhicule existant ou ajoutez-en un nouveau.</p>

            <div class="vehicle-tabs">
                <button class="vehicle-tab active" data-tab="existing">Véhicule existant</button>
                <button class="vehicle-tab" data-tab="new">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouveau véhicule
                </button>
            </div>

            <div class="tab-content active" id="tab-existing">
                <div class="vehicle-list">
                    <div class="vehicle-card selected">
                        <svg class="vehicle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        <div class="vehicle-info">
                            <div class="vehicle-name">Peugeot 308</div>
                            <div class="vehicle-details">2020 • VF3LCBHZ6JS123456</div>
                        </div>
                    </div>

                    <div class="vehicle-card">
                        <svg class="vehicle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        <div class="vehicle-info">
                            <div class="vehicle-name">Toyota Corolla</div>
                            <div class="vehicle-details">2019 • JTDKN3DU7A0123456</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="tab-new">
                <div class="form-group">
                    <label class="form-label">Numéro de châssis <span class="required">*</span></label>
                    <input type="text" class="form-input" placeholder="Entrer le numéro de châssis">
                </div>

                <div class="form-group">
                    <label class="form-label">Modèle (FACULTATIF)</label>
                    <input type="text" class="form-input" placeholder="Entrer le modèle...">
                </div>

                <div class="form-group">
                    <label class="form-label">Marque (FACULTATIF)</label>
                    <input type="text" class="form-input" placeholder="Entrer la marque...">
                </div>

                <div class="form-group">
                    <label class="form-label">Année (FACULTATIF)</label>
                    <input type="text" class="form-input" placeholder="Entrer l'année">
                </div>

                <div class="form-group">
                    <label class="form-label">Images (FACULTATIF)</label>
                    <div class="file-upload">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <span>Sélect. fichiers</span>
                    </div>
                    <span class="file-upload-hint">Aucun fichier choisi</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Détails supplémentaires</label>
                    <textarea class="form-textarea" placeholder="Plus de détails"></textarea>
                </div>
            </div>
        </div>

        <div class="btn-group">
            <button class="btn-back" onclick="prevStep(1)">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Retour
            </button>
            <button class="btn-next" onclick="nextStep(3)">
                Suivant
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Step 3 -->
    <div class="step-content" id="step3">
        <div class="form-card">
            <h2 class="form-card-title">MÉTHODE DE PAIEMENT</h2>
            <p class="form-card-subtitle">Choisissez votre moyen de paiement préféré.</p>

            <div class="payment-methods">
                <label class="payment-method selected">
                    <input type="radio" name="payment" checked>
                    <div class="payment-content">
                        <div class="payment-title">Mobile Money</div>
                        <div class="payment-subtitle">Orange Money, MTN, Moov</div>
                    </div>
                </label>

                <label class="payment-method">
                    <input type="radio" name="payment">
                    <div class="payment-content">
                        <div class="payment-title">Carte bancaire</div>
                        <div class="payment-subtitle">Visa, Mastercard</div>
                    </div>
                </label>

                <label class="payment-method">
                    <input type="radio" name="payment">
                    <div class="payment-content">
                        <div class="payment-title">Espèces</div>
                        <div class="payment-subtitle">Paiement sur place</div>
                    </div>
                </label>
            </div>

            <div class="recap-section">
                <h3 class="recap-title">Récapitulatif</h3>
                <div class="recap-row">
                    <span class="recap-label">Service</span>
                    <span class="recap-value">Vidange de boîte</span>
                </div>
                <div class="recap-row">
                    <span class="recap-label">Options</span>
                    <span class="recap-value">2 sélectionnée(s)</span>
                </div>
                <div class="recap-row">
                    <span class="recap-label">Date</span>
                    <span class="recap-value">2026-01-13</span>
                </div>
                <div class="recap-total">
                    <span class="recap-total-label">Total</span>
                    <span class="recap-total-value">50 000 fcfa</span>
                </div>
            </div>
        </div>

        <div class="btn-group">
            <button class="btn-back" onclick="prevStep(2)">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Retour
            </button>
            <button class="btn-confirm" onclick="openConfirmModal()">Confirmer</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="confirm-modal" id="confirmModal">
    <div class="confirm-overlay" onclick="closeConfirmModal()"></div>
    <div class="confirm-content">
        <button class="confirm-close" onclick="closeConfirmModal()">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h2 class="confirm-title">Confirmer votre réservation</h2>

        <div class="confirm-success-box">
            <svg class="confirm-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
            <div class="confirm-success-title">Réservation prête!</div>
            <div class="confirm-success-subtitle">Votre rendez-vous sera confirmé après paiement</div>
        </div>

        <div class="confirm-details">
            <div class="confirm-row">
                <span class="confirm-label">Service</span>
                <span class="confirm-value">Vidange de boîte</span>
            </div>
            <div class="confirm-row">
                <span class="confirm-label">Date & Heure</span>
                <span class="confirm-value">2026-01-13 à 12:02</span>
            </div>
            <div class="confirm-row">
                <span class="confirm-label">Paiement</span>
                <span class="confirm-value">Mobile</span>
            </div>
            <div class="confirm-total-row">
                <span class="confirm-total-label">Total à payer</span>
                <span class="confirm-total-amount">50 000 fcfa</span>
            </div>
        </div>

        <button class="btn-payment">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            Procéder au paiement
        </button>
    </div>
</div>

<script>
function nextStep(step) {
    document.querySelectorAll('.step-content').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.stepper-item').forEach(s => s.classList.remove('active', 'completed'));

    document.getElementById('step' + step).classList.add('active');
    document.querySelector(`[data-step="${step}"]`).classList.add('active');

    for(let i = 1; i < step; i++) {
        document.querySelector(`[data-step="${i}"]`).classList.add('completed');
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function prevStep(step) {
    nextStep(step);
}

function openConfirmModal() {
    document.getElementById('confirmModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeConfirmModal() {
    document.getElementById('confirmModal').classList.remove('active');
    document.body.style.overflow = '';
}

document.querySelectorAll('.vehicle-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.vehicle-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

        this.classList.add('active');
        document.getElementById('tab-' + this.dataset.tab).classList.add('active');
    });
});

document.querySelectorAll('.vehicle-card').forEach(card => {
    card.addEventListener('click', function() {
        document.querySelectorAll('.vehicle-card').forEach(c => c.classList.remove('selected'));
        this.classList.add('selected');
    });
});

document.querySelectorAll('.payment-method').forEach(method => {
    method.addEventListener('click', function() {
        document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
        this.classList.add('selected');
    });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeConfirmModal();
    }
});
</script>

@endsection
