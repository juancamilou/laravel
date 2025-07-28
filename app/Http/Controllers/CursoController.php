<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Inscripcion;
use App\Models\User;



class CursoController extends Controller
{
public function index()
{
    $cursos = Curso::withCount('inscripciones')->get();
    $totalCursos = $cursos->count();
    $totalEstudiantes = User::where('role', 'student')->count();

    // Preparar datos para el gráfico
    $cursoNombres = $cursos->pluck('nombre');
    $cursoInscritos = $cursos->pluck('inscripciones_count');

    return view('cursos.index', compact('cursos', 'totalCursos', 'totalEstudiantes', 'cursoNombres', 'cursoInscritos'));
}


    // Mostrar formulario para crear curso
    public function create()
    {
        return view('cursos.create');
    }

    // Guardar nuevo curso
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'miniatura' => 'nullable|image',
        ]);

        $ruta = null;
        if ($request->hasFile('miniatura')) {
            $ruta = $request->file('miniatura')->store('miniaturas', 'public');
        }

        Curso::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'miniatura' => $ruta,
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso creado correctamente.');
    }

    // Mostrar un curso específico (opcional)
    public function show(Curso $curso)
    {
        return view('cursos.show', compact('curso'));
    }

    // Formulario para editar curso
    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    // Actualizar curso
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'miniatura' => 'nullable|image',
        ]);

        $ruta = $curso->miniatura;

        if ($request->hasFile('miniatura')) {
            if ($ruta) {
                Storage::disk('public')->delete($ruta);
            }
            $ruta = $request->file('miniatura')->store('miniaturas', 'public');
        }

        $curso->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'miniatura' => $ruta,
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso actualizado.');
    }

    // Eliminar curso
    public function destroy(Curso $curso)
    {
        if ($curso->miniatura) {
            Storage::disk('public')->delete($curso->miniatura);
        }

        $curso->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso eliminado.');
    }
   public function inscribirse($id)
{
    $user = auth()->user();

    // Verificar si ya está inscrito
    $yaInscrito = Inscripcion::where('curso_id', $id)
        ->where('user_id', $user->id)
        ->exists();

    if ($yaInscrito) {
        return redirect()->back()->with('success', 'Ya estás inscrito en este curso.');
    }

    // Guardar la inscripción
    Inscripcion::create([
        'curso_id' => $id,
        'user_id' => $user->id
    ]);

    return redirect()->back()->with('success', 'Te has inscrito correctamente al curso.');
}
public function desinscribirse($id)
{
    $curso = Curso::findOrFail($id);

    auth()->user()->cursos()->detach($id);

    return redirect()->back()->with('success', 'Te has desinscrito del curso.');
}


public function explorar(Request $request)
{
    $query = Curso::query();

    if ($request->filled('buscar')) {
        $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
    }

    $cursos = $query->latest()->get();

    $inscritos = auth()->check()
        ? auth()->user()->cursos->pluck('id')->toArray()
        : [];

    return view('cursos.explorar', compact('cursos', 'inscritos'));
}


public function verInscritos($id)
{
    $inscripciones = Inscripcion::with('usuario', 'curso')->where('curso_id', $id)->get();
    return view('cursos.inscritos', compact('inscripciones'));
}

public function desinscribir($id)
{
    $inscripcion = Inscripcion::findOrFail($id);
    $inscripcion->delete();

    return redirect()->route('cursos.inscritos')->with('success', 'Usuario desinscrito.');
}


}
