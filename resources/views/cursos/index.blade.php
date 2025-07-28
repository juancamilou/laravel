<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cursos</title>
    <link rel="stylesheet" href="{{ asset('css/indexCurso.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
<nav>    
<div class="logo">
    <img src="{{ asset('img/educursos.png') }}" alt="EduCursos">
</div>
    <ul>
        <li><a href="{{ route('dashboard') }}">Home</a></li>
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

@if(auth()->user()->role === 'admin')
<div class="stats-container">
    <div class="stat-card blue">
        <div class="icon"><i class="fas fa-book-open"></i></div>
        <div>
            <div class="label">Total Cursos</div>
            <div class="value">{{ $totalCursos }}</div>
        </div>
    </div>

<div class="stat-card green" id="card-estudiantes">
    <div class="icon"><i class="fas fa-user-graduate"></i></div>
    <div>
        <div class="label">Total Estudiantes</div>
        <div class="value">{{ $totalEstudiantes }}</div>
    </div>
</div>


    <div class="stat-card yellow chart-card">
        <h4>Inscripciones por curso</h4>
        <canvas id="graficoPastel"></canvas>
    </div>
</div>
@endif



    <div class="top">
        <h2>Gestión de Cursos</h2>
        <a href="{{ route('cursos.create') }}">+ Crear nuevo curso</a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if($cursos->count())
        <div class="cards">
@foreach($cursos as $curso)
    <div class="card">
        @if ($curso->miniatura)
            <img src="{{ asset('storage/' . $curso->miniatura) }}" alt="Miniatura del curso">
        @else
            <img src="https://via.placeholder.com/400x200?text=Sin+imagen" alt="Sin miniatura">
        @endif

        <h4>{{ $curso->nombre }}</h4>

        <button class="ver-descripcion-btn"
                onclick="mostrarModal(`{{ addslashes($curso->nombre) }}`, `{{ addslashes($curso->descripcion) }}`)">
            Leer descripción
        </button>

        <p><strong>Inscritos:</strong> {{ $curso->inscripciones_count }}</p>

        <div class="card-actions">
            <a href="{{ route('cursos.edit', $curso->id) }}">Editar</a>
            <a href="{{ route('cursos.inscritos', $curso->id) }}">Ver inscritos</a>
            <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este curso?')">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </div>
    </div>
@endforeach

        </div>
    @else
        <div class="empty-msg">No hay cursos registrados aún.</div>
    @endif

</div>

<div id="descripcionModal" class="modal">
    <div class="modal-content">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h3 id="tituloCurso"></h3>
        <p id="descripcionCurso"></p>
    </div>
</div>
<div id="modal-estudiantes" class="modal">
    <div class="modal-content estudiantes-modal">
        <span class="cerrar" onclick="cerrarModalEstudiantes()">&times;</span>
        <h3 class="modal-title">Usuarios Registrados</h3>
        <div class="tabla-scroll">
            <table class="tabla-estudiantes">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Registrado</th>
                    </tr>
                </thead>
                <tbody id="lista-estudiantes">
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    const cursoNombres = @json($cursoNombres);
    const cursoInscritos = @json($cursoInscritos);
</script>
<script src="{{ asset('js/indexCurso.js') }}"></script>


</body>
</html>
    