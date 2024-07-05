<x-app-layout>

    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-900 shadow-lg rounded-sm">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100">Usuario Horarios</h2>
            <div class="mt-4 mb-4">
                <a id="modal-toggle-button"
                    class="flex-shrink-0 bg-green-800 hover:bg-green-900 dark:bg-slate-700 dark:hover:bg-gray-600 text-white dark:text-gray-200 font-semibold px-3 py-2 rounded-md text-sm sm:text-sm ml-1 mr-1">
                    <i class="fas fa-plus mr-1"></i> Añadir
                </a>
            </div>
        </header>
        <div class="p-4">
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full dark:text-slate-300">
                    <!-- Table header -->
                    <thead
                        class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm">
                        <tr>
                            <th class="p-2">
                                <div class="font-semibold text-center">ID</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Usuario</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Horarios</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Acciones</div>
                            </th>

                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                        <!-- Row -->
                        @foreach ($usuariohorarios as $h)
                            <tr>
                                <td class="p-2">
                                    <div class="text-center text-emerald-500">{{ $h->id }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center text-slate-800 dark:text-slate-100">{{ $h->User->name }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center text-slate-800 dark:text-slate-100">{{ $h->Horario->dia}} : {{ $h->Horario->hora_inicio}} - {{ $h->Horario->hora_fin}}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center text-blue-800">
                                        <a href="#"
                                            onclick="event.preventDefault(); if (confirm('¿Estás seguro de eliminar este usuario?')) { document.getElementById('delete-form-{{ $h->id }}').submit(); }">
                                            <i class="fa fa-trash-alt"></i> Eliminar
                                        </a>
                                        <form id="delete-form-{{ $h->id }}"
                                            action="{{ route('usuariohorarios.destroy', $h->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row -->
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full" style="left: 50%; transform: translateX(-50%);">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Registrar Usuario Horarios
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        id="modal-close-button">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('usuariohorarios.store') }}" method="POST">
                    @csrf
                    <div class="p-4 md:p-5">
                        <div class="mb-4">
                            <label for="usuario" class="block text-sm font-medium text-gray-700">Usuario</label>
                            <select id="usuario" name="usuario" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($usuarios as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="horarios" class="block text-sm font-medium text-gray-700">Horarios</label>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($horarios as $h)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="horarios[]" value="{{ $h->id }}" class="form-checkbox mt-1 block w-4 h-4 text-indigo-600 transition duration-150 ease-in-out">
                                        <span class="ml-2">{{ $h->dia }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="flex-shrink-0 bg-green-800 hover:bg-green-900 dark:bg-slate-700 dark:hover:bg-gray-600 text-white dark:text-gray-200 font-semibold px-3 py-2 rounded-md text-sm sm:text-sm ml-1 mr-1">
                                Agregar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal end -->

    @push('scripts')
        <script>
            // JavaScript para abrir y cerrar el primer modal
            const modalToggleButton = document.getElementById('modal-toggle-button');
            const modalCloseButton = document.getElementById('modal-close-button');
            const crudModal = document.getElementById('crud-modal');

            modalToggleButton.addEventListener('click', function() {
                crudModal.classList.toggle('hidden');
            });

            modalCloseButton.addEventListener('click', function() {
                crudModal.classList.add('hidden');
            });
        </script>
    @endpush
</x-app-layout>
