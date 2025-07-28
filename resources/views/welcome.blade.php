<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #2c3e50, #3498db);
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.05);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 90%;
        }

        .welcome-container h1 {
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        .welcome-container p {
            font-size: 1.1em;
            margin-bottom: 40px;
            color: #e0e0e0;
        }

        .btn-group {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 25px;
            font-size: 1em;
            color: white;
            background-color: #2980b9;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: #1c6691;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Bienvenido a EduCursos</h1>
        <p>Descubre, aprende e inscríbete a cursos personalizados desde un solo lugar.</p>
        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn">Ya tengo cuenta</a>
            <a href="{{ route('register') }}" class="btn">Registrarme</a>
        </div>
    </div>
</body>
</html>
