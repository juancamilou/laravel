<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class DashboardController extends Controller
{
    public function index()
    {
        $cursos = Curso::latest()->take(5)->get();
        $inscritos = auth()->user()->cursos;

        return view('dashboard', compact('cursos', 'inscritos'));
    }
public function adminDashboard()
{
    $totalCursos = Curso::count();
    $totalEstudiantes = User::where('role', 'student')->count();
    $inscripcionesPorCurso = Curso::withCount('estudiantes')->get();

    return view('admin.dashboard', compact('totalCursos', 'totalEstudiantes', 'inscripcionesPorCurso'));
}
}
