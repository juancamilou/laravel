<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> -->
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
/* nav */
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
/* fin del nav */
.container {
    max-width: 1200px;
    margin: auto;
    padding: 30px 20px;
}

h2,
h3 {
    margin-bottom: 20px;
}

.welcome {
    background: white;
    padding: 25px;
    margin-bottom: 30px;
    border-radius: 12px;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
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
#desincribir {
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
.modal-confirm {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.modal-dialog {
    background: white;
    padding: 25px 30px;
    border-radius: 12px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    animation: slideUp 0.3s ease-out;
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
}

.modal-header i {
    font-size: 28px;
    color: #ffc107;
}

.modal-header h2 {
    margin: 0;
    font-size: 22px;
    color: #333;
}

.modal-body p {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
}

.modal-footer {
    display: flex;
    justify-content: space-between;
}

.cancel-btn,
.confirm-btn {
    padding: 10px 20px;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
}

.cancel-btn {
    background-color: #e0e0e0;
    color: #333;
}

.cancel-btn:hover {
    background-color: #d5d5d5;
}

.confirm-btn {
    background-color: #dc3545;
    color: white;
}

.confirm-btn:hover {
    background-color: #c82333;
}
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

    </style>
</head>
<body>
<nav>    
<div class="logo">
    <img src="{{ asset('img/educursos.png') }}" alt="EduCursos">
</div>    <ul>
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
