<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Inscritos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="{{ asset('css/inscritos.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: "Segoe UI", sans-serif;
    background-color: #f4f6f9;
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
    height: 60px;
    width: auto;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
    align-items: center;
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

#cerrar-sesion {
    padding: 8px 14px;
    background: #28a745;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.3s ease;
}

#cerrar-sesion:hover {
    background-color: #218838;
}

.container {
    max-width: 1100px;
    margin: auto;
    padding: 30px 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #1a1a2e;
    font-size: 28px;
}

.tabla-responsive {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    border-radius: 10px;
    overflow: hidden;
}

table th,
table td {
    padding: 14px 18px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
    font-size: 15px;
}

table th {
    background-color: #007bff;
    color: white;
    text-transform: uppercase;
}

table tr:hover {
    background-color: #f1f1f1;
}

.no-data {
    text-align: center;
    color: #777;
    font-size: 16px;
    margin: 20px 0;
}

.btn-volver {
    display: inline-block;
    background-color: #6c757d;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

.btn-volver:hover {
    background-color: #5a6268;
}

.btn-volver i {
    margin-right: 6px;
}
.buscador-form {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 25px;
}

.buscador-form input {
    padding: 10px;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
}

.buscador-form button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
    transition: background-color 0.3s ease;
}

.buscador-form button:hover {
    background-color: #0056b3;
}
.contador-inscritos {
    text-align: center;
    margin-bottom: 20px;
    font-size: 18px;
    font-weight: bold;
    background-color: #e7f1ff;
    border: 1px solid #007bff;
    color: #004085;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
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
            <li><a href="{{ route('cursos.index') }}">Administrar Cursos</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button id="cerrar-sesion" type="submit">Cerrar sesión</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="container">
        <h2><i class="fas fa-users"></i> Usuarios Inscritos</h2>

        <div class="contador-inscritos" id="contadorInscritos">Total inscritos: 0</div>

        <div class="buscador-form">
            <input type="text" id="buscador" placeholder="Buscar por usuario    ...">
        </div>



        @if($inscripciones->isEmpty())
            <div class="no-data">No hay usuarios inscritos actualmente.</div>
        @else
        
            <div class="tabla-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Curso</th>
                            <th>Fecha de inscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($inscripciones as $inscripcion)
                            <tr>
                                        <div id="mensajeNoResultados" class="no-data" style="display: none;">
            No se encontraron resultados para tu búsqueda.
        </div>  
                                <td>{{ $inscripcion->usuario?->name ?? 'Usuario no disponible' }}</td>
                                <td>{{ $inscripcion->usuario?->email ?? 'Sin correo' }}</td>
                                <td>{{ $inscripcion->curso?->nombre ?? 'Curso eliminado' }}</td>
                                <td>{{ $inscripcion->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a href="{{ route('cursos.index') }}" class="btn-volver"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
<script src="{{ asset('js/inscritos.js') }}"></script>
</body>
</html>
