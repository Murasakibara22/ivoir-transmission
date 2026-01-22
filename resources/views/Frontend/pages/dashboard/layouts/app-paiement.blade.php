<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#4A5C8C">
    <title>GaragePro - Paiements</title>
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/style-paiement.css') }}">
</head>
<body>

    @include('Frontend.pages.dashboard.partials.header-paiement')


    @yield('content')


    @include('Frontend.pages.dashboard.partials.footer-paiement')

     <!-- Ajoute ce script après le script existant -->



    <script>
        // Tabs
        document.querySelectorAll('.payment-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.payment-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                this.classList.add('active');
                document.getElementById('tab-' + this.dataset.tab).classList.add('active');
            });
        });

        // Modal
        function openPaymentModal() {
            document.getElementById('paymentModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePaymentModal();
            }
        });
    </script>

</body>
</html>

