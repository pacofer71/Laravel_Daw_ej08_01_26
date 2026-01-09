<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Category;

class FormEditarCategoria extends Form
{
    
    public ?Category $category=null;
    
    public string $nombre="";
    
    #[Validate(['required', 'color'])]
    public string $color="";

    public function setCategoria(Category $category){
        $this->category=$category;
        $this->nombre=$category->nombre;
        $this->color=$category->color;
    }

    public function rules(): array{
        return [
            'nombre'=>[
            'required', 
            'string', 'min:3', 
            'max:150', 
            'unique:categories,nombre,'.$this->category->id
            ],
        ];
    }

    public function editarCategoriaForm(){
        // VALIDAMOS
        $this->validate();
        //Editamos
        $this->category->update($this->all());
        
    }
    public function cancelarForm(){
        $this->resetValidation();
        $this->reset('category', 'nombre', 'color');
    }
}
