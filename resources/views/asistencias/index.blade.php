<x-app-layout>

    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-900 shadow-lg rounded-sm">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100">Asistencias</h2>
            <div class="mt-4 mb-4">
                <a href="{{ route('asistencias.create') }}"
                    class="flex-shrink-0 bg-green-800 hover:bg-green-900 dark:bg-slate-700 dark:hover:bg-gray-600 text-white dark:text-gray-200 font-semibold px-3 py-2 rounded-md text-sm sm:text-sm ml-1 mr-1">
                    <i class="fas fa-plus mr-1"></i> Marcar
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
                                <div class="font-semibold text-left">Id</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Usuario</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Descripcion</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Dia</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Hora</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Acciones</div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                        <!-- Row -->
                        @foreach ($asistencias as $u)
                            <tr>
                                <td class="p-2">
                                    <div class="text-center text-emerald-500">{{ $u->id }}</div>
                                </td>
                                <td class="p-2">
                                        <div class="text-center dark:text-slate-100">{{ $u->user->name}}</div>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center dark:text-slate-100">{{ $u->nombre }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center dark:text-slate-100">{{ $u->dia }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center dark:text-slate-100">{{ $u->hora }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center text-blue-800">
                                        <a href="{{ route('asistencias.destroy', $u->id) }}" onclick="event.preventDefault(); if (confirm('¿Estás seguro de eliminar esta asistencia?')) { document.getElementById('delete-form-{{ $u->id }}').submit(); }">
                                            <i class="fa fa-trash-alt"></i> Eliminar
                                        </a>
                                        <form id="delete-form-{{ $u->id }}" action="{{ route('asistencias.destroy', $u->id) }}" method="POST" style="display: none;">
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

</x-app-layout>
