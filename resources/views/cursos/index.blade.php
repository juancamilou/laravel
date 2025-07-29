<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cursos</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/indexCurso.css') }}"> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
body {
    font-family: "Segoe UI", sans-serif;
    background: #f0f2f5;
    padding-top: 70px;
    color: #333;
}

nav {
    position: fixed;
    top: 0;
    width: 100%;
    height: 80px;
    background-color: #1a1a2e;
    color: white;
    padding: 0 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1000;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

nav .logo {
    display: flex;
    align-items: center;
    font-weight: bold;
    font-size: 20px;
    position: relative;
}

nav .logo img {
    height: 150px;
    width: auto;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
}

nav ul li a,
nav ul li form button {
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
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

.card-actions {
    margin-top: 15px;
}

.card-actions a,
.card-actions form button {
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
.stats-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
    margin-bottom: 30px;
}

.stat-card {
    flex: 1;
    min-width: 280px;
    background: #fff;
    border-left: 5px solid;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat-card.chart-card {
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.stat-card.chart-card canvas {
    max-width: 220px;
    height: auto;
}

.stat-card .icon {
    font-size: 32px;
}

.stat-card .label {
    font-size: 14px;
    color: #888;
}

.stat-card .value {
    font-size: 24px;
    font-weight: bold;
}

/* Colores por tipo */
.stat-card.blue {
    border-color: #007bff;
}

.stat-card.blue .icon {
    color: #007bff;
}

.stat-card.green {
    border-color: #28a745;
}

.stat-card.green .icon {
    color: #28a745;
}

.stat-card.yellow {
    border-color: #ffc107;
}

.stat-card.yellow .icon {
    color: #ffc107;
}

.ver-descripcion-btn {
    background-color: #6f42c1;
    color: white;
    border: none;
    padding: 8px 12px;
    margin-top: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 600px;
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: pre-wrap;
}

.cerrar {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 22px;
    cursor: pointer;
    color: #aaa;
}

.cerrar:hover {
    color: #000;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
#descripcionCurso {
    margin-top: 10px;
    font-size: 16px;
    color: #333;
    line-height: 1.4;
    max-height: 300px; /* Altura máxima visible */
    overflow-y: auto; /* Scroll solo si es necesario */
    padding-right: 10px;
    word-wrap: break-word;
    white-space: pre-wrap;
}
#descripcionCurso::-webkit-scrollbar {
    width: 8px;
}

#descripcionCurso::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

#descripcionCurso::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

#descripcionCurso::-webkit-scrollbar-thumb:hover {
    background: #555;
}
.estudiantes-modal {
    max-width: 800px;
    max-height: 80vh;
    overflow: hidden;
}

.modal-title {
    margin-bottom: -50px;
    font-size: 22px;
    text-align: center;
    color: #1a1a2e;
}

.tabla-scroll {
    overflow-y: auto;
    max-height: 400px;
}

.tabla-estudiantes {
    width: 100%;
    border-collapse: collapse;
}

.tabla-estudiantes thead {
    background-color: #1a1a2e;
    color: white;
}

.tabla-estudiantes th,
.tabla-estudiantes td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}

.tabla-estudiantes td {
    color: #333;
}

</style>
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
    