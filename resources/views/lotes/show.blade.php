<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center justify-between text-xl font-semibold leading-tight text-gray-800">
            {{ __('giftcards') }}
            <a href="{{ route('lotes.create') }}" class="px-4 py-2 text-white bg-gray-800 rounded ">Crear Lote</a>
            <a href="{{ route('export.pdf', $lote->id) }}" class="px-4 py-2 text-white bg-gray-800 rounded ">Exportar Data</a>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                @if($giftcards->isEmpty())
                    <p>No hay giftcards para este lote.</p>
                @else
                    <table class="mb-4">
                        <thead>
                                <td class="px-6 py-4">Código</td>
                                <td class="px-6 py-4">Pin</td>
                                <td class="px-6 py-4">Status</td>
                                <td class="px-6 py-4">Email</td>
                                <td class="px-6 py-4">Phone</td>
                                <td class="px-6 py-4">Vigencia</td>
                                <td class="px-6 py-4">Valor</td>
                                <td class="px-6 py-4">Editar</td>

                        </thead>
                        @foreach($giftcards as $giftcard)
                            <tr class="text-sm border-b border-gray-200">
                                <td class="px-6 py-4">{{ implode('-', str_split($giftcard->code, 4)) }}</td>
                                <td class="px-6 py-4">{{ $giftcard->pin }}</td>
                                <td class="px-6 py-4">{{ $giftcard->status }}</td>
                                <td class="px-6 py-4">{{ $giftcard->email }}</td>
                                <td class="px-6 py-4">{{ $giftcard->phone }}</td>
                                <td class="px-6 py-4">{{ $giftcard->lote->vigencia_gc ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $giftcard->lote->valor_gc ?? 'N/A' }}</td>
                                <td class="px-6 py-4"><a href="{{ route('giftcards.edit',$giftcard) }}" class="text-indigo-600">Editar</a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $giftcards->links() }}
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
