<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear curso</title>
    <link rel="stylesheet" href="{{ asset('css/createCurso.css') }}">
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
    <h2>Crear nuevo curso</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cursos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="nombre">Nombre del curso</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="descripcion">Descripción del curso</label>
        <textarea name="descripcion" id="descripcion" rows="4" required></textarea>

        <label for="miniatura">Miniatura del curso</label>
<label for="miniatura" class="custom-file-upload">
    <i class="fas fa-upload"></i> Subir imagen del curso
</label>
<input type="file" name="miniatura" id="miniatura" accept="image/*" style="display: none;">

        <img id="preview" src="#" alt="Vista previa" style="display:none;" />

        <button type="submit">Guardar curso</button>
    </form>

<a href="{{ route('cursos.index') }}" class="btn-volver"><i class="fas fa-arrow-left"></i> Volver</a>
</div>

<script>
document.getElementById('miniatura').addEventListener('change', function (e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
});
</script>

</body>
</html>
