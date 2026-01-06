<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue chez Ivoire Transmission</title>
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
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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

        .logo svg {
            width: 45px;
            height: 45px;
            fill: #1e3c72;
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
            color: #1e3c72;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .message {
            color: #555555;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .credentials-box {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            border-left: 5px solid #1e3c72;
        }

        .credentials-title {
            font-size: 18px;
            color: #1e3c72;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .credentials-title svg {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            fill: #1e3c72;
        }

        .credential-item {
            background: #ffffff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .credential-label {
            font-size: 12px;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .credential-value {
            font-size: 18px;
            color: #1e3c72;
            font-weight: 700;
            font-family: 'Courier New', monospace;
            word-break: break-all;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            text-align: center;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }

        .security-notice {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
        }

        .security-notice-title {
            color: #856404;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .security-notice-title svg {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            fill: #ffc107;
        }

        .security-notice p {
            color: #856404;
            font-size: 14px;
            line-height: 1.6;
        }

        .features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 30px 0;
        }

        .feature-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: #1e3c72;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .feature-icon svg {
            width: 20px;
            height: 20px;
            fill: #ffffff;
        }

        .feature-title {
            font-size: 14px;
            color: #1e3c72;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .feature-desc {
            font-size: 12px;
            color: #666666;
        }

        .footer {
            background: #1e3c72;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        .footer-links {
            margin: 20px 0;
        }

        .footer-link {
            color: #ffffff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 14px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .footer-link:hover {
            opacity: 1;
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin: 0 5px;
            line-height: 40px;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
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

            .credentials-box {
                padding: 20px;
            }

            .features {
                grid-template-columns: 1fr;
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
                    <img src="{{ asset('logo.jpg') }}" class="" alt="">
                </div>
            </div>
            <h1>🎉 Bienvenue chez Ivoire Transmission !</h1>
            <p>Votre partenaire de confiance pour la gestion de flotte automobile</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Bonjour <strong>{{ $entreprise->name }}</strong> !
            </div>

            <div class="message">
                Nous sommes ravis de vous accueillir sur notre plateforme de gestion de maintenance automobile.
                Votre compte entreprise a été créé avec succès et vous pouvez dès maintenant accéder à tous nos services professionnels.
            </div>

            <!-- Credentials Box -->
            <div class="credentials-box">
                <div class="credentials-title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                    </svg>
                    Vos identifiants de connexion
                </div>

                <div class="credential-item">
                    <div class="credential-label">📧 Adresse Email</div>
                    <div class="credential-value">{{ $entreprise->email }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">🔐 Mot de passe temporaire</div>
                    <div class="credential-value">{{ $password }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">📱 Téléphone</div>
                    <div class="credential-value">{{ $entreprise->phone }}</div>
                </div>
            </div>

            <!-- CTA Button -->
            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="cta-button">
                    🚀 Accéder à mon espace entreprise
                </a>
            </div>

            <!-- Security Notice -->
            <div class="security-notice">
                <div class="security-notice-title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                    </svg>
                    Recommandation de sécurité
                </div>
                <p>
                    Pour votre sécurité, nous vous recommandons fortement de <strong>modifier votre mot de passe</strong>
                    dès votre première connexion. Accédez à votre profil puis à la section "Sécurité" pour effectuer cette modification.
                </p>
            </div>

            <!-- Features -->
            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </div>
                    <div class="feature-title">Gestion de flotte</div>
                    <div class="feature-desc">Suivez tous vos véhicules en temps réel</div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="feature-title">Planning entretiens</div>
                    <div class="feature-desc">Planifiez et suivez vos maintenances</div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div class="feature-title">Rapports détaillés</div>
                    <div class="feature-desc">Analyses et statistiques complètes</div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="feature-title">Gestion budgets</div>
                    <div class="feature-desc">Contrôlez vos dépenses facilement</div>
                </div>
            </div>

            <div class="message">
                <strong>Besoin d'aide ?</strong><br>
                Notre équipe support est disponible pour vous accompagner dans la prise en main de la plateforme.
                N'hésitez pas à nous contacter si vous avez des questions.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-links">
                <a href="{{ url('/') }}" class="footer-link">🏠 Accueil</a>
                <a href="{{ url('/comment-ca-marche') }}" class="footer-link">📖 Guide</a>
                <a href="{{ url('/contactez-nous') }}" class="footer-link">📞 Contact</a>
            </div>

            <div class="social-icons">
                <a href="#" class="social-icon">f</a>
                <a href="#" class="social-icon">in</a>
                <a href="#" class="social-icon">tw</a>
            </div>

            <div class="copyright">
                © {{ date('Y') }} Ivoire Transmission. Tous droits réservés.<br>
                Abidjan, Côte d'Ivoire
            </div>
        </div>
    </div>
</body>
</html>
