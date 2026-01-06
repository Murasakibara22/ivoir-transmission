/**
 * Dashboard JavaScript - Ivoire Transmission
 * Gestion des interactions et fonctionnalités modernes
 */

class DashboardApp {
    constructor() {
        this.init();
        this.bindEvents();
        this.checkMobileDevice();
        this.initPWA();
    }

    init() {
        console.log('Dashboard App initialized');
        this.loadingStates = new Map();
        this.notifications = [];
        this.currentTheme = 'dark'; // Par défaut dark theme

        // Configuration des observateurs
        this.setupIntersectionObserver();
        this.setupResizeObserver();
    }

    // ========================================
    // EVENT LISTENERS
    // ========================================

    bindEvents() {
        // Navigation mobile
        this.setupMobileNavigation();

        // Cards véhicules
        this.setupVehicleCards();

        // Modals et overlays
        this.setupModals();

        // Formulaires
        this.setupForms();

        // Recherche et filtres
        this.setupSearch();

        // Notifications
        this.setupNotifications();
    }
    
setupMobileNavigation() {
    const mobileNavItems = document.querySelectorAll('.mobile-nav-item');

    mobileNavItems.forEach(item => {
        item.addEventListener('click', (e) => {
            // NE PAS empêcher le comportement par défaut - laisser le lien naviguer
            
            // Retirer active de tous les items
            mobileNavItems.forEach(nav => nav.classList.remove('active'));

            // Ajouter active à l'item cliqué
            item.classList.add('active');

            // Haptic feedback sur mobile
            if (navigator.vibrate) {
                navigator.vibrate(50);
            }

            // Le lien href va gérer la navigation naturellement
        });
    });
}

    setupVehicleCards() {
        const vehicleCards = document.querySelectorAll('.card-vehicle');

        vehicleCards.forEach(card => {
            // Effet hover amélioré
            card.addEventListener('mouseenter', () => {
                this.animateCardHover(card, true);
            });

            card.addEventListener('mouseleave', () => {
                this.animateCardHover(card, false);
            });

            // Click pour voir détails
            card.addEventListener('click', (e) => {
                if (!e.target.closest('.btn')) {
                    this.showVehicleDetails(card.dataset.vehicleId);
                }
            });

            // Swipe gestures sur mobile
            if (this.isMobile()) {
                this.setupSwipeGestures(card);
            }
        });
    }

