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
                                <button wire:click="editar({{ $item->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="lanzarAlerta({{ $item->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <!-- ------------------------------------------- Modal para update categoria-------------------------------------- -->
    <x-dialog-modal wire:model="openEditar">
        <x-slot name="title">
            Editar Categoria
        </x-slot>
        <x-slot name="content">
            <div class="space-y-6">

                <!-- Nombre de la categoría -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre de la categoría
                    </label>
                    <input id="name" type="text" placeholder="Ej: Tecnología" wire:model="uform.nombre"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
             placeholder-gray-400 shadow-sm
             focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
             transition" />
                    <x-input-error for="uform.nombre" />
                </div>

                <!-- Color de la categoría -->
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">
                        Color de la categoría
                    </label>
                    <div class="flex items-center gap-4">
                        <input id="color" type="color" wire:model="uform.color"
                            class="h-11 w-16 cursor-pointer rounded-md border border-gray-300 p-1" />
                        <span class="text-sm text-gray-500">
                            Selecciona un color representativo
                        </span>
                    </div>
                    <x-input-error for="uform.color" />
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="update"
                    class="text-white p-2 rounded-xl font-bold bg-green-500 hover:bg-green-700">
                    <i class="fas fa-save mr-1"></i>EDITAR
                </button>
                <button wire:click="cancelar"
                    class="mr-2 text-white p-2 rounded-xl font-bold bg-red-500 hover:bg-red-700">
                    <i class="fas fa-xmark mr-1"></i>CANCELAR
                </button>
            </div>

        </x-slot>
    </x-dialog-modal>
</x-mios.base>
