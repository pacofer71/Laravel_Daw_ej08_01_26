<?php

namespace App\Livewire\Posts;

use App\Livewire\Forms\Posts\EditUserPostForm;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MostrarUserPosts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $campo = 'id';

    public string $orden = 'desc';

    public string $buscar = '';
    public ?Post $post=null;

    public bool $openEditar=false;
    public EditUserPostForm $uform;
    
    #[On('evtPostCreado')]
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
        $categorias = Category::select('nombre', 'id')->orderBy('nombre')->get();

        return view('livewire.posts.mostrar-user-posts', compact('posts', 'categorias'));
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
    // Metodos para borrar post
    public function confirmarBorrar(Post $post){
        $this->authorize('delete', $post);
        $this->post=$post;
        $this->dispatch('evtBorrarPost', destino: 'posts.mostrar-user-posts');
    }
    #[On('evtBorrarOk')]
    public function borrarPost(){
        $imagenPost=$this->post->imagen;
        $this->post->delete();
        //borraré la imagen asociada el post
        if(basename($imagenPost)!='default.jpg'){
            Storage::delete($imagenPost);
        }
        $this->dispatch('mensaje', 'Post Eliminado');
        $this->reset('post');
    }
    //--------------------- Editar registros
    public function editar(Post $post){
        //Comprobamos con las politicas que el post a editar pertenece al usuario logeado
        $this->authorize('update', $post);
        $this->uform->setPost($post);
        $this->openEditar=true;

    }
    public function update(){
        $this->uform->editarForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Post editado');
    }
    public function cancelar(){
        $this->reset('openEditar'); 
        $this->uform->cancelarForm();
    }
    // Funcion para editar solo el estado
    public function editarEstado(Post $post){
        //verificamos que el post al que vamos a cambiar el estado pertenezca al usuario
        $this->authorize('update', $post);
        $estado=$post->estado=='Publicado' ? 'Borrador' : 'Publicado';
        $post->update([
            'estado'=>$estado
        ]);
    }
}
