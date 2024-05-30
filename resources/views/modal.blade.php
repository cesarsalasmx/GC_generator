<!-- Modal -->
<div x-data="{ open: @if(session('success') || session('error')) true @else false @endif }" x-show="open" class="fixed inset-0 z-10 flex items-center justify-center overflow-y-auto">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <!-- Modal content -->
    <div x-show="open" class="w-full mx-4 my-8 transition-all transform bg-white rounded-lg shadow-xl sm:max-w-lg sm:my-0">
        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-green-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                        @if(session('success'))
                            Éxito
                        @elseif(session('error'))
                            Error
                        @endif
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            @if(session('success'))
                                {{ session('success') }}
                            @elseif(session('error'))
                                {{ session('error') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
            <button @click="open = false" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Cerrar
            </button>
        </div>
    </div>
</div>
