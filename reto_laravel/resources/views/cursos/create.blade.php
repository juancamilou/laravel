<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear curso</title>
    <link rel="stylesheet" href="../css/create.blade.css">
</head>
<body>
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

        <button type="submit">Guardar</button>
    </form>

    <a href="{{ route('cursos.index') }}">← Volver</a>
</div>
</body>
</html>
