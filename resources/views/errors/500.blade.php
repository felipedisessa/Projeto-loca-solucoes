<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Erro Interno do Servidor</title>
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
    <h1>500</h1>
    <p>Erro interno do servidor.</p>
    <a href="{{ url('/') }}" style="color: #ffffff;">Voltar para a página inicial</a>
</div>
</body>
</html>
