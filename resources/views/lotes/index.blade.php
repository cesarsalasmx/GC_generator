<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center justify-between text-xl font-semibold leading-tight text-gray-800">
            {{ __('lotes') }}
            <a href="{{ route('lotes.create') }}" class="px-4 py-2 text-white bg-gray-800 rounded ">Crear Lote</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="mb-4">
                        <thead>
                                <td class="px-6 py-4">ID</td>
                                <td class="px-6 py-4">Prefijo</td>
                                <td class="px-6 py-4">Cantidad</td>
                                <td class="px-6 py-4">Valor</td>
                                <td class="px-6 py-4">Vigencia</td>
                                <td class="px-6 py-4">Editar</td>

                        </thead>
                        @foreach($lotes as $lote)
                            <tr class="text-sm border-b border-gray-200">
                                <td class="px-6 py-4"><a href="{{ route('lotes.show',$lote) }}">{{ $lote->id }}</a></td>
                                <td class="px-6 py-4">{{ $lote->prefijo_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->cantidad_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->valor_gc }}</td>
                                <td class="px-6 py-4">{{ $lote->vigencia_gc }}</td>
                                <td class="px-6 py-4"><a href="{{ route('lotes.edit',$lote) }}" class="text-indigo-600">Editar</a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $lotes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
