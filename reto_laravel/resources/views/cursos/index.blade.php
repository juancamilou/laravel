<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cursos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding-top: 80px;
        }

        /* Barra de navegación */
        header {
            background-color: #343a40;
            color: white;
            padding: 15px 30px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-left h1 {
            font-size: 20px;
            margin: 0;
        }

        .nav-right {
            display: flex;
            align-items: center;
        }

        .nav-right a, .nav-right form button {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .nav-right form {
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top h2 {
            margin: 0;
        }

        .top a {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
        }

        .alert {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 25px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .card h4 {
            margin: 0;
            font-size: 20px;
        }

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 240px;
            background-color: #333;
            color: #fff;
            text-align: left;
            border-radius: 6px;
            padding: 10px;
            position: absolute;
            z-index: 1;
            bottom: 110%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        .card-actions {
            margin-top: 15px;
        }

        .card-actions a, .card-actions form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 14px;
            margin-right: 6px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .card-actions form {
            display: inline;
        }

        .card-actions form button {
            background-color: #dc3545;
        }

        .empty-msg {
            text-align: center;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>

<header>
    <div class="nav-left">
        <h1>Cursos Laravel</h1>
    </div>
    <div class="nav-right">
        <a href="/dashboard">Inicio</a>
        <a href="{{ route('cursos.index') }}">Cursos</a>
        <span style="color: #ccc;">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>
</header>

<div class="container">
    <div class="top">
        <h2>Listado de Cursos</h2>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('cursos.create') }}">+ Crear nuevo</a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if ($cursos->isEmpty())
        <div class="empty-msg">No hay cursos disponibles.</div>
    @else
        <div class="cards">
            @foreach ($cursos as $curso)
                <div class="card">
                    @if ($curso->miniatura)
                        <img src="{{ asset('storage/' . $curso->miniatura) }}" alt="Miniatura del curso">
                    @endif
                    <h4 class="tooltip">
                        {{ $curso->nombre }}
                        <span class="tooltip-text">{{ $curso->descripcion }}</span>
                    </h4>

                    @if(auth()->user()->role === 'admin')
                        <div class="card-actions">
                            <a href="{{ route('cursos.edit', $curso) }}">Editar</a>
                            <form action="{{ route('cursos.destroy', $curso) }}" method="POST" onsubmit="return confirm('¿Eliminar este curso?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>
