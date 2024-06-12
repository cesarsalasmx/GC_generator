@csrf
@method('PUT')
<div>
    <label class="text-xs text-gray-700 uppercase">Nombre:</label>
    <input type="text" name="name" value="{{ $tienda->name }}" class="w-full mb-4 border-gray-200 rounded" required>
</div>
<div>
    <label class="text-xs text-gray-700 uppercase">URL:</label>
    <input type="url" name="url" value="{{ $tienda->url }}" class="w-full mb-4 border-gray-200 rounded" required>
</div>
<div>
    <label class="text-xs text-gray-700 uppercase">Nombre Shopify:</label>
    <input type="text" name="name_shopify" value="{{ $tienda->name_shopify }}" class="w-full mb-4 border-gray-200 rounded" required>
</div>
<div>
    <label class="text-xs text-gray-700 uppercase">Access Token:</label>
    <input type="text" name="access_token" value="{{ $tienda->access_token }}" class="w-full mb-4 border-gray-200 rounded" required>
</div>
<button type="submit">Actualizar</button>
