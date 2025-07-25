<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar curso</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f2f5;
            padding: 30px;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .error {
            background-color: #f8d7da;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        img {
            margin-top: 10px;
            max-width: 150px;
        }

        a {
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>
<body>
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
