<div>
    <button class="text-white p-2 rounded-xl font-bold bg-green-500 hover:bg-green-700" wire:click="$set('openCrear', true)">
        <i class="fas fa-add mr-1"></i>NUEVA
    </button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Crear Categoria
        </x-slot>
        <x-slot name="content">
            <div class="space-y-6">

                <!-- Nombre de la categoría -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre de la categoría
                    </label>
                    <input id="name" type="text" placeholder="Ej: Tecnología" wire:model="cform.nombre"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
             placeholder-gray-400 shadow-sm
             focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
             transition" />
             <x-input-error for="cform.nombre" />
                </div>

                <!-- Color de la categoría -->
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">
                        Color de la categoría
                    </label>
                    <div class="flex items-center gap-4">
                        <input id="color" type="color" wire:model="cform.color"
                            class="h-11 w-16 cursor-pointer rounded-md border border-gray-300 p-1" />
                        <span class="text-sm text-gray-500">
                            Selecciona un color representativo
                        </span>
                    </div>
                    <x-input-error for="cform.color" />
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button  wire:click="guardar"
                class="text-white p-2 rounded-xl font-bold bg-green-500 hover:bg-green-700">
                    <i class="fas fa-save mr-1"></i>GUARDAR
                </button>
                <button wire:click="cancelar"
                class="mr-2 text-white p-2 rounded-xl font-bold bg-red-500 hover:bg-red-700">
                    <i class="fas fa-xmark mr-1"></i>CANCLEAR
                </button>
            </div>

        </x-slot>
    </x-dialog-modal>
</div>
