<!DOCTYPE html>
<html>
<head>
    <title>Rapport de prospection</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .date { text-align: right; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rapport de prospection</h1>
    </div>
    
    <div class="date">
        Généré le: {{ date('d/m/Y') }}
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date création</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allPropects as $prospect)
            <tr>
                <td>{{ $prospect->code }}</td>
                <td>{{ $prospect->last_name }}</td>
                <td>{{ $prospect->first_name }}</td>
                <td>{{ $prospect->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>