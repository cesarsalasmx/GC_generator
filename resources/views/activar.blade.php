<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate Giftcard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <!-- Contenedor principal -->
    <div class="flex flex-col min-h-screen">

        <!-- Encabezado -->
        <header class="p-4 text-blue-800 bg-blue-600">
            <div class="container mx-auto text-center">
                <h1 class="text-2xl font-bold">Activa tu Giftcard</h1>
            </div>
        </header>
        <!-- Cuerpo principal -->
        <main class="container flex-grow p-4 mx-auto">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <form method="POST" action="{{ route('giftcards.activate') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="internal_code" class="block text-sm font-medium text-gray-700">Codigo (12 digitos)</label>
                        <input type="text" id="internal_code" name="internal_code"  class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label for="pin" class="block text-sm font-medium text-gray-700">Pin (3 digitos)</label>
                        <input type="text" id="pin" name="pin" maxlength="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                        <input type="tel" id="name" name="name"  class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Número de teléfono</label>
                        <input type="tel" id="phone" name="phone"  class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                        <input type="email" id="email" name="email"  class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <input type="submit" value="Activate Giftcard" class="flex justify-center w-full px-4 py-2 text-sm font-medium bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    </div>
                </form>
            </div>
        </main>
        @include('modal')
        <!-- Pie de página -->
        <footer class="p-4 mt-4 text-white bg-gray-800">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 GC Generator</p>
            </div>
        </footer>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const codeInput = document.getElementById('internal_code');

        codeInput.addEventListener('input', function () {
            let value = codeInput.value.toUpperCase();

            // Elimina espacios y guiones
            value = value.replace(/[\s-]+/g, '');

            // Permitir solo caracteres alfanuméricos
            value = value.replace(/[^a-zA-Z0-9]/g, '');

            // Limitar a 16 caracteres alfanuméricos
            if (value.length > 12) {
                value = value.substring(0, 12);
            }

            // Agrupar en segmentos de 4 caracteres
            let formattedValue = value.match(/.{1,4}/g)?.join('-') || '';

            // Limitar a 19 caracteres en total con guiones
            if (formattedValue.length > 15) {
                formattedValue = formattedValue.substring(0, 15);
            }

            codeInput.value = formattedValue;

            // Mostrar un mensaje de error si el código no es válido
            const errorMessage = document.getElementById('codigo-error');
            if (value.length !== 12) {
                errorMessage.textContent = 'El código debe tener exactamente 16 caracteres alfanuméricos.';
            } else {
                errorMessage.textContent = '';
            }
        });

        // Eliminar guiones antes de enviar el formulario
        const form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            codeInput.value = codeInput.value.replace(/[\s-]+/g, '');
        });
    });
    </script>

</body>
</html>
