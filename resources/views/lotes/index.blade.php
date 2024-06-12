<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center justify-between text-xl font-semibold leading-tight text-gray-800">
            {{ __('Lotes') }}
            <a href="{{ route('lotes.create') }}" class="px-4 py-2 text-white bg-gray-800 rounded ">Crear Lote</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center space-x-2">
                        <form method="GET" action="{{ route('lotes.index') }}" class="flex items-center space-x-2">
                            <label class="text-xs text-gray-700 uppercase">Filtrar por Tienda</label>
                            <select name="tienda_id" id="tienda_id" class="text-xs border-gray-200 rounded">
                                <option value="">Todas las Tiendas</option>
                                @foreach($tiendas as $tienda)
                                    <option value="{{ $tienda->id }}" {{ $selectedTienda == $tienda->id ? 'selected' : '' }}>
                                        {{ $tienda->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-2 py-1 text-xs text-white bg-gray-800 rounded">Filtrar</button>
                        </form>
                    </div>

                    <table class="mb-4">
                        <thead>
                                <td class="px-6 py-4">ID</td>
                                <td class="px-6 py-4">Prefijo</td>
                                <td class="px-6 py-4">Cantidad</td>
                                <td class="px-6 py-4">Valor</td>
                                <td class="px-6 py-4">Vigencia</td>
                                <td class="px-6 py-4">Tienda</td>
                                <td class="px-6 py-4">Ver detalles</td>
                                <td class="px-6 py-4">Giftcards</td>

                        </thead>
                        @foreach($lotes as $lote)
                            <tr class="text-sm border-b border-gray-200">
                                <td class="px-6 py-4"><a href="{{ route('lotes.show',$lote) }}">{{ $lote->id }}</a></td>
                                <td class="px-6 py-4">{{ $lote->prefijo_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->cantidad_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->valor_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->vigencia_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->tienda->name }}</td>
                                <td class="px-6 py-4"><a href="{{ route('lotes.edit',$lote) }}" class="text-indigo-600">Ver detalles</a></td>
                                <td class="px-6 py-4"><a href="{{ route('lotes.show',$lote) }}" class="px-4 py-2 text-white bg-gray-800 rounded">Giftcards del lote</a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $lotes->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('modal')
</x-app-layout>
