<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Liste des paiements</title>
    <style>
    body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 4px; word-wrap: break-word; }
    th { background-color: #f2f2f2; text-align: left; font-size: 10px; }

    table { width: 100%; border-collapse: collapse; table-layout: fixed; }
    td, th { overflow-wrap: break-word; }
    </style>


    <style>
    @font-face {
        font-family: 'DejaVu Sans';
        src: url('/fonts/DejaVuSans.ttf') format('truetype');
    }
    body {
        font-family: 'DejaVu Sans', sans-serif;
        font-size: 12px;
    }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 6px; }
    th { background-color: #f2f2f2; text-align: left; }
</style>

</head>
<body>
    <h2>Liste des paiements</h2>

    <table>
        <thead>
            <tr>
                <th>Reference</th>
                <th>Client</th>
                <th>Contact</th>
                <th>Montant</th>
                <th>Status paiement</th>
                <th>Methode</th>
                <th>Date paiement</th>
                <th>Montant reservation</th>
                <th>Adresse</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Chassis</th>
                <th>Service</th>
                <th>Prestataire</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paiements as $paiement)
                <tr>
                    <td>{{ $paiement['Reference'] }}</td>
                    <td>{{ $paiement['Client'] }}</td>
                    <td>{{ $paiement['Contact'] }}</td>
                    <td>{{ number_format($paiement['Montant'],0,',','.') }} fcfa</td>
                    <td>{{ $paiement['Status paiement'] }}</td>
                    <td>{{ $paiement['Methode'] }}</td>
                    <td>{{ $paiement['Date paiement'] }}</td>
                    <td>{{ $paiement['Montant reservation'] }}</td>
                    <td>{{ $paiement['Adresse'] }}</td>
                    <td>{{ $paiement['Date début'] }}</td>
                    <td>{{ $paiement['Date fin'] }}</td>
                    <td>{{ $paiement['Chassis'] }}</td>
                    <td>{{ $paiement['Service'] }}</td>
                    <td>{{ $paiement['Prestataire'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
