<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar curso</title>
    <link rel="stylesheet" href="{{ asset('css/editCurso.css') }}">
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
    <img src="{{ asset('storage/' . $curso->miniatura) }}" id="previewActual">
@endif

<div class="file-upload-group">
    <label for="miniatura" class="file-label"><i class="fas fa-upload"></i> Subir nueva miniatura</label>
    <input type="file" name="miniatura" id="miniatura" accept="image/*">
</div>

<button type="submit">Actualizar</button>


    </form>

    <a href="{{ route('cursos.index') }}" class="btn-volver"><i class="fas fa-arrow-left"></i> Volver</a>
</div>

<script>
    document.getElementById('miniatura').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewActual');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>
