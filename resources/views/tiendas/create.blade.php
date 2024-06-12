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
                    <form action="{{ route('tiendas.store') }}" method="POST">
                        @include('tiendas._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('modal')
</x-app-layout>
