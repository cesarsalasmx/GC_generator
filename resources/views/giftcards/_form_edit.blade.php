@csrf
<label class="text-xs text-gray-700 uppercase">Código de la Giftcard</label>
<span class="text-xs text-red-600">@error('code') {{ $message }} @enderror</span>
<input type="text" name="code" id="code" class="w-full mb-4 border-gray-200 rounded" value="{{ $giftcard->code }}" required disabled/>

<label class="text-xs text-gray-700 uppercase">Pin de activación</label>
<span class="text-xs text-red-600">@error('pin') {{ $message }} @enderror</span>
<input type="number" name="pin" id="pin" class="w-full mb-4 border-gray-200 rounded" value="{{ $giftcard->pin }}" required disabled/>

<label class="text-xs text-gray-700 uppercase">Email</label>
<span class="text-xs text-red-600">@error('emial') {{ $message }} @enderror</span>
<input type="text" name="emial" id="emial" class="w-full mb-4 border-gray-200 rounded" value="{{ $giftcard->emial }}" />

<label class="text-xs text-gray-700 uppercase">Telefono</label>
<span class="text-xs text-red-600">@error('phone') {{ $message }} @enderror</span>
<input type="text" name="phone"  id="phone" class="w-full mb-4 border-gray-200 rounded" value="{{ $giftcard->phone }}" />

<label class="text-xs text-gray-700 uppercase">Status</label>
<span class="text-xs text-red-600">@error('status') {{ $message }} @enderror</span>
<select name="status" id="status" class="w-full mb-4 border-gray-200 rounded">
    <option value="1" {{ $giftcard->status ? 'selected' : '' }}>Activado</option>
    <option value="0" {{ !$giftcard->status ? 'selected' : '' }}>Sin Activar</option>
</select>

<label class="text-xs text-gray-700 uppercase">Valor</label>
<span class="text-xs text-red-600">@error('Valor') {{ $message }} @enderror</span>
<input name="Valor" id="Valor" rows="5" class="w-full mb-4 border-gray-200 rounded" value="{{ $giftcard->lote->valor_gc ?? 'N/A' }}" disabled>

<label class="text-xs text-gray-700 uppercase">Vigencia</label>
<span class="text-xs text-red-600">@error('Vigencia') {{ $message }} @enderror</span>
<input name="Vigencia" id="Vigencia" rows="5" class="w-full mb-4 border-gray-200 rounded" value="{{ $giftcard->lote->vigencia_gc ?? 'N/A'  }}" disabled>

<div class="flex items-center justify-between ">
    <a href="{{ route('lotes.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Actualizar" class="px-4 py-2 text-white bg-gray-800 rounded ">
</div>
