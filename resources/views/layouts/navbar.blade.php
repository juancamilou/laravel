<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="/dashboard">Mi Plataforma</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @auth
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">Inicio</a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cursos.index') }}">Administrar Cursos</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cursos.explorar') }}">Explorar Cursos</a>
                </li>
            @endif
        @endauth
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth
            <li class="nav-item">
                <span class="navbar-text text-light me-3">{{ auth()->user()->name }}</span>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                </form>
            </li>
        @else
            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a></li>
            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrarse</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
