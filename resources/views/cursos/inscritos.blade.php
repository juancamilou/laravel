<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Inscritos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/inscritos.css') }}">
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
