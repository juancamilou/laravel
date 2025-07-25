<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #222;
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 22px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 30px;
        }

        .stats {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
        }

        .card {
            background-color: white;
            padding: 30px;
            flex: 1;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0;
            color: #007bff;
        }

        .card span {
            font-size: 40px;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 14px 20px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: #f1f1f1;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .logout {
            background: #dc3545;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .logout:hover {
            background: #c82333;
        }
    </style>
</head>
<body>

<header>
    <h1>Panel Administrativo</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout">Cerrar sesión</button>
    </form>
</header>

<div class="container">
    <div class="stats">
        <div class="card">
            <h3>Total de Cursos</h3>
            <span>{{ $totalCursos }}</span>
        </div>
        <div class="card">
            <h3>Total de Estudiantes</h3>
            <span>{{ $totalEstudiantes }}</span>
        </div>
    </div>

    <h2>Inscripciones por Curso</h2>
    <table>
        <thead>
            <tr>
                <th>Curso</th>
                <th>Descripción</th>
                <th>Inscritos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inscripcionesPorCurso as $curso)
                <tr>
                    <td>{{ $curso->nombre }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($curso->descripcion, 60) }}</td>
                    <td>{{ $curso->estudiantes_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
