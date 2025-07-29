<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar Cursos</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/explorarCursos.css') }}"> -->
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

/* ========== nav ========== */
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

/* ========== CONTAINER ========== */
.container {
    max-width: 1200px;
    margin: auto;
    padding: 30px 20px;
}

h2 {
    text-align: center;
    margin-bottom: 30px;
}

/* ========== BUSCADOR MEJORADO ========== */
form.search {
    display: flex;
    max-width: 500px;
    margin: 0 auto 40px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    border: 1px solid #ccc;
}

form.search input {
    flex: 1;
    padding: 12px 15px;
    border: none;
    font-size: 16px;
    outline: none;
}

form.search button {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form.search button:hover {
    background-color: #0056b3;
}

/* ========== TARJETAS ========== */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
}

.card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
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
.btn-login-redirect {
    display: inline-block;
    padding: 10px 20px;
    background-color: #1a1a2e;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 600;
    transition: background-color 0.3s ease;
    text-align: center;
    margin-top: 10px;
}

.btn-login-redirect:hover {
    background-color: #007bff;
    color: #fff;
}

/* ========== BOTÓN VER DESCRIPCIÓN ========== */
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

/* ========== MENSAJE SIN RESULTADOS ========== */
.no-result {
    display: none;
    text-align: center;
    color: #777;
    font-size: 18px;
    margin-top: 30px;
}

.no-result.show {
    display: block;
}

/* ========== MODAL ========== */
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
    max-height: 300px;
    overflow-y: auto;
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

/* ========== FOOTER ========== */
.main-footer {
    background-color: #1a1a2e;
    color: #fff;
    padding: 40px 20px 20px;
    margin-top: 50px;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    justify-content: space-between;
    max-width: 1200px;
    margin: auto;
}

.footer-section {
    flex: 1 1 250px;
}

.footer-section h4 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #ffc107;
}

.footer-section p {
    font-size: 14px;
    margin-bottom: 10px;
    line-height: 1.6;
}

.social-icons a {
    color: #fff;
    font-size: 24px;
    margin-right: 12px;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #ffc107;
}

.footer-bottom {
    text-align: center;
    margin-top: 30px;
    font-size: 14px;
    color: #aaa;
    border-top: 1px solid #333;
    padding-top: 15px;
}

    </style>
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
