<x-app-layout>
    <x-mios.base>
        <div class="mb-1">
            {{ $posts->links() }}
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach ($posts as $item)
                <article
                    @class([
                        "group flex flex-col overflow-hidden rounded-2xl bg-white",
                        "shadow-md hover:shadow-xl transition-shadow duration-300 h-[420px]",
                        "cols-span-1 md:col-span-2"=>$loop->first
                    ])
                        >

                    <!-- Imagen -->
                    <div class="h-44 overflow-hidden">
                        <img src="{{ Storage::url($item->imagen) }}" alt="Post image"
                            class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" />
                    </div>

                    <!-- Contenido -->
                    <div class="flex flex-col flex-1 p-5">

                        <!-- Categoría -->
                        <span
                            class="mb-3 w-fit text-xs font-semibold px-3 py-1 rounded-full text-white"
                            style="background-color:{{ $item->category->color }}">
                            {{ $item->category->nombre }}
                        </span>

                        <!-- Título -->
                        <h2 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">
                           {{$item->titulo}}
                        </h2>

                        <!-- Descripción -->
                        <p class="text-sm text-gray-600 flex-1">
                            {{ $item->contenido }}
                        </p>

                        <!-- Footer -->
                        <div class="mt-4 pt-4 border-t flex items-center justify-between text-xs text-gray-500">
                            <span class="truncate max-w-[65%]">
                                ✉️ {{ $item->user->email }}
                            </span>
                            <span>
                                {{ $item->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        
    </x-mios.base>
</x-app-layout>
