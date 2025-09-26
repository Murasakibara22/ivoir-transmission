<!DOCTYPE html>
<html>
<head>
    <title>Paiement {{ $paiement['Reference'] }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; text-align: left; }
    </style>
</head>
<body>
    <h2>Paiement : {{ $paiement['Reference'] }}</h2>

    <table>
        <tr><th>Reference</th><td>{{ $paiement['Reference'] }}</td></tr>
        <tr><th>Client</th><td>{{ $paiement['Client'] }}</td></tr>
        <tr><th>Contact</th><td>{{ $paiement['Contact'] }}</td></tr>
        <tr><th>Montant</th><td>{{ number_format($paiement['Montant'],0,',','.') }} fcfa</td></tr>
        <tr><th>Status paiement</th><td>{{ $paiement['Status paiement'] }}</td></tr>
        <tr><th>Methode</th><td>{{ $paiement['Methode'] }}</td></tr>
        <tr><th>Date paiement</th><td>{{ $paiement['Date paiement'] }}</td></tr>

        <!-- Champs Reservation -->
        <tr><th>Montant reservation</th><td>{{ $paiement['Montant reservation'] }}</td></tr>
        <tr><th>Adresse</th><td>{{ $paiement['Adresse'] }}</td></tr>
        <tr><th>Date début</th><td>{{ $paiement['Date début'] }}</td></tr>
        <tr><th>Date fin</th><td>{{ $paiement['Date fin'] }}</td></tr>
        <tr><th>Chassis</th><td>{{ $paiement['Chassis'] }}</td></tr>
        <tr><th>Service</th><td>{{ $paiement['Service'] }}</td></tr>
        <tr><th>Prestataire</th><td>{{ $paiement['Prestataire'] }}</td></tr>
    </table>
</body>
</html>
