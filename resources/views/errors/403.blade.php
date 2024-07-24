<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Ação Não Autorizada</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #111827;
            color: #1a202c;
            font-family: 'Nunito', sans-serif;
        }

        .error-container {
            text-align: center;
            color: #fff;
        }

        .error-container h1 {
            font-size: 3rem;
        }

        .error-container p {
            font-size: 1.25rem;
        }
    </style>
</head>
<body>
<div class="error-container">
    <img src="{{ asset('images/forbidden.png') }}" alt="Forbidden Icon" style="width: 200px; height: 200px;">
    <h1>403</h1>
    <p>Você não tem permissão para acessar esta página.</p>
    <a href="{{ url('/') }}" style="color: #ffffff;">Voltar para a página inicial</a>

</div>
</body>
</html>
