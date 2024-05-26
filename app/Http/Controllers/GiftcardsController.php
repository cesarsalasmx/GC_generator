<?php

namespace App\Http\Controllers;
use App\Models\Giftcards;
use Illuminate\Http\Request;
use App\Helpers\ShopifyHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GiftcardsController extends Controller
{
    public function index(){
        $giftcards = Giftcards::with('lote')->paginate(20);
        $shopify = "";
        return view('giftcards.index', compact('giftcards'));
    }
    public function edit(Giftcards $giftcard){
        $giftcard = Giftcards::with('lote')->findOrFail($giftcard->id);
        return view ('giftcards.edit', [
            'giftcard' => $giftcard
        ]);
    }
    public function update(Request $request, Giftcards $giftcard){
        $validated = $request->validate([
            'code' => 'nullable',  // Asegura que el campo no sea nulo
            'pin' => 'required',
            'email' => 'required|date|after_or_equal:today',
            'phone' => 'nullable|max:255',
            'status' => 'required'
        ]);

        $giftcard->update($validated);

        return redirect()->route('giftcards.edit', $giftcard);
    }
    public function activar(){
        return view ('activar');
    }
    public function activate(Request $request)
    {
        $request->validate([
            'code' => 'required|exists:giftcards,code',
            'pin' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        $giftcard = Giftcards::where('code', $request->code)->where('pin', $request->pin)->first();


        if (!$giftcard) {
            return back()->with('error', 'Invalid giftcard code or pin.');
        }

        $giftcard->status = true;
        $giftcard->phone = $request->phone;
        $giftcard->email = $request->email;
        $giftcard->save();
        // Acceder a los datos del lote relacionado
        $vigencia_gc = $giftcard->lotes->vigencia_gc;
        $valor_gc = (float) $giftcard->lotes->valor_gc;
        $fechaFormateada = Carbon::parse($vigencia_gc)->format('Y-m-d');

        $shopify = ShopifyHelper::create_gc($giftcard->code,$valor_gc,$fechaFormateada);
        dd($shopify);
        Log::info('Valor de la variable: ', ['variable' => $shopify]);

        if ($shopify == null) {
            return back()->with('error', 'Error al crear Giftcard en Shopify.');
        }
        return back()->with('success', 'Giftcard activated successfully!');
    }
}
