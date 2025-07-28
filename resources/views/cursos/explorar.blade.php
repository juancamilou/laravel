<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar Cursos</title>
    <link rel="stylesheet" href="{{ asset('css/explorarCursos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<nav>    
    <div class="logo">
        <img src="{{ asset('img/educursos.png') }}" alt="EduCursos">
    </div>    

    @auth
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
    @else
    <ul>
        <li><a href="{{ route('welcome') }}">Iniciar sesión</a></li>
    </ul>
    @endauth
</nav>

<div class="container">
    <h2>Explorar Cursos Disponibles</h2>

    <form class="search" method="GET" action="{{ route('cursos.explorar') }}" role="search">
        <input type="text" name="buscar" placeholder="Buscar cursos por nombre..." value="{{ request('buscar') }}" aria-label="Buscar cursos">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>

    @if($cursos->isEmpty())
        <div class="no-result">No se encontraron cursos.</div>
    @else
        <div class="grid">
            @foreach($cursos as $curso)
                <div class="card">
                    @if ($curso->miniatura)
                        <img src="{{ asset('storage/' . $curso->miniatura) }}" alt="Miniatura del curso">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=Sin+imagen" alt="Sin miniatura">
                    @endif

                    <div class="content">
                        <h4>{{ $curso->nombre }}</h4>
                        <button class="ver-descripcion-btn" onclick="mostrarModal(`{{ addslashes($curso->nombre) }}`, `{{ addslashes($curso->descripcion) }}`)">
                            Leer descripción
                        </button>
                    </div>

                    @auth
                        @php
                            $yaInscrito = in_array($curso->id, $inscritos);
                        @endphp
                        <form action="{{ $yaInscrito ? route('cursos.desinscribirse', $curso->id) : route('cursos.inscribirse', $curso->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="{{ $yaInscrito ? 'btn-desinscribirse' : 'btn-inscribirse' }}">
                                {{ $yaInscrito ? 'Desinscribirme' : 'Inscribirme' }}
                            </button>
                        </form>
                    @else
<a href="{{ route('welcome') }}" class="btn-login-redirect">Inicia sesión para inscribirte</a>
                    @endauth
                </div>
            @endforeach
        </div>
    @endif
</div>

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

<!-- Modal descripción -->
<div id="descripcionModal" class="modal">
    <div class="modal-content">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h3 id="tituloCurso"></h3>
        <p id="descripcionCurso"></p>
    </div>
</div>

<script src="{{ asset('js/explorarCursos.js') }}"></script>
</body>
</html>
