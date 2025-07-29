<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear curso</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/createCurso.css') }}"> -->
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
    padding-top: 80px;
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

/* FORM CONTAINER */
.form-container {
    max-width: 600px;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.form-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1a1a2e;
}

/* CAMPOS */
input[type="text"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
textarea:focus {
    border-color: #007bff;
    outline: none;
}
.custom-file-upload {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 12px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
    margin-top: 15px;
    transition: background-color 0.3s ease;
    text-align: center;
    width: 100%;
    text-decoration: none;
}

.custom-file-upload i {
    margin-right: 8px;
}

.custom-file-upload:hover {
    background-color: #0056b3;
}

label {
    display: block;
    margin-top: 20px;
    font-weight: bold;
}

/* BOTÓN */
button[type="submit"] {
    display: block;
    width: 100%;
    padding: 12px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    transition: background 0.3s ease;
}

button[type="submit"]:hover {
    background: #218838;
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

/* VISTA PREVIA */
#preview {
    margin-top: 15px;
    max-width: 100%;
    border: 1px solid #ccc;
    border-radius: 6px;
    display: block;
}

/* ERRORES */
.error {
    background-color: #f8d7da;
    padding: 12px;
    border-left: 5px solid #dc3545;
    border-radius: 5px;
    color: #721c24;
    margin-bottom: 20px;
}

.error ul {
    list-style: disc inside;
}

a {
    display: inline-block;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
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