    setupModals() {
        // Fermeture des modals avec Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeAllModals();
            }
        });

        // Fermeture en cliquant à l'extérieur
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal-backdrop')) {
                this.closeModal(e.target.closest('.modal'));
            }
        });
    }

    setupForms() {
        const forms = document.querySelectorAll('form[data-dashboard-form]');

        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleFormSubmit(form);
            });

            // Validation en temps réel
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', () => {
                    this.validateField(input);
                });
            });
        });
    }

    setupSearch() {
        const searchInputs = document.querySelectorAll('[data-search]');

        searchInputs.forEach(input => {
            let timeout;

            input.addEventListener('input', (e) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    this.performSearch(e.target.value, e.target.dataset.search);
                }, 300);
            });
        });
    }

    setupNotifications() {
        // Vérifier les permissions de notification
        if ('Notification' in window) {
            if (Notification.permission === 'default') {
                this.requestNotificationPermission();
            }
        }

        // Système de notifications in-app
        this.createNotificationContainer();
    }

    // ========================================
    // VEHICLE MANAGEMENT
    // ========================================

    showVehicleDetails(vehicleId) {
        this.showLoading('Loading vehicle details...');

        // Simuler un appel API
        setTimeout(() => {
            this.hideLoading();
            this.openVehicleModal(vehicleId);
        }, 800);
    }

    openVehicleModal(vehicleId) {
        const modal = this.createModal('vehicle-details', {
            title: 'Détails du véhicule',
            size: 'large',
            content: this.generateVehicleModalContent(vehicleId)
        });

        // Ajouter les événements spécifiques au modal véhicule
        this.setupVehicleModalEvents(modal);
    }

    generateVehicleModalContent(vehicleId) {
        return `
            <div class="vehicle-modal-content">
                <div class="vehicle-images">
                    <div class="main-image">
                        <img src="/assets/images/vehicles/vehicle-${vehicleId}.jpg" alt="Vehicle">
                        <div class="image-controls">
                            <button class="btn btn-secondary btn-sm" data-action="360-view">
                                Vue 360°
                            </button>
                        </div>
                    </div>
                    <div class="thumbnail-gallery">
                        <!-- Thumbnails générées dynamiquement -->
                    </div>
                </div>

                <div class="vehicle-info">
                    <div class="info-section">
                        <h3>Informations générales</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Immatriculation</label>
                                <span>AB-123-CD</span>
                            </div>
                            <div class="info-item">
                                <label>Kilométrage</label>
                                <span>45,000 km</span>
                            </div>
                        </div>
                    </div>

                    <div class="maintenance-section">
                        <h3>Maintenance</h3>
                        <div class="maintenance-timeline">
                            <!-- Timeline générée dynamiquement -->
                        </div>

                        <div class="quick-actions">
                            <button class="btn btn-primary" data-action="book-maintenance">
                                Réserver maintenance
                            </button>
                            <button class="btn btn-secondary" data-action="view-history">
                                Voir historique
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // ========================================
    // ANIMATIONS & EFFECTS
    // ========================================

    animateCardHover(card, isHover) {
        const image = card.querySelector('.vehicle-image');
        const details = card.querySelector('.vehicle-details');

        if (isHover) {
            card.style.transform = 'translateY(-8px) scale(1.02)';
            if (image) {
                image.style.transform = 'scale(1.1)';
            }
            if (details) {
                details.style.transform = 'translateY(-4px)';
            }
        } else {
            card.style.transform = 'translateY(0) scale(1)';
            if (image) {
                image.style.transform = 'scale(1)';
            }
            if (details) {
                details.style.transform = 'translateY(0)';
            }
        }
    }

    switchDashboardView(viewName) {
        const views = document.querySelectorAll('[data-dashboard-view]');

        // Masquer toutes les vues avec animation
        views.forEach(view => {
            view.style.opacity = '0';
            view.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                view.style.display = 'none';
            }, 300);
        });

        // Afficher la vue sélectionnée
        setTimeout(() => {
            const targetView = document.querySelector(`[data-dashboard-view="${viewName}"]`);
            if (targetView) {
                targetView.style.display = 'block';
                setTimeout(() => {
                    targetView.style.opacity = '1';
                    targetView.style.transform = 'translateX(0)';
                }, 50);
            }
        }, 300);
    }

    // ========================================
    // LOADING & FEEDBACK
    // ========================================

    showLoading(message = 'Chargement...') {
        const loader = document.createElement('div');
        loader.className = 'loading-overlay';
        loader.innerHTML = `
            <div class="loading-content">
                <div class="loader"></div>
                <p>${message}</p>
            </div>
        `;

        document.body.appendChild(loader);

        // Animation d'apparition
        setTimeout(() => {
            loader.classList.add('show');
        }, 10);
    }

    hideLoading() {
        const loader = document.querySelector('.loading-overlay');
        if (loader) {
            loader.classList.remove('show');
            setTimeout(() => {
                loader.remove();
            }, 300);
        }
    }

    showNotification(message, type = 'info', duration = 5000) {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;

        const container = document.querySelector('.notification-container');
        container.appendChild(notification);

        // Animation d'apparition
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Fermeture automatique
        setTimeout(() => {
            this.removeNotification(notification);
        }, duration);

        // Fermeture manuelle
        notification.querySelector('.notification-close').addEventListener('click', () => {
            this.removeNotification(notification);
        });
    }

    // ========================================
    // UTILITIES
    // ========================================

    isMobile() {
        return window.innerWidth <= 768 || /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    checkMobileDevice() {
        if (this.isMobile()) {
            document.body.classList.add('is-mobile');

            // Optimisations mobile
            this.optimizeForMobile();
        }
    }

    optimizeForMobile() {
        // Désactiver les hover effects sur mobile
        const hoverElements = document.querySelectorAll('[data-hover]');
        hoverElements.forEach(el => {
            el.classList.add('no-hover');
        });

        // Ajuster la viewport height pour mobile
        this.setMobileVH();
        window.addEventListener('resize', this.setMobileVH);
    }

    setMobileVH() {
        const vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
    }

    setupIntersectionObserver() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeIn');
                }
            });
        }, { threshold: 0.1 });

        // Observer les cards pour l'animation au scroll
        document.querySelectorAll('.card').forEach(card => {
            observer.observe(card);
        });
    }

    setupResizeObserver() {
        if ('ResizeObserver' in window) {
            const resizeObserver = new ResizeObserver(entries => {
                // Réajuster les layouts responsives
                this.handleResize();
            });

            resizeObserver.observe(document.body);
        }
    }

    handleResize() {
        // Logique de redimensionnement
        if (this.isMobile()) {
            this.setMobileVH();
        }
    }

    // ========================================
    // PWA FUNCTIONALITY
    // ========================================

    initPWA() {
        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            this.showInstallButton();
        });

        window.addEventListener('appinstalled', () => {
            this.showNotification('Application installée avec succès!', 'success');
        });
    }

    showInstallButton() {
        const installBtn = document.querySelector('#install-app');
        if (installBtn) {
            installBtn.style.display = 'block';
            installBtn.addEventListener('click', this.installApp);
        }
    }

    async installApp() {
        if (this.deferredPrompt) {
            this.deferredPrompt.prompt();
            const { outcome } = await this.deferredPrompt.userChoice;

            if (outcome === 'accepted') {
                this.showNotification('Installation en cours...', 'info');
            }

            this.deferredPrompt = null;
        }
    }

    // ========================================
    // INITIALIZATION
    // ========================================

    createNotificationContainer() {
        if (!document.querySelector('.notification-container')) {
            const container = document.createElement('div');
            container.className = 'notification-container';
            document.body.appendChild(container);
        }
    }

    createModal(id, options = {}) {
        const modal = document.createElement('div');
        modal.className = `modal ${options.size ? `modal-${options.size}` : ''}`;
        modal.id = id;
        modal.innerHTML = `
            <div class="modal-backdrop"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <h3>${options.title || 'Modal'}</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    ${options.content || ''}
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Animation d'ouverture
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);

        return modal;
    }

    closeModal(modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.remove();
        }, 300);
    }

    closeAllModals() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => this.closeModal(modal));
    }

    removeNotification(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }
}

// ========================================
// GLOBAL FUNCTIONS
// ========================================

// Fonction utilitaire pour formater les dates
function formatDate(date, format = 'fr') {
    const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };

    return new Date(date).toLocaleDateString(format === 'fr' ? 'fr-FR' : 'en-US', options);
}

// Fonction utilitaire pour formater les nombres
function formatNumber(number, locale = 'fr-FR') {
    return new Intl.NumberFormat(locale).format(number);
}

// Fonction utilitaire pour debounce
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ========================================
// INITIALIZATION
// ========================================

// Initialiser l'application quand le DOM est prêt
document.addEventListener('DOMContentLoaded', () => {
    window.dashboardApp = new DashboardApp();
});

// Export pour les modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = DashboardApp;
}
