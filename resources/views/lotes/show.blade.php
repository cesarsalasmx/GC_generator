<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center justify-between text-xl font-semibold leading-tight text-gray-800">
            <span>{{ __('giftcards') }}</span>
            <div>
                <a href="{{ route('lotes.create') }}" class="px-4 py-2 text-white bg-gray-800 rounded ">Crear Lote</a>
                <a href="{{ route('export.pdf', $lote->id) }}" class="px-4 py-2 text-white bg-gray-800 rounded ">Exportar a PDF</a>
                <a href="{{ route('lotes.export', $lote->id) }}" class="px-4 py-2 text-white bg-gray-800 rounded ">Exportar a CSV</a>
            </div>
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
                                <td class="px-6 py-4">Código interno</td>
                                <td class="px-6 py-4">Pin</td>
                                <td class="px-6 py-4">Status</td>
                                <td class="px-6 py-4">Email</td>
                                <td class="px-6 py-4">Phone</td>
                                <td class="px-6 py-4">Vigencia</td>
                                <td class="px-6 py-4">Valor</td>
                                <td class="px-6 py-4">Ver detalles</td>
                                <td class="px-6 py-4">Reenviar mensaje</td>

                        </thead>
                        @foreach($giftcards as $giftcard)
                            <tr class="text-sm border-b border-gray-200">
                                <td class="px-6 py-4">{{ implode('-', str_split($giftcard->internal_code, 4)) }}</td>
                                <td class="px-6 py-4">{{ $giftcard->pin }}</td>
                                <td class="px-6 py-4">{{ $giftcard->status ? 'Activada' : 'Sin activar' }}</td>
                                <td class="px-6 py-4">{{ $giftcard->email }}</td>
                                <td class="px-6 py-4">{{ $giftcard->phone }}</td>
                                <td class="px-6 py-4">{{ $giftcard->lote->vigencia_gc ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $giftcard->lote->valor_gc ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('giftcards.edit',$giftcard) }}" class="flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($giftcard->status)
                                    <a href="{{ route('giftcards.resend',['id' => $giftcard->id]) }}" class="flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path fill-rule="evenodd" d="M5.337 21.718a6.707 6.707 0 0 1-.533-.074.75.75 0 0 1-.44-1.223 3.73 3.73 0 0 0 .814-1.686c.023-.115-.022-.317-.254-.543C3.274 16.587 2.25 14.41 2.25 12c0-5.03 4.428-9 9.75-9s9.75 3.97 9.75 9c0 5.03-4.428 9-9.75 9-.833 0-1.643-.097-2.417-.279a6.721 6.721 0 0 1-4.246.997Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $giftcards->links() }}
                @endif
                </div>
            </div>
        </div>
    </div>
    @include('modal')
</x-app-layout>
