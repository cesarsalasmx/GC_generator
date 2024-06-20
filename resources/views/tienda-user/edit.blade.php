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
                    <form action="{{ route('tienda-user.update', $user->id) }}" method="POST" class="space-y-6">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label class="block mb-2 text-lg font-semibold leading-tight text-gray-800">Tiendas</label>
                            <div class="space-y-4">
                                @foreach($tiendas as $tienda)
                                    <div class="flex items-center form-check">
                                        <input type="checkbox" name="tienda_ids[]" value="{{ $tienda->id }}" class="mt-1 mr-2 border-gray-200 rounded"
                                            {{ $user->tiendas->contains($tienda->id) ? 'checked' : '' }}>
                                        <label class="text-gray-800">{{ $tienda->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="px-4 py-2 text-white bg-gray-800 rounded">Actualizar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @include('modal')
</x-app-layout>
