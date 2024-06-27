<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center justify-between text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tiendas') }}
            <a href="{{ route('tiendas.create') }}" class="px-4 py-2 text-white bg-gray-800 rounded ">Crear Tiendas</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="mb-4">
                        <thead>
                            <tr>
                                <th class="px-6 py-4">Nombre</th>
                                <th class="px-6 py-4">URL</th>
                                <th class="px-6 py-4">Nombre Shopify</th>
                                <th class="px-6 py-4">Lema</th>
                                <th class="px-6 py-4">Access Token</th>
                                <th class="px-6 py-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiendas as $tienda)
                                <tr class="text-sm border-b border-gray-200">
                                    <td class="px-6 py-4">{{ $tienda->name }}</td>
                                    <td class="px-6 py-4">{{ $tienda->url }}</td>
                                    <td class="px-6 py-4">{{ $tienda->name_shopify }}</td>
                                    <td class="px-6 py-4">{{ $tienda->lema }}</td>
                                    <td class="px-6 py-4">shpca_********</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('tiendas.edit', $tienda->id) }}">Editar</a>
                                        <form action="{{ route('tiendas.destroy', $tienda->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Eliminar</button>
                                        </form>
                                    </td>
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
