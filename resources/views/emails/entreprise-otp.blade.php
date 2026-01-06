<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code de vérification</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); padding: 40px 30px; text-align: center;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <div style="width: 70px; height: 70px; background: #ffffff; border-radius: 50%; display: inline-block; margin-bottom: 20px; padding: 17px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="#1e3c72">
                                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <h1 style="color: #ffffff; font-size: 26px; font-weight: 700; margin: 0;">🔐 Code de vérification</h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <div style="font-size: 20px; color: #1e3c72; margin-bottom: 20px; font-weight: 600;">
                                Bonjour <strong>{{ $entreprise->name }}</strong>,
                            </div>

                            <p style="color: #555555; font-size: 16px; margin-bottom: 30px; line-height: 1.8;">
                                Vous avez demandé à vous connecter à votre compte Ivoire Transmission.
                                Pour des raisons de sécurité, veuillez utiliser le code de vérification ci-dessous :
                            </p>

                            <!-- OTP Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                <tr>
                                    <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; padding: 40px; text-align: center;">
                                        <div style="color: rgba(255, 255, 255, 0.8); font-size: 14px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px;">
                                            Votre code de vérification
                                        </div>
                                        <div style="font-size: 48px; font-weight: 700; color: #ffffff; letter-spacing: 10px; font-family: 'Courier New', monospace;">
                                            {{ $otp }}
                                        </div>
                                        <div style="color: rgba(255, 255, 255, 0.9); font-size: 14px; margin-top: 15px;">
                                            ⏱️ Valide pendant 10 minutes
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Warning Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                <tr>
                                    <td style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; border-radius: 10px;">
                                        <p style="color: #856404; font-weight: 600; margin: 0 0 10px 0; font-size: 15px;">
                                            ⚠️ Important - Sécurité
                                        </p>
                                        <p style="color: #856404; font-size: 14px; line-height: 1.6; margin: 0;">
                                            <strong>Si vous n'avez pas demandé ce code</strong>, quelqu'un tente peut-être d'accéder à votre compte.
                                            Dans ce cas, ne partagez pas ce code et contactez immédiatement notre support.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Security Tips -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                <tr>
                                    <td style="background: #f8f9fa; padding: 25px; border-radius: 10px;">
                                        <h4 style="color: #1e3c72; font-size: 16px; margin: 0 0 15px 0;">🛡️ Conseils de sécurité</h4>
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color: #555555; font-size: 14px; padding: 8px 0;">
                                                    <span style="color: #28a745; font-weight: bold; margin-right: 10px;">✓</span>
                                                    Ne partagez jamais ce code avec qui que ce soit
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="color: #555555; font-size: 14px; padding: 8px 0;">
                                                    <span style="color: #28a745; font-weight: bold; margin-right: 10px;">✓</span>
                                                    Notre équipe ne vous demandera jamais ce code
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="color: #555555; font-size: 14px; padding: 8px 0;">
                                                    <span style="color: #28a745; font-weight: bold; margin-right: 10px;">✓</span>
                                                    Ce code expire automatiquement après 10 minutes
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="color: #555555; font-size: 14px; padding: 8px 0;">
                                                    <span style="color: #28a745; font-weight: bold; margin-right: 10px;">✓</span>
                                                    En cas de doute, contactez notre support
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #555555; font-size: 16px; line-height: 1.8; margin: 0;">
                                <strong>Besoin d'aide ?</strong><br>
                                Si vous rencontrez des difficultés pour vous connecter, n'hésitez pas à contacter notre équipe support.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background: #1e3c72; color: #ffffff; padding: 30px; text-align: center;">
                            <p style="font-size: 14px; opacity: 0.8; margin: 10px 0;">📧 support@ivoiretransmission.com</p>
                            <p style="font-size: 14px; opacity: 0.8; margin: 10px 0;">📞 +225 XX XX XX XX XX</p>
                            <div style="font-size: 12px; opacity: 0.6; margin-top: 20px;">
                                © {{ date('Y') }} Ivoire Transmission. Tous droits réservés.<br>
                                Abidjan, Côte d'Ivoire
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
