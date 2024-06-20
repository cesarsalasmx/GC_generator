@csrf
@method('PUT')
<div>
    <label class="text-xs text-gray-700 uppercase">Nombre:</label>
    <span class="text-xs text-red-600">@error('name') {{ $message }} @enderror</span>
    <input type="text" name="name" value="{{ $tienda->name }}" class="w-full mb-4 border-gray-200 rounded" required>
</div>
<div>
    <label class="text-xs text-gray-700 uppercase">URL:</label>
    <span class="text-xs text-red-600">@error('url') {{ $message }} @enderror</span>
    <input type="url" name="url" value="{{ $tienda->url }}" class="w-full mb-4 border-gray-200 rounded" required>
</div>
<div>
    <label class="text-xs text-gray-700 uppercase">Nombre Shopify:</label>
    <span class="text-xs text-red-600">@error('name_shopify') {{ $message }} @enderror</span>
    <input type="text" name="name_shopify" value="{{ $tienda->name_shopify }}" class="w-full mb-4 border-gray-200 rounded" required>
</div>
<div>
    <label class="text-xs text-gray-700 uppercase">Lema de la tienda:</label>
    <span class="text-xs text-red-600">@error('lema') {{ $message }} @enderror</span>
    <input type="text" name="lema" class="w-full mb-4 border-gray-200 rounded" required>
</div>
<div>
    <label class="text-xs text-gray-700 uppercase">Access Token:</label>
    <span class="text-xs text-red-600">@error('access_token') {{ $message }} @enderror</span>
    <input type="text" name="access_token" value="{{ $tienda->access_token }}" class="w-full mb-4 border-gray-200 rounded" required>
</div>
<button type="submit">Actualizar</button>
