<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CursoController extends Controller
{
    // Mostrar todos los cursos
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
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
            'miniatura' => 'nullable|image|max:2048',
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
    $curso = Curso::findOrFail($id);

    if (auth()->user()->role === 'student') {
        auth()->user()->cursos()->syncWithoutDetaching([$id]);
        return redirect()->back()->with('success', 'Te has inscrito correctamente al curso.');
    }

    return redirect()->back()->with('error', 'Solo los estudiantes pueden inscribirse.');
}
public function desinscribirse($id)
{
    $curso = Curso::findOrFail($id);

    if (auth()->user()->role === 'student') {
        auth()->user()->cursos()->detach($id);
        return redirect()->back()->with('success', 'Te has desinscrito del curso.');
    }

    return redirect()->back()->with('error', 'Solo los estudiantes pueden desinscribirse.');
}

public function explorar(Request $request)
{
    $query = Curso::query();

    // Buscar por nombre
    if ($request->filled('buscar')) {
        $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
    }

    // Puedes agregar más filtros aquí (por ejemplo por categoría si existiera)
    $cursos = $query->latest()->get();

    return view('cursos.explorar', compact('cursos'));
}
public function verInscritos($id) {
    $curso = Curso::with('estudiantes')->findOrFail($id);
    return view('admin.inscritos', compact('curso'));
}

}
