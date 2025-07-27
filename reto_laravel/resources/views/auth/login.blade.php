<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
    font-family: "Segoe UI", sans-serif;
            background: linear-gradient(to right, #1a1a2e, #16213e);
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-box {
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-box h2 {
            margin-bottom: 25px;
            color: #1a1a2e;
            text-align: center;
            font-weight: 600;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .login-box input:focus {
            border-color: #007bff;
            outline: none;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background-color: #1a1a2e;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .login-box button:hover {
            background-color: #007bff;
        }

        .login-box a {
            display: block;
            text-align: center;
            margin-top: 18px;
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
            transition: color 0.3s;
        }

        .login-box a:hover {
            color: #0056b3;
        }

        .error {
            color: #dc3545;
            margin-bottom: 18px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Iniciar sesión</h2>
        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>

        <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a>
    </div>
</body>
</html>
