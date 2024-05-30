<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <header class="bg-white dark:bg-gray-800">
        <nav class="flex items-center justify-between p-6 mx-auto max-w-7xl lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">GC Generator</span>
                    <img class="object-contain w-16 h-16" src="{{ asset('images/logo.jpg') }}" alt="">
                </a>
            </div>
            <div class="lg:flex lg:flex-1 lg:justify-end">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300">Panel de Control <span aria-hidden="true">&rarr;</span></a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300">Log in <span aria-hidden="true">&rarr;</span></a>
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <div class="relative flex items-start justify-center bg-gray-100 dark:bg-gray-900 sm:pt-0">
        <div class="mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    <div class="lg:flex lg:items-center">
                        <div class="flex-shrink-0">
                            <img class="object-cover w-full lg:w-96" style="height: 300px;" src="{{ asset('images/banner.jpg') }}" alt="Banner">
                        </div>
                        <div class="mt-8 text-center lg:mt-0 lg:ml-8 lg:text-left">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">¡Activa tu giftcard hoy!</h2>
                            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Activa tu giftcard y disfruta de nuestros beneficios exclusivos.</p>
                            <a href="{{ url('/activar') }}" class="inline-block px-6 py-3 mt-6 font-semibold text-white bg-gray-900 rounded-lg shadow-md hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">Activar Giftcard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
