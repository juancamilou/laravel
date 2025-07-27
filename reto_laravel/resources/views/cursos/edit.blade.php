<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar curso</title>
    <link rel="stylesheet" href="{{ asset('css/editCurso.css') }}">
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
<div class="form-container">
    <h2>Editar curso</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cursos.update', $curso) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="nombre" value="{{ $curso->nombre }}" required>
        <textarea name="descripcion" rows="4" required>{{ $curso->descripcion }}</textarea>

        @if ($curso->miniatura)
            <p>Miniatura actual:</p>
            <img src="{{ asset('storage/' . $curso->miniatura) }}">
        @endif

        <input type="file" name="miniatura" accept="image/*">

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('cursos.index') }}">← Volver</a>
</div>
</body>
</html>
