<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Explorar Cursos</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            color: #333;
            padding-top: 70px;
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

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 15px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 30px 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form.search {
            display: flex;
            max-width: 400px;
            margin: auto;
            margin-bottom: 30px;
        }

        form.search input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px 0 0 6px;
            font-size: 16px;
        }

        form.search button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
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
            background-color: #28a745;
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
        <li><a href="/dashboard">Inicio</a></li>
        <li><a href="{{ route('cursos.explorar') }}">Explorar Cursos</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:none;border:none;color:white;cursor:pointer;">Cerrar sesión</button>
            </form>
        </li>
    </ul>
</nav>

<div class="container">
    <h2>Explorar Cursos Disponibles</h2>

    <form class="search" method="GET" action="{{ route('cursos.explorar') }}">
        <input type="text" name="buscar" placeholder="Buscar curso..." value="{{ request('buscar') }}">
        <button type="submit">Buscar</button>
    </form>

    @if($cursos->isEmpty())
        <div class="no-result">No se encontraron cursos.</div>
    @else
        <div class="grid">
            @foreach($cursos as $curso)
                <div class="card">
                    @if ($curso->miniatura)
                        <img src="{{ asset('storage/' . $curso->miniatura) }}" alt="Miniatura del curso">
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
</div>

</body>
</html>
