<?php

namespace App\Http\Controllers;
use App\Models\Giftcards;
use App\Models\Lotes;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftcardsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'shop_manager') {
            $loteIds = Lotes::where('user_id', $user->id)->pluck('id');
            $giftcards = GiftCards::whereIn('lotes_id', $loteIds)->latest()->paginate(20);
        } else if ($user->role == 'administrator') {
            $giftcards = GiftCards::latest()->paginate(20);
        } else {
            $giftcards = new LengthAwarePaginator([], 0, 10);
        }
        return view('giftcards.index', [
            'giftcards' => $giftcards
        ]);
    }
    public function edit(GiftCards $giftcard)
    {
        $user = Auth::user();
        $giftcard = GiftCards::with('lote')->findOrFail($giftcard->id);

        if ($user->role == 'shop_manager' && $giftcard->lote->user_id != $user->id) {
            return redirect()->route('giftcards.index')->with('error', 'No autorizado para editar esta giftcard.');
        }
        return view('giftcards.edit', [
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
