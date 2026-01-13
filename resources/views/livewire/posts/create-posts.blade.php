<div>
    <button class="p-2 bg-green-500 hover:bg-green-700 text-white font-bold rounded-lg" 
        wire:click="$set('openCrear', true)">
        <i class="fas fa-add mt-1"></i>NUEVO
    </button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Crear Post
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
                        <input type="text" placeholder="Escribe el título del post" wire:model="cform.titulo"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <x-input-error for="cform.titulo" />
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
                        <textarea rows="5" placeholder="Escribe el contenido del post" wire:model="cform.contenido"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                    </div>
                    <x-input-error for="cform.contenido" />
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
                        <select wire:model="cform.category_id"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            <option>Selecciona una categoría</option>
                            @foreach($categorias as $item)
                            <option value="{{ $item->id }}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="cform.category_id" />
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
                            <input type="radio" wire:model="cform.estado" 
                            name="estado" class="text-blue-600 focus:ring-blue-500" value="Publicado">
                            <span class="flex items-center gap-1 text-sm text-gray-700">
                                <i class="fas fa-circle-check text-green-500"></i>
                                Publicado
                            </span>
                        </label>

                        <!-- Borrador -->
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" wire:model="cform.estado" 
                            name="estado" class="text-blue-600 focus:ring-blue-500" value="Borrador">
                            <span class="flex items-center gap-1 text-sm text-gray-700">
                                <i class="fas fa-pen-to-square text-yellow-500"></i>
                                Borrador
                            </span>
                        </label>
                    </div>
                    <x-input-error for="cform.estado" />
                </div>
                <!-- Imagen -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Imagen del post
                    </label>
                    <div class="w-full h-80 bg-gray-200 relative rounded-lg">
                        <input type="file" id="cimagen" class="hidden" accept="image/*" wire:model="cform.imagen" />
                        <label for="cimagen" class="p-2 bg-gray-700 hover:bg-gray-900 rounded-xl text-white absolute bottom-2 right-2">
                            <i class="fas fa-upload mt-1"></i>Subir
                        </label>
                        @isset($cform->imagen)
                        <img src="{{ $cform->imagen->temporaryUrl() }}" class="w-full h-full object-center bg-no-repeat" />
                        @endisset
                    </div>
                </div>
                <x-input-error for="cform.imagen" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="guardar"
                    class="text-white p-2 rounded-xl font-bold bg-green-500 hover:bg-green-700">
                    <i class="fas fa-save mr-1"></i>GUARDAR
                </button>
                <button wire:click="cancelar"
                    class="mr-2 text-white p-2 rounded-xl font-bold bg-red-500 hover:bg-red-700">
                    <i class="fas fa-xmark mr-1"></i>CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
