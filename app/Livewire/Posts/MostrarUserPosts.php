<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarUserPosts extends Component
{
    use WithPagination;

    public string $campo = 'id';

    public string $orden = 'desc';

    public string $buscar = '';

    public function render()
    {
        $posts = Post::select('posts.*', 'categories.nombre', 'categories.color')
            ->join('categories', 'categories.id', 'posts.category_id')
            ->where('user_id', Auth::id())    // Auth::id() es lo mismo que Auth::user()->id
            ->where(function ($q) {
                $q->where('titulo', 'like', "%{$this->buscar}%")
                    ->orWhere('contenido', 'like', "%{$this->buscar}%")
                    ->orWhere('estado', 'like', "%{$this->buscar}%")
                    ->orWhere('nombre', 'like', "%{$this->buscar}%");
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);

        return view('livewire.posts.mostrar-user-posts', compact('posts'));
    }

    public function ordenar(string $campo)
    {
        $this->orden = $this->orden == 'asc' ? 'desc' : 'asc';
        $this->campo = $campo;
    }

    //Si quiero buscar en todas las páginas
    public function updatingBuscar(){
        $this->resetPage();
    }
}
