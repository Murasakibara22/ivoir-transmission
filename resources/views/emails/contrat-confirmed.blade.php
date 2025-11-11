<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat Confirmé - Ivoire Transmission</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            line-height: 1.6;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .logo-container {
            position: relative;
            z-index: 2;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: #ffffff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .header h1 {
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            position: relative;
            z-index: 2;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 24px;
            color: #10b981;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .message {
            color: #555555;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .info-box {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            border-left: 5px solid #10b981;
        }

        .info-title {
            font-size: 18px;
            color: #10b981;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .info-item {
            background: #ffffff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-label {
            font-size: 14px;
            color: #888888;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            color: #10b981;
            font-weight: 700;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
            transition: all 0.3s ease;
            text-align: center;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(16, 185, 129, 0.6);
        }

        .alert-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
        }

        .alert-title {
            color: #92400e;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .alert-box p {
            color: #92400e;
            font-size: 14px;
            line-height: 1.6;
        }

        .footer {
            background: #10b981;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        .copyright {
            font-size: 12px;
            opacity: 0.7;
            margin-top: 20px;
        }

        @media only screen and (max-width: 600px) {
            body {
                padding: 20px 10px;
            }

            .content {
                padding: 30px 20px;
            }

            .info-box {
                padding: 20px;
            }

            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Header -->
        <div class="header">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('logo.jpg') }}" style="width: 50px; height: 50px; border-radius: 50%;" alt="Logo">
                </div>
            </div>
            <h1>✅ Nouveau Contrat Confirmé !</h1>
            <p>Une entreprise vient de confirmer son contrat</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                📋 Contrat N° {{ $contrat->id }}
            </div>

            <div class="message">
                L'entreprise <strong>{{ $contrat->entreprise->name }}</strong> vient de confirmer son contrat 
                "<strong>{{ $contrat->libelle }}</strong>". Vous pouvez maintenant procéder à l'activation et à la planification des entretiens.
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <div class="info-title">
                    📊 Détails du contrat
                </div>

                <div class="info-item">
                    <span class="info-label">🏢 Entreprise</span>
                    <span class="info-value">{{ $contrat->entreprise->name }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">📝 Libellé</span>
                    <span class="info-value">{{ $contrat->libelle }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">🚗 Nombre de véhicules</span>
                    <span class="info-value">{{ $contrat->nombre_vehicules }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">💰 Montant entretien</span>
                    <span class="info-value">{{ number_format($contrat->montant_entretien, 0, ',', ' ') }} FCFA</span>
                </div>

                <div class="info-item">
                    <span class="info-label">📅 Date début</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">🔄 Fréquence</span>
                    <span class="info-value">{{ $contrat->frequence_entretien }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">📞 Contact entreprise</span>
                    <span class="info-value">{{ $contrat->entreprise->phone }}</span>
                </div>

                @if($contrat->entreprise_validation_note)
                <div class="info-item" style="display: block;">
                    <span class="info-label">💬 Note de confirmation</span>
                    <p style="margin-top: 10px; color: #555; font-size: 14px; font-style: italic;">
                        "{{ $contrat->entreprise_validation_note }}"
                    </p>
                </div>
                @endif
            </div>

            <!-- CTA Button -->
            <div style="text-align: center;">
                <a href="{{ $dashboardUrl }}" class="cta-button">
                    🚀 Accéder au dashboard
                </a>
            </div>

            <!-- Alert Box -->
            <div class="alert-box">
                <div class="alert-title">⚡ Action requise</div>
                <p>
                    Veuillez vérifier les détails du contrat et planifier le premier entretien dans les plus brefs délais. 
                    L'entreprise attend votre confirmation pour démarrer le service.
                </p>
            </div>

            <div class="message">
                <strong>📧 Contact entreprise :</strong><br>
                Email : {{ $contrat->entreprise->email }}<br>
                Téléphone : {{ $contrat->entreprise->phone }}
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="copyright">
                © {{ date('Y') }} Ivoire Transmission. Tous droits réservés.<br>
                Abidjan, Côte d'Ivoire
            </div>
        </div>
    </div>
</body>
</html>