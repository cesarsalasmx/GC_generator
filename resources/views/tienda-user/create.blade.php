<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Lotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Asociar Usuario a Tiendas") }}
                    <form action="{{ route('tienda-user.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user_id" class="text-xs text-gray-700 uppercase">Seleccionar Usuario</label>
                            <select name="user_id" id="user_id" class="w-full mb-4 border-gray-200 rounded" required>
                                <option value="">-- Selecciona un usuario --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tienda_id" class="text-xs text-gray-700 uppercase">Seleccionar Tienda</label>
                            <select name="tienda_id" id="tienda_id" class="w-full mb-4 border-gray-200 rounded" required>
                                <option value="">-- Selecciona una tienda --</option>
                                @foreach($tiendas as $tienda)
                                    <option value="{{ $tienda->id }}">{{ $tienda->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-between ">
                            <a href="{{ route('tienda-user.index') }}" class="text-indigo-600">Volver</a>
                            <input type="submit" value="Crear lote" class="px-4 py-2 text-white bg-gray-800 rounded ">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('modal')
</x-app-layout>
