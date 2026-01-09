<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#4A5C8C">
    <title>GaragePro - Accueil</title>
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/style.css') }}">
</head>
<body>

    {{-- Header --}}
    @include('Frontend.pages.dashboard.partials.header')

    {{-- Main Content --}}
    <main class="pwa-content">

       @yield('content')

    </main>

    {{-- Footer (Bottom Nav) --}}
    @include('Frontend.pages.dashboard.partials.footer')

    

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

    @stack('srcipts')
</body>
</html>
