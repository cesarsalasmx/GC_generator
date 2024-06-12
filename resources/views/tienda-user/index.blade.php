<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center justify-between text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tiendas por Usuario') }}
            <a href="{{ route('tienda-user.create') }}" class="px-4 py-2 text-white bg-gray-800 rounded ">Crear relacion</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="mb-4">
                        <thead>
                            <tr>
                                <th class="px-6 py-4">Usuario</th>
                                <th class="px-6 py-4">Tiendas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="text-sm border-b border-gray-200">
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">
                                        @foreach($user->tiendas as $tienda)
                                            {{ $tienda->name }}@if(!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4"><a href="{{ route('tienda-user.edit',$user->id) }}" class="text-indigo-600">Ver detalles</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('modal')
</x-app-layout>
