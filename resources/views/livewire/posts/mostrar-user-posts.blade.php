<x-mios.base>
    <div class="flex items-center justify-between">
        <div>
            <input type="search" placeholder="Buscar..." class="rounded-lg" wire:model.live="buscar" />
        </div>
        @livewire('posts.create-posts')
    </div>
    @if ($posts->count())
        <div class="overflow-x-auto bg-white rounded-xl shadow my-2">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- CABECERA -->
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                            Imagen
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer"
                            wire:click="ordenar('titulo')">
                            <i class="fas fa-sort mr-1"></i>Título
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer"
                            wire:click="ordenar('contenido')">
                            <i class="fas fa-sort mr-1"></i>Contenido
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer whitespace-nowrap"
                            wire:click="ordenar('nombre')">
                            <i class="fas fa-sort mr-1"></i>Categoría
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer"
                            wire:click="ordenar('estado')">
                            <i class="fas fa-sort mr-1"></i>Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer"
                            wire:click="ordenar('created_at')">
                            <i class="fas fa-sort mr-1"></i>Fecha
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-gray-100">
                    @foreach ($posts as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <!-- Imagen -->
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($item->imagen) }}" alt="imagen"
                                    class="w-12 h-12 rounded-lg object-cover" />
                            </td>

                            <!-- Título -->
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $item->titulo }}</p>
                            </td>

                            <!-- Contenido -->
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">
                                    {{ $item->contenido }}
                                </p>
                            </td>

                            <!-- Categoría -->
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs rounded-full text-white font-medium"
                                    style="background-color:{{ $item->color }}">
                                    {{ $item->nombre }}
                                </span>
                            </td>

                            <!-- Estado -->
                            <td class="px-6 py-4">
                                <button @class([
                                    'px-3 py-1 text-xs rounded-full text-white font-bold',
                                    'bg-red-600' => $item->estado == 'Borrador',
                                    'bg-green-600' => $item->estado == 'Publicado',
                                ]) wire:click="editarEstado({{ $item->id }})">
                                    {{ $item->estado }}
                                </button>
                            </td>

                            <!-- Fecha -->
                            <td class="px-6 py-4 text-sm text-gray-500 italic">
                                {{ $item->created_at->format('d/m/Y') }}
                            </td>

                            <!-- Acciones -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-4">
                                    <button class="text-blue-600 hover:text-blue-800 transition" title="Editar"
                                        wire:click="editar({{ $item->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800 transition" title="Eliminar"
                                        wire:click="confirmarBorrar({{ $item->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $posts->links() }}
    @else
        <x-mios.alerta>
            No se encontró ningún post o aún no ha creado ninguno.
        </x-mios.alerta>
    @endif
    <!-- ------------------------- Ventana Modal Para editar Post -------------------------------------------- -->
    @if($uform->post)
    <x-dialog-modal wire:model="openEditar">
        <x-slot name="title">
            Editar Post
        </x-slot>
        <x-slot name="content">
            <div class="space-y-6">
                <!-- TÍTULO -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Título del post
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fas fa-heading"></i>
                        </span>
                        <input type="text" placeholder="Escribe el título del post" wire:model="uform.titulo"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <x-input-error for="uform.titulo" />
                </div>

                <!-- CONTENIDO -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Contenido
                    </label>
                    <div class="relative">
                        <span class="absolute top-3 left-3 text-gray-400">
                            <i class="fas fa-align-left"></i>
                        </span>
                        <textarea rows="5" placeholder="Escribe el contenido del post" wire:model="uform.contenido"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                    </div>
                    <x-input-error for="uform.contenido" />
                </div>

                <!-- CATEGORÍA -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Categoría
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fas fa-tags"></i>
                        </span>
                        <select wire:model="uform.category_id"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            <option>Selecciona una categoría</option>
                            @foreach ($categorias as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="uform.category_id" />
                    </div>
                </div>

                <!-- ESTADO -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Estado del post
                    </label>

                    <div class="flex gap-6">
                        <!-- Publicado -->
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" wire:model="uform.estado" name="estado"
                                class="text-blue-600 focus:ring-blue-500" value="Publicado">
                            <span class="flex items-center gap-1 text-sm text-gray-700">
                                <i class="fas fa-circle-check text-green-500"></i>
                                Publicado
                            </span>
                        </label>

                        <!-- Borrador -->
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" wire:model="uform.estado" name="estado"
                                class="text-blue-600 focus:ring-blue-500" value="Borrador">
                            <span class="flex items-center gap-1 text-sm text-gray-700">
                                <i class="fas fa-pen-to-square text-yellow-500"></i>
                                Borrador
                            </span>
                        </label>
                    </div>
                    <x-input-error for="uform.estado" />
                </div>
                <!-- Imagen -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Imagen del post
                    </label>
                    <div class="w-full h-80 bg-gray-200 relative rounded-lg">
                        <input type="file" id="uimagen" class="hidden" accept="image/*"
                            wire:model="uform.imagen" />
                        <label for="uimagen"
                            class="p-2 bg-gray-700 hover:bg-gray-900 rounded-xl text-white absolute bottom-2 right-2">
                            <i class="fas fa-upload mt-1"></i>Subir
                        </label>
                        @isset($uform->imagen)
                            <img src="{{ $uform->imagen->temporaryUrl() }}"
                                class="w-full h-full object-center bg-no-repeat" />
                        @else
                            <img src="{{ Storage::url($uform->post->imagen) }}"
                                class="w-full h-full object-center bg-no-repeat" />
                        @endisset
                    </div>
                </div>
                <x-input-error for="uform.imagen" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="update" wire:loading.attr='disable'
                    class="text-white p-2 rounded-xl font-bold bg-green-500 hover:bg-green-700">
                    <i class="fas fa-edit mr-1"></i>EDITAR
                </button>
                <button wire:click="cancelar"
                    class="mr-2 text-white p-2 rounded-xl font-bold bg-red-500 hover:bg-red-700">
                    <i class="fas fa-xmark mr-1"></i>CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endif
</x-mios.base>
