<?php

namespace App\Http\Controllers;

use App\Models\Giftcards;
use App\Models\Lotes;
use App\Models\Tienda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class LotesController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $tiendaId = $request->get('tienda_id');
        $query = Lotes::query();
        $tiendas = Tienda::all();
        if ($user->role == 'shop_manager') {
            $query->where('user_id', $user->id);
            $tiendas = $user->tiendas;
        } else if ($user->role != 'administrator') {
            // Si el usuario no es administrador ni shop_manager, retorna un paginador vacío
            $lotes = new LengthAwarePaginator([], 0, 10);
            $tiendas = new LengthAwarePaginator([], 0, 10);
            return view('lotes.index', [
                'lotes' => $lotes,
                'tiendas' => $tiendas,
                'selectedTienda' => $tiendaId
            ]);
        }

        if ($tiendaId) {
            $query->where('tienda_id', $tiendaId);
        }
        $lotes = $query->latest()->paginate();
        return view ('lotes.index', [
            'lotes' => $lotes,
            'tiendas' => $tiendas,
            'selectedTienda' => $tiendaId
        ]);
    }
    public function create(Lotes $lote){
        $user = Auth::user();
        if($user->role == 'shop_manager'){
            $tiendas = $user->tiendas;
        }else if($user->role == 'administrator'){
            $tiendas = Tienda::all();
        }else {
            $tiendas = new LengthAwarePaginator([], 0, 10);
        }
        return view ('lotes.create', compact('lote', 'tiendas'));
    }
    public function store(Request $request){

        $validated = $request->validate([
            'comentarios' => 'nullable',
            'cantidad_gc' => 'required',
            'vigencia_gc' => 'required|date|after_or_equal:today',
            'prefijo_gc' => 'nullable|max:10',
            'valor_gc' => 'required',
            'tienda_id' => 'required'
        ]);
        $lote = $request->user()->Lotes()->create($validated);
        for($i=0; $i < $request->cantidad_gc; $i++){
            $giftcard = new Giftcards();
            $giftcard->code = Giftcards::generateUniqueCode($request->prefijo_gc,16);
            $giftcard->internal_code = GiftCards::generateUniqueCode($request->prefijo_gc,12);
            $giftcard->pin = Giftcards::generatePin();
            $giftcard->phone = '';
            $giftcard->email = '';
            $giftcard->status = false;
            $giftcard->lotes_id = $lote->id;
            $giftcard->save();
        }
        return redirect()->route('lotes.edit', $lote);
    }

    public function edit(Lotes $lote)
    {
        $user = Auth::user();

        if ($user->role == 'shop_manager' && $lote->user_id != $user->id) {
            return redirect()->route('lotes.index')->with('error', 'No autorizado para editar este lote.');
        }
        return view('lotes.edit', [
            'lote' => $lote
        ]);
    }
    public function update(Request $request, Lotes $lote){
        $validated = $request->validate([
            'comentarios' => 'nullable',
            'cantidad_gc' => 'required',
            'vigencia_gc' => 'required|date|after_or_equal:today',
            'prefijo_gc' => 'nullable|max:255',
            'valor_gc' => 'required'
        ]);

        $lote->update($validated);

        return redirect()->route('lotes.edit', $lote);
    }
    public function show($id){
        $user = Auth::user();
        $lote = Lotes::find($id);

        if (!$lote) {
            return redirect()->route('lotes.index')->with('error', 'Lote no encontrado.');
        }

        if ($user->role == 'shop_manager' && $lote->user_id != $user->id) {
            return redirect()->route('lotes.index')->with('error', 'No autorizado para ver las giftcards de este lote.');
        }
        $giftcards = $lote->giftcards()->paginate(20);

        return view('lotes.show', compact('lote', 'giftcards'));
    }
}
