<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Muestra el formulario para crear un nuevo usuario
    public function create()
    {
        return view('dashboard.users.create');
    }

    // Maneja la solicitud de creación de un nuevo usuario
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string', // Asumiendo que tienes un campo 'role'
        ]);

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Asumiendo que tienes un campo 'role'
        ]);

        // Redirigir a una página de éxito o mostrar un mensaje de éxito
        return redirect()->route('users.create')->with('success', 'Usuario creado exitosamente.');
    }
}
