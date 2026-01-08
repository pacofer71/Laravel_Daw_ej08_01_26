<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCrearCategoria extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:150', 'unique:categories,nombre'])]
    public string $nombre="";
    #[Validate(['required', 'color'])]
    public string $color="";

    public function guardarCategoriaForm(){
        // VALIDAMOS
        $this->validate();
        //Guardamos
        Category::create($this->all());
    }
    public function canclearForm(){
        $this->resetValidation();
        $this->reset('nombre', 'color');
    }
}
