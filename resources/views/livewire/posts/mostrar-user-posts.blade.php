<x-mios.base>
    <div class="flex items-center justify-between">
        <div>
            <input type="search" placeholder="Buscar..." class="rounded-lg" wire:model.live="buscar" />
        </div>
        @livewire('posts.create-posts')
    </div>
    @if($posts->count())
    <div class="overflow-x-auto bg-white rounded-xl shadow my-2">
        <table class="min-w-full divide-y divide-gray-200">
            <!-- CABECERA -->
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Imagen
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer" wire:click="ordenar('titulo')">
                        <i class="fas fa-sort mr-1"></i>Título
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer" wire:click="ordenar('contenido')">
                        <i class="fas fa-sort mr-1"></i>Contenido
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer whitespace-nowrap" wire:click="ordenar('nombre')">
                        <i class="fas fa-sort mr-1"></i>Categoría
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer" wire:click="ordenar('estado')">
                        <i class="fas fa-sort mr-1"></i>Estado
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase cursor-pointer" wire:click="ordenar('created_at')">
                        <i class="fas fa-sort mr-1"></i>Fecha
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">
                @foreach($posts as $item)
                <tr class="hover:bg-gray-50 transition">
                    <!-- Imagen -->
                    <td class="px-6 py-4">
                        <img src="{{ Storage::url($item->imagen) }}" alt="imagen"
                            class="w-12 h-12 rounded-lg object-cover" />
                    </td>

                    <!-- Título -->
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-900">{{$item->titulo}}</p>
                    </td>

                    <!-- Contenido -->
                    <td class="px-6 py-4">
                        <p class="text-sm text-gray-600">
                            {{ $item->contenido }}
                        </p>
                    </td>

                    <!-- Categoría -->
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full text-white font-medium" style="background-color:{{ $item->color }}">
                            {{ $item->nombre }}
                        </span>
                    </td>

                    <!-- Estado -->
                    <td class="px-6 py-4">
                        <button @class([
                            "px-3 py-1 text-xs rounded-full text-white font-bold",
                            "bg-red-600"=>$item->estado=='Borrador',
                            "bg-green-600"=>$item->estado=='Publicado',
                        ])
                            >
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
                            <button class="text-blue-600 hover:text-blue-800 transition" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800 transition" title="Eliminar" wire:click="confirmarBorrar({{ $item->id }})">
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
</x-mios.base>
