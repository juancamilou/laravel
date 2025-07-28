<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar el formulario de registro
    public function showRegisterForm() {
        return view('auth.register');
    }

    // Registrar usuario
    public function register(Request $request) {
        // Validaciones
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            // Crear el usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'admin', 
                'password' => Hash::make($request->password),
            ]);

            return redirect('/login')->with('success', '¡Registro exitoso! Inicia sesión.');


        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // Mostrar el formulario de login
    public function showLoginForm() {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return auth()->user()->role === 'admin'
                ? redirect()->route('cursos.index')
                : redirect()->route('dashboard');
        }
        
        

        return back()->withErrors(['email' => 'Credenciales inválidas']);
    }

    // Logout
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
public function getUsuariosRegistrados()
{
    $usuarios = User::where('role', 'student')
                    ->select('id', 'name', 'email', 'created_at')
                    ->get();

    return response()->json($usuarios);
}


}
