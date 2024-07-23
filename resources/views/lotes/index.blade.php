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
                                <td class="px-6 py-4">Total/Activadas</td>
                                <td class="px-6 py-4">Valor</td>
                                <td class="px-6 py-4">Vigencia</td>
                                <td class="px-6 py-4">Tienda</td>
                                <td class="px-6 py-4">RFC</td>
                                <td class="px-6 py-4">Razón Social</td>
                                <td class="px-6 py-4">Ver detalles</td>
                                <td class="px-6 py-4">Giftcards</td>

                        </thead>
                        @foreach($lotes as $lote)
                            <tr class="text-sm border-b border-gray-200">
                                <td class="px-6 py-4"><a href="{{ route('lotes.show',$lote) }}">{{ $lote->id }}</a></td>
                                <td class="px-6 py-4">{{ $lote->prefijo_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->cantidad_gc }} / {{ $activeGiftcardsCounts[$lote->id] }}</td>
                                <td class="px-6 py-4">{{ $lote->valor_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->vigencia_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->tienda->name }}</td>
                                <td class="px-6 py-4">{{ $lote->rfc }}</td>
                                <td class="px-6 py-4">{{ $lote->razon_social }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('lotes.edit',$lote) }}" class="flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('lotes.show',$lote) }}" class="flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
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
