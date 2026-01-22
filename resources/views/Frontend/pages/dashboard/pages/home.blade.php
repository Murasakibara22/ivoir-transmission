@extends('Frontend.pages.dashboard.layouts.app')

@section('content')

 {{-- Welcome Section --}}
        <section class="welcome-section">
            <h1 class="welcome-title">Bonjour, Jean 👋</h1>
            <p class="welcome-subtitle">Bienvenue sur GaragePro</p>
        </section>

        {{-- Carousel --}}
        <div class="carousel-container">
            <div class="carousel">
                <div class="carousel-slides" id="carouselSlides">
                    <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=800');">
                        <h2 class="carousel-title">Entretien auto simplifié</h2>
                        <p class="carousel-subtitle">Réservez en quelques clics</p>
                    </div>
                    <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800');">
                        <h2 class="carousel-title">Expertise automobile</h2>
                        <p class="carousel-subtitle">Des professionnels qualifiés</p>
                    </div>
                    <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1625047509248-ec889cbff17f?w=800');">
                        <h2 class="carousel-title">Tarifs transparents</h2>
                        <p class="carousel-subtitle">Sans surprises</p>
                    </div>
                </div>
            </div>
            <div class="carousel-dots" id="carouselDots">
                <div class="carousel-dot active" data-slide="0"></div>
                <div class="carousel-dot" data-slide="1"></div>
                <div class="carousel-dot" data-slide="2"></div>
            </div>
        </div>

        {{-- Bouton Réserver --}}
        <button class="btn btn-primary btn-block" style="margin-bottom: 1.5rem;">
            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
            Réserver un service
        </button>

        {{-- Statistiques --}}
        {{-- Statistiques --}}
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">
                    <span class="section-accent blue"></span>
                    Mes statistiques
                </h2>
            </div>
            
            <div class="stats-container">
                <div class="stat-card">
                    <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div class="stat-value">3</div>
                    <div class="stat-label">Rdv</div>
                </div>

                <div class="stat-card">
                    <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    <div class="stat-value">125 000 F</div>
                    <div class="stat-label">Payé</div>
                </div>

                <div class="stat-card">
                    <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="stat-value">1</div>
                    <div class="stat-label">En cours</div>
                </div>
            </div>
        </section>

        {{-- Prochain rendez-vous --}}
        {{-- Prochain rendez-vous --}}
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">
                    <span class="section-accent green"></span>
                    Prochain rendez-vous
                </h2>
                <a href="#" class="section-link">
                    Voir tout
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="reservation-card-highlight">
                <div style="display: flex; align-items: start; justify-content: space-between; margin-bottom: 0.875rem;">
                    <h3 class="reservation-main-title">
                        <svg class="reservation-main-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Vidange moteur
                    </h3>
                    <span class="badge badge-success">Confirmé</span>
                </div>

                <div class="reservation-info-row">
                    <svg class="reservation-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Demain - 14h30
                </div>

                <div class="reservation-info-row">
                    <svg class="reservation-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    Peugeot 308
                </div>
            </div>
        </section>

        {{-- Réservations récentes --}}
        {{-- Réservations récentes --}}
            <section class="section">
                <div class="section-header">
                    <h2 class="section-title">
                        <span class="section-accent orange"></span>
                        Réservations récentes
                    </h2>
                </div>

                {{-- Card Diagnostic --}}
                <div class="reservation-card">
                    <div class="reservation-header">
                        <div class="reservation-title-wrapper">
                            <svg class="reservation-icon-circle success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <div>
                                <h3 class="reservation-title-text">Diagnostic</h3>
                                <p class="reservation-date">12/12</p>
                            </div>
                        </div>
                        <span class="badge badge-success">Terminé</span>
                    </div>
                </div>

                {{-- Card Vidange boîte --}}
                <div class="reservation-card">
                    <div class="reservation-header">
                        <div class="reservation-title-wrapper">
                            <svg class="reservation-icon-circle warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="reservation-title-text">Vidange boîte</h3>
                                <p class="reservation-date">15/12</p>
                            </div>
                        </div>
                        <span class="badge badge-warning">En attente</span>
                    </div>
                </div>
            </section>

        {{-- Services populaires --}}
       {{-- Services populaires --}}
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">
                    <span class="section-accent blue"></span>
                    Services populaires
                </h2>
            </div>

            <div class="services-chips">
                <button class="service-chip">Vidange</button>
                <button class="service-chip">Diagnostic</button>
                <button class="service-chip">Pneus</button>
                <button class="service-chip">Freins</button>
            </div>
            <div class="services-chips" style="margin-top: 0.625rem;">
                <button class="service-chip">Climatisation</button>
            </div>
        </section>

        {{-- Besoin d'aide --}}
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">
                    <span class="section-accent blue"></span>
                    Besoin d'aide ?
                </h2>
            </div>

            <div class="contact-card">
                <div class="contact-title">Contactez</div>
                <div class="contact-name">GaragePro Abidjan</div>
                <a href="tel:+2250707070707" class="contact-phone">
                    <svg class="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +225 07 07 07 07 07
                </a>
            </div>
        </section>


@endsection

@push('srcipts')

 <script>
        // Carousel functionality
        const slides = document.getElementById('carouselSlides');
        const dots = document.querySelectorAll('.carousel-dot');
        let currentSlide = 0;
        const totalSlides = 3;

        function showSlide(index) {
            currentSlide = index;
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;

            dots.forEach((dot, i) => {
                if (i === currentSlide) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        // Dots click
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => showSlide(index));
        });

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);

        // Stats cards animation on scroll
        const statsCards = document.querySelectorAll('.stat-card');
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.animation = 'fadeInUp 0.5s ease forwards';
                    }, index * 100);
                }
            });
        }, observerOptions);

        statsCards.forEach(card => observer.observe(card));

        // Reservation cards animation
        const reservationCards = document.querySelectorAll('.reservation-card');
        reservationCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.animation = 'fadeInLeft 0.5s ease forwards';
            }, index * 150);
        });

        // Service chips ripple effect
        const serviceChips = document.querySelectorAll('.service-chip');
        serviceChips.forEach(chip => {
            chip.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                this.appendChild(ripple);

                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                transform: scale(0);
                animation: ripple-animation 0.6s ease-out;
                pointer-events: none;
            }

            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }

            .service-chip {
                position: relative;
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    </script>
@endpush 