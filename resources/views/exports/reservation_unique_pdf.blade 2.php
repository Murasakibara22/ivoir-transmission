<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Reservation {{ $reservation['REF'] }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background-color: #f2f2f2; text-align: left; }
    </style>
</head>
<body>
    <h2>Reservation : {{ $reservation['REF'] }}</h2>
    <table>
        @foreach($reservation as $key => $value)
            <tr>
                <th>{{ $key }}</th>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
