<x-app-layout>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    <div class="py-9">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-center text-slate-800 dark:text-slate-100 mt-3 mb-3">Marcar Asistencia</h2>
            <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm">
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-slate-800  border-gray-200">
                    <form action="{{ route('asistencias.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-label for="dia" :value="__('Día')" />
                            <x-input id="dia" class="block mt-1 w-full" type="text" name="dia"
                                value="{{ date('l') }}" readonly />
                        </div>

                        <div class="mb-4">
                            <x-label for="hora" :value="__('Hora')" />
                            <x-input id="hora" class="block mt-1 w-full" type="time" name="hora"
                                value="{{ date('H:i') }}" readonly />
                        </div>

                        <div class="mb-4">
                            <x-label for="huella" :value="__('Huella')" />
                            <x-input id="huella" class="block mt-1 w-full" type="text" name="huella" required />
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <button type="submit"
                                class="bg-green-800 hover:bg-green-900 dark:bg-slate-700 dark:hover:bg-gray-600 text-white dark:text-gray-200 font-semibold px-3 py-2 rounded-md text-sm sm:text-sm">
                                Registrar
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
