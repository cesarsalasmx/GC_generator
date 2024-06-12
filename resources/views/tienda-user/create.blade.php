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
                            <label for="tienda_id">Seleccionar Tienda</label>
                            <select name="tienda_id" id="tienda_id" class="form-control" required>
                                <option value="">-- Selecciona una tienda --</option>
                                @foreach($tiendas as $tienda)
                                    <option value="{{ $tienda->id }}">{{ $tienda->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_id">Seleccionar Usuario</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">-- Selecciona un usuario --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Asociar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('modal')
</x-app-layout>
