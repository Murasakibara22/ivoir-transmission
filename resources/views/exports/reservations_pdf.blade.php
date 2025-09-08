<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Liste des réservations</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th, td { border: 1px solid #ddd; padding: 4px; word-wrap: break-word; }
        th { background-color: #f2f2f2; text-align: left; }
    </style>
</head>
<body>
    <h2>Liste des réservations</h2>
    <table>
        <thead>
            <tr>
                <th>REF</th>
                <th>Client</th>
                <th>Chassis</th>
                <th>A faire le</th>
                <th>Montant</th>
                <th>Status paiement</th>
                <th>Status</th>
                <th>Adresse</th>
                <th>Commune</th>
                <th>Date creation</th>
                <th>Service</th>
                <th>Prestataire</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation['REF'] }}</td>
                    <td>{{ $reservation['Client'] }}</td>
                    <td>{{ $reservation['Chassis'] }}</td>
                    <td>{{ $reservation['A_faire_le'] }}</td>
                    <td>{{ number_format($reservation['Montant'],0,',','.') }}</td>
                    <td>{{ $reservation['Status_paiement'] }}</td>
                    <td>{{ $reservation['Status'] }}</td>
                    <td>{{ $reservation['Adresse'] }}</td>
                    <td>{{ $reservation['Commune'] }}</td>
                    <td>{{ $reservation['Date_creation'] }}</td>
                    <td>{{ $reservation['Service'] }}</td>
                    <td>{{ $reservation['Prestataire'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
