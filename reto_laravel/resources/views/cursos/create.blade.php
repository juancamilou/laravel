<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear curso</title>
    <link rel="stylesheet" href="{{ asset('css/createCurso.css') }}">
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
    <h2>Crear curso</h2>

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
        <input type="text" name="nombre" placeholder="Nombre del curso" required>
        <textarea name="descripcion" placeholder="Descripción del curso" rows="4" required></textarea>
        <input type="file" name="miniatura" accept="image/*">
        <img id="preview" src="#" alt="Vista previa" style="display:none; max-width:200px; margin-top:10px;">


        <button type="submit">Guardar</button>
    </form>
    <a href="{{ route('cursos.index') }}">← Volver</a>
</div>
<script>
    <script>
    document.querySelector('input[name="miniatura"]').addEventListener('change', function (e) {
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

</script>
</body>
</html>
