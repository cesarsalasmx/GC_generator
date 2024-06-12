<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Models\User;
use Illuminate\Http\Request;


class TiendaUserController extends Controller
{
    public function index()
    {
        $users = User::with('tiendas')->get();
        return view('tienda-user.index', compact('users'));
    }

    public function create()
    {
        $tiendas = Tienda::all();
        $users = User::all();
        return view('tienda-user.create', compact('tiendas', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tienda_id' => 'required|exists:Tiendas,id',
        ]);

        $user = User::find($request->user_id);
        $user->tiendas()->attach($request->tienda_id);

        return redirect()->route('tienda-user.index')->with('success', 'Relación creada exitosamente');
    }
    public function edit(User $user)
    {
        $tiendas = Tienda::all();
        return view('tienda-user.edit', compact('user', 'tiendas'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'tienda_ids' => 'array',
            'tienda_ids.*' => 'exists:tiendas,id',
        ]);

        // Elimina las tiendas deseleccionadas
        $user->tiendas()->detach($request->tienda_ids);

        return redirect()->route('tienda-user.index')->with('success', 'Relaciones actualizadas correctamente.');
    }
}
