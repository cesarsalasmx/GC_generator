<?php

namespace App\Http\Controllers;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiendas = Tienda::all();
        return view('tiendas.index', compact('tiendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tiendas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            //'lema' => 'required|lema',
            'name_shopify' => 'required',
            'access_token' => 'required',
        ]);
        Tienda::create([
            'name' => $request->name,
            'url' => $request->url,
            'lema' => $request->lema,
            'name_shopify' => $request->name_shopify,
            'access_token' => Crypt::encryptString($request->access_token),
        ]);

        return redirect()->route('tiendas.index')->with('success', 'Tienda creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tienda $tienda)
    {
        return view('tiendas.edit', compact('tienda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tienda $tienda)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            'lema' => 'required|lema',
            'name_shopify' => 'required',
            'access_token' => 'required',
        ]);

        $tienda->update($request->all());

        return redirect()->route('tiendas.index')->with('success', 'Tienda actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tienda $tienda)
    {
        $tienda->delete();

        return redirect()->route('tiendas.index')->with('success', 'Tienda eliminada exitosamente.');
    }
}
