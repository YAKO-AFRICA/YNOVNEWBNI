<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pièce justificative</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .page {
            margin-bottom: 20px;
            text-align: center;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="page">
        <img src="data:image/jpeg;base64,{{ $rectoContent }}" alt="Recto">
    </div>
    <div class="page">
        <img src="data:image/jpeg;base64,{{ $versoContent }}" alt="Verso">
    </div>
</body>
</html>
