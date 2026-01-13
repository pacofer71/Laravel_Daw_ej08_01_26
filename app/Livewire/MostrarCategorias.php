<?php

namespace App\Livewire;

use App\Livewire\Forms\FormEditarCategoria;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarCategorias extends Component
{
    public string $campo="id";
    public string $orden="asc";
    public bool $openEditar=false;
    public FormEditarCategoria $uform;
    public ?Category $category=null;

    #[On('evtCategoriaCreada')]
    public function render()
    {
        $categorias=Category::orderBy($this->campo, $this->orden)->get();
        return view('livewire.mostrar-categorias', compact('categorias'));
    }
    
    public function ordenar(string $campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
        $this->campo=$campo;
    }
    //-- Para borrar una categoria
    public function lanzarAlerta(Category $category){
        $this->category=$category;
        $this->dispatch('evtBorrarCategoria', 'mostrar-categorias');
    }
    #[On('evtBorrarOk')]
    public function borrar(){
        $this->category->delete();  
        $this->dispatch('mensaje', 'Categoria Borrada');
    }
    //------------ Metodos para editar categoria
    public function editar(Category $category){
        $this->uform->setCategoria($category);
        $this->openEditar=true;
    }
    public function cancelar(){
        $this->openEditar=false;
        $this->uform->cancelarForm();
    }
    public function update(){
        $this->uform->editarCategoriaForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Registro editado');
    }

}
