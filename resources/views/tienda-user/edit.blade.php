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
                <form action="{{ route('tienda-user.update', $user->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="tienda_ids">Tiendas</label>
                        <div>
                            @foreach($tiendas as $tienda)
                                <div class="form-check">
                                    <input type="checkbox" name="tienda_ids[]" value="{{ $tienda->id }}" class="form-check-input"
                                    {{ $user->tiendas->contains($tienda->id) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $tienda->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    @include('modal')
</x-app-layout>
