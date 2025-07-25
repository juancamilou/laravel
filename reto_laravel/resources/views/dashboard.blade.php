<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            padding-top: 70px;
            color: #333;
        }

        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #1a1a2e;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        nav .logo {
            font-weight: bold;
            font-size: 22px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav ul li a, nav ul li form button {
            text-decoration: none;
            color: #fff;
            font-size: 15px;
            background: none;
            border: none;
            cursor: pointer;
        }

        nav ul li a:hover,
        nav ul li form button:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 30px 20px;
        }

        h2, h3 {
            margin-bottom: 20px;
        }

        .welcome {
            background: white;
            padding: 25px;
            margin-bottom: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card .content {
            padding: 15px;
            flex-grow: 1;
        }

        .card h4 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .card .descripcion {
            font-size: 14px;
            color: #666;
            max-height: 60px;
            overflow: hidden;
            position: relative;
        }

        .card .descripcion:hover::after {
            content: attr(data-full);
            position: absolute;
            background: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            top: 0;
            left: 0;
            z-index: 1;
            width: 100%;
            max-height: 150px;
            overflow-y: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .card form {
            padding: 10px 15px 15px;
        }

        .card form button {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .no-result {
            text-align: center;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">Mi Plataforma</div>
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('cursos.explorar') }}">Explorar</a></li>
        @if(auth()->user()->role === 'admin')
            <li><a href="{{ route('cursos.index') }}">Administrar Cursos</a></li>
        @endif
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </li>
    </ul>
</nav>

<div class="container">

    <div class="welcome">
        <h2>Hola {{ auth()->user()->name }} ({{ auth()->user()->role }})</h2>
        <p>Bienvenido a tu panel. Aquí puedes revisar tus cursos o explorar nuevos.</p>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if($cursos->count())
        <h3>Últimos Cursos Disponibles</h3>
        <div class="grid">
            @foreach($cursos as $curso)
                <div class="card">
                    @if($curso->miniatura)
                        <img src="{{ asset('storage/' . $curso->miniatura) }}" alt="Miniatura">
                    @endif
                    <div class="content">
                        <h4>{{ $curso->nombre }}</h4>
                        <div class="descripcion" data-full="{{ $curso->descripcion }}">
                            {{ \Illuminate\Support\Str::limit($curso->descripcion, 80) }}
                        </div>
                    </div>
                    <form action="{{ route('cursos.inscribirse', $curso->id) }}" method="POST">
                        @csrf
                        <button type="submit">Inscribirme</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    @if($inscritos->count())
        <h3 style="margin-top:40px;">Mis Cursos Inscritos</h3>
        <div class="grid">
            @foreach($inscritos as $curso)
                <div class="card">
                    @if($curso->miniatura)
                        <img src="{{ asset('storage/' . $curso->miniatura) }}" alt="Miniatura">
                    @endif
                    <div class="content">
                        <h4>{{ $curso->nombre }}</h4>
                        <div class="descripcion" data-full="{{ $curso->descripcion }}">
                            {{ \Illuminate\Support\Str::limit($curso->descripcion, 80) }}
                        </div>
                    </div>
                    <form action="{{ route('cursos.desinscribirse', $curso->id) }}" method="POST">
                        @csrf
                        <button type="submit">Desinscribirme</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

</div>
</body>
</html>
