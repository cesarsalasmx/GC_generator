@csrf
<label class="text-xs text-gray-700 uppercase">Cantidad de GiftCards a crear</label>
<span class="text-xs text-red-600">@error('cantidad_gc') {{ $message }} @enderror</span>
<input type="number" name="cantidad_gc" id="cantidad_gc" class="w-full mb-4 border-gray-200 rounded" value="{{ $lote->cantidad_gc }}" required disabled/>

<label class="text-xs text-gray-700 uppercase">Vigencia de Giftcards</label>
<span class="text-xs text-red-600">@error('vigencia_gc') {{ $message }} @enderror</span>
<input type="date" name="vigencia_gc" id="vigencia_gc" class="w-full mb-4 border-gray-200 rounded" value="{{ $lote->vigencia_gc }}" required disabled/>

<label class="text-xs text-gray-700 uppercase">Valor</label>
<span class="text-xs text-red-600">@error('valor_gc') {{ $message }} @enderror</span>
<input type="text" name="valor_gc" id="valor_gc" class="w-full mb-4 border-gray-200 rounded" value="{{ $lote->valor_gc }}" required/>

<label class="text-xs text-gray-700 uppercase">Prefijo de las giftcards</label>
<span class="text-xs text-red-600">@error('prefijo_gc') {{ $message }} @enderror</span>
<input type="text" name="prefijo_gc"  id="prefijo_gc" class="w-full mb-4 border-gray-200 rounded" value="{{ $lote->prefijo_gc }}" disabled/>

<label class="text-xs text-gray-700 uppercase">Comentarios</label>
<span class="text-xs text-red-600">@error('comentarios') {{ $message }} @enderror</span>
<textarea name="comentarios" id="comentarios" rows="5" class="w-full mb-4 border-gray-200 rounded" >{{ $lote->comentarios }}</textarea>

<label class="text-xs text-gray-700 uppercase">RFC</label>
<span class="text-xs text-red-600">@error('rfc') {{ $message }} @enderror</span>
<input type="text" name="rfc" id="rfc" class="w-full mb-4 border-gray-200 rounded" value="{{ old('rfc',$lote->rfc) }}" required />

<label class="text-xs text-gray-700 uppercase">Razón Social</label>
<span class="text-xs text-red-600">@error('razon_social') {{ $message }} @enderror</span>
<input type="text" name="razon_social" id="razon_social" class="w-full mb-4 border-gray-200 rounded" value="{{ old('razon_social',$lote->razon_social) }}" required />

<div class="flex items-center justify-between ">
    <a href="{{ route('lotes.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Actualizar" class="px-4 py-2 text-white bg-gray-800 rounded ">
</div>
