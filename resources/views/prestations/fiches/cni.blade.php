<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CNI PDF</title>
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
        <img src="data:image/jpeg;base64,{{ $rectoContent }}" alt="CNI Recto">
    </div>
    <div class="page">
        <img src="data:image/jpeg;base64,{{ $versoContent }}" alt="CNI Verso">
    </div>
</body>
</html>
