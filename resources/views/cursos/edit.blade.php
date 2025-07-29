<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar curso</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/editCurso.css') }}"> -->
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

.form-container {
    max-width: 600px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    margin-top: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

input,
textarea {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
}
button[type="submit"] {
    display: block;
    width: 100%;
    padding: 12px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    margin-top: -5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

button[type="submit"]:hover {
    background: #218838;
}

.form-container button {
    margin-top: 20px;
    padding: 12px 25px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.error {
    background-color: #f8d7da;
    padding: 10px;
    margin-top: 10px;
    border-radius: 6px;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

img {
    margin-top: 10px;
    max-width: 150px;
    border-radius: 6px;
}

input[type="file"] {
    display: none;
}

.file-label {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #17a2b8;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.file-label:hover {
    background-color: #138496;
}

.btn-volver {
    display: inline-block;
    margin-top: 20px;
    background-color: #6c757d;
    color: #fff;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.btn-volver i {
    margin-right: 6px;
}

.btn-volver:hover {
    background-color: #5a6268;
}
.file-upload-group {
    margin-top: 15px;
    margin-bottom: 20px;
    display: block;
}
.file-upload-group {
    margin-top: 15px;
    margin-bottom: 20px;
    display: block;
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
