<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>
<body>
<nav>    
<div class="logo">
    <img src="{{ asset('img/educursos.png') }}" alt="EduCursos">
</div>    <ul>
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
        <h2>Hola {{ auth()->user()->name }} </h2>
        <p>Bienvenido a tu panel. Aquí puedes revisar tus cursos o explorar nuevos.</p>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if($cursos->count())
        <h3>Últimos Cursos Disponibles</h3>
        <div class="grid">
            <!-- cursos -->
            @foreach($cursos as $curso)
                <div class="card">
                    @if($curso->miniatura)
                        <img src="{{ asset('storage/' . $curso->miniatura) }}" alt="Miniatura">
                    @endif
                    <div class="content">
                        <h4>{{ $curso->nombre }}</h4>
                        <button class="ver-descripcion-btn" onclick="mostrarModal(`{{ addslashes($curso->nombre) }}`, `{{ addslashes($curso->descripcion) }}`)">Leer descripción
                        </button>
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
                                
                    </div>
                    <form action="{{ route('cursos.desinscribirse', $curso->id) }}" method="POST" onsubmit="event.preventDefault(); openModal(this);">
                        @csrf
                        @method('POST')
                        <button id="desincribir" type="submit">Desinscribirme</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
<!-- footer -->
<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h4>Quiénes somos</h4>
            <p>Somos EduCursos, una plataforma dedicada a brindar educación accesible y de calidad a todos. Nuestra misión es empoderar a los estudiantes con conocimiento.</p>
        </div>
        <div class="footer-section">
            <h4>Contacto</h4>
            <p><i class="fas fa-map-marker-alt"></i> Calle Falsa 123, Bogotá, Colombia</p>
            <p><i class="fas fa-envelope"></i> contacto@educursos.com</p>
            <p><i class="fas fa-phone"></i> +57 301 123 4567</p>
        </div>
        <div class="footer-section">
            <h4>Redes Sociales</h4>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-square"></i></a>
                <a href="#"><i class="fab fa-twitter-square"></i></a>
                <a href="#"><i class="fab fa-instagram-square"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2025 EduCursos. Todos los derechos reservados.
    </div>
</footer>

<!-- modal desincribirse -->
<div id="modal-confirm" class="modal-confirm">
    <div class="modal-dialog">
        <div class="modal-header">
            <i class="fas fa-exclamation-triangle"></i>
            <h2>¿Estás seguro?</h2>
        </div>
        <div class="modal-body">
            <p id="modal-message">Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer">
            <button class="cancel-btn" onclick="closeModal()">Cancelar</button>
            <form id="modal-form" method="POST" style="display: inline;">
                @csrf
                @method('POST')
                <button type="submit" class="confirm-btn">Sí, continuar</button>
            </form>
        </div>
    </div>
</div>
<!-- modal descripcion -->
<div id="descripcionModal" class="modal">
    <div class="modal-content">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h3 id="tituloCurso"></h3>
        <p id="descripcionCurso"></p>
    </div>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>


</body>
</html>
