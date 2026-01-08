<x-mios.base>
    <div class="flex flex-row-reverse mb-2">
        @livewire('crear-categoria')
    </div>
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">

            <!-- Header -->
            <thead class="bg-gray-50">
                <tr>
                    <th class="cursor-pointer px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                        wire:click="ordenar('id')">
                        <i class="fas fa-sort mr-1"></i>ID
                    </th>
                    <th wire:click="ordenar('nombre')"
                        class="cursor-pointer px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        <i class="fas fa-sort mr-1"></i>Nombre
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Color
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Acciones
                    </th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="divide-y divide-gray-100">
                @foreach ($categorias as $item)
                    <tr class="hover:bg-gray-50 transition-colors">

                        <!-- ID -->
                        <td class="px-6 py-4 text-sm font-medium text-gray-700">
                            {{ $item->id }}
                        </td>

                        <!-- Nombre -->
                        <td class="px-6 py-4 text-sm text-gray-800">
                            {{ $item->nombre }}
                        </td>

                        <!-- Color -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="h-6 w-6 rounded-md border border-gray-300"
                                    style="background-color:{{ $item->color }}"></span>
                                <span class="text-sm font-mono text-gray-600">
                                    {{ $item->color }}
                                </span>
                            </div>
                        </td>

                        <!-- Acciones -->
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center gap-2">
                                <button
                                    class="rounded-lg bg-blue-50 px-3 py-1.5 text-sm font-medium text-blue-600 hover:bg-blue-100 transition">
                                    Editar
                                </button>
                                <button
                                    class="rounded-lg bg-red-50 px-3 py-1.5 text-sm font-medium text-red-600 hover:bg-red-100 transition">
                                    Borrar
                                </button>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</x-mios.base>
