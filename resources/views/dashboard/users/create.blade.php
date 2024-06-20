<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-6 text-2xl font-bold">Registrar Nuevo Usuario</h1>

                    @if (session('success'))
                        <div class="relative px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST" class="p-6 bg-white rounded-lg shadow-md">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block mb-2 font-bold text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block mb-2 font-bold text-gray-700">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block mb-2 font-bold text-gray-700">Contraseña</label>
                            <input type="password" name="password" id="password" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block mb-2 font-bold text-gray-700">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block mb-2 font-bold text-gray-700">Rol</label>
                            <select name="role" id="role" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required>
                                <option value="">Seleccionar Rol</option>
                                <option value="administrator">Administrador</option>
                                <option value="shop_manager">Gerente de Tienda</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between ">
                            <a href="{{ route('dashboard') }}" class="text-indigo-600">Volver</a>
                            <input type="submit" value="Crear lote" class="px-4 py-2 text-white bg-gray-800 rounded ">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @include('modal')
</x-app-layout>
