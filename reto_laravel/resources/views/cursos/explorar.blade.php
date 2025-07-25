<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Explorar Cursos</title>
    <link rel="stylesheet" href="{{ asset('css/explorarCursos.css') }}">
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
