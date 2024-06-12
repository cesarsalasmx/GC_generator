@csrf
<label class="text-xs text-gray-700 uppercase">Cantidad de GiftCards a crear</label>
<span class="text-xs text-red-600">@error('cantidad_gc') {{ $message }} @enderror</span>
<input type="number" name="cantidad_gc" id="cantidad_gc" class="w-full mb-4 border-gray-200 rounded" value="{{ old('cantidad_gc',$lote->cantidad_gc) }}" required />

<label class="text-xs text-gray-700 uppercase">Vigencia de Giftcards</label>
<span class="text-xs text-red-600">@error('vigencia_gc') {{ $message }} @enderror</span>
<input type="date" name="vigencia_gc" id="vigencia_gc" class="w-full mb-4 border-gray-200 rounded" value="{{ old('vigencia_gc',$lote->vigencia_gc) }}" required />

<label class="text-xs text-gray-700 uppercase">Valor</label>
<span class="text-xs text-red-600">@error('valor_gc') {{ $message }} @enderror</span>
<input type="text" name="valor_gc" id="valor_gc" class="w-full mb-4 border-gray-200 rounded" value="{{ old('valor_gc',$lote->valor_gc) }}" required />

<label class="text-xs text-gray-700 uppercase">Prefijo de las giftcards</label>
<span class="text-xs text-red-600">@error('prefijo_gc') {{ $message }} @enderror</span>
<input type="text" name="prefijo_gc" id="prefijo_gc" class="w-full mb-4 border-gray-200 rounded" value="{{ old('prefijo_gc',$lote->prefijo_gc) }}" maxlength="8" />

<label for="tienda_select" class="text-xs text-gray-700 uppercase">Seleccionar Tienda</label>
<span class="text-xs text-red-600">@error('status') {{ $message }} @enderror</span>
<select name="tienda_id" id="tienda_id" class="w-full mb-4 border-gray-200 rounded" required>
    @foreach($tiendas as $tienda)
    <option value="{{ $tienda->id }}">{{ $tienda->name }}</option>
    @endforeach
</select>
<label class="text-xs text-gray-700 uppercase">Comentarios</label>
<span class="text-xs text-red-600">@error('comentarios') {{ $message }} @enderror</span>
<textarea name="comentarios" id="comentarios" rows="5" class="w-full mb-4 border-gray-200 rounded">{{ old('comentarios',$lote->comentarios) }}</textarea>

<div class="flex items-center justify-between ">
    <a href="{{ route('lotes.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Crear lote" class="px-4 py-2 text-white bg-gray-800 rounded ">
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const codeInput = document.getElementById('prefijo_gc');

        codeInput.addEventListener('input', function() {
            // Convertir el valor a mayúsculas
            let value = codeInput.value.toUpperCase();

            // Limitar a 12 caracteres
            if (value.length > 12) {
                value = value.substring(0, 12);
            }

            codeInput.value = value;
        });
    });
</script>
