<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .register-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .register-box h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .register-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .register-box button {
            width: 100%;
            padding: 12px;
            background-color: #1a1a2e;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .register-box a {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="register-box">
    <h2>Registro</h2>
    @if ($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nombre completo" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>
    <a href="{{ route('login') }}">Ya tengo una cuenta</a>
</div>
</body>
</html>
