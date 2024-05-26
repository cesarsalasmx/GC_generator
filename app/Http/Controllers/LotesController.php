<?php

namespace App\Http\Controllers;

use App\Models\Giftcards;
use App\Models\Lotes;
use Illuminate\Http\Request;

class LotesController extends Controller
{
    //
    public function index(){
        return view ('lotes.index', [
            'lotes' => Lotes::latest()->paginate()
        ]);
    }
    public function create(Lotes $lote){
        return view ('lotes.create', [
            'lote' => $lote
        ]);
    }
    public function store(Request $request){

        $validated = $request->validate([
            'comentarios' => 'nullable',  // Asegura que el campo no sea nulo
            'cantidad_gc' => 'required',
            'vigencia_gc' => 'required|date|after_or_equal:today',
            'prefijo_gc' => 'nullable|max:10',
            'valor_gc' => 'required'
        ]);
        $lote = $request->user()->Lotes()->create($validated);

        // $data = [
        //     'cantidad' => $request->cantidad_gc,
        //     'vigencia' => $request->vigencia_gc,
        //     'valor' => $request->valor_gc,
        //     'prefijo' => $request->prefijo_gc || ''
        // ];
        for($i=0; $i < $request->cantidad_gc; $i++){
            $giftcard = new Giftcards();
            $giftcard->code = Giftcards::generateUniqueCode($request->prefijo_gc);
            $giftcard->pin = Giftcards::generatePin();
            $giftcard->phone = '';
            $giftcard->email = '';
            $giftcard->status = false;
            $giftcard->lotes_id = $lote->id;
            $giftcard->save();
        }
        return redirect()->route('lotes.edit', $lote);
    }

    public function edit(Lotes $lote){
        return view ('lotes.edit', [
            'lote' => $lote
        ]);
    }
    public function update(Request $request, Lotes $lote){
        $validated = $request->validate([
            'comentarios' => 'nullable',  // Asegura que el campo no sea nulo
            'cantidad_gc' => 'required',
            'vigencia_gc' => 'required|date|after_or_equal:today',
            'prefijo_gc' => 'nullable|max:255',
            'valor_gc' => 'required'
        ]);

        $lote->update($validated);

        return redirect()->route('lotes.edit', $lote);
    }
    public function show($id)
    {
        $lote = Lotes::findOrFail($id);
        $giftcards = $lote->giftcards()->paginate(20);
        return view('lotes.show', compact('lote', 'giftcards'));
    }
}
