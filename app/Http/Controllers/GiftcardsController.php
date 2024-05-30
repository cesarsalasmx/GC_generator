<?php

namespace App\Http\Controllers;
use App\Models\Giftcards;
use Illuminate\Http\Request;
use App\Helpers\ShopifyHelper;
use App\Helpers\WhatsappHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GiftcardsController extends Controller
{
    public function index(){
        $giftcards = Giftcards::with('lote')->latest()->paginate(20);
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
            'name' => 'required',
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
}
