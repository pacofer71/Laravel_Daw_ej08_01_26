<?php

namespace App\Livewire\Posts;

use App\Livewire\Forms\Posts\CreatePostForm;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePosts extends Component
{
    use WithFileUploads;
    public bool $openCrear=false;
    public CreatePostForm $cform;
    
    public function render()
    {
        $categorias=Category::select('nombre', 'id')->orderBy('nombre')->get();
        return view('livewire.posts.create-posts', compact('categorias'));
    }

    public function guardar(){
        $this->cform->guardarForm();
        $this->cancelar();
        // para mensaje de sweetalert 'Post Creado'
        $this->dispatch('mensaje', 'Post Creado');
        // para que en MostrarUserPost aparezca el nuevo post y no tener que refrescar
        $this->dispatch('evtPostCreado')->to(MostrarUserPosts::class);

    }
    public function cancelar(){
        $this->openCrear=false;  //$this->reset('openCrear');
        $this->cform->cancelarForm();
    }
}
