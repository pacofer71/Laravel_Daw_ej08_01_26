<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCrearCategoria;
use Livewire\Component;

class CrearCategoria extends Component
{
    public bool $openCrear=false;
    public FormCrearCategoria $cform;
    public function render()
    {
        return view('livewire.crear-categoria');
    }
    public function guardar(){
        $this->cform->guardarCategoriaForm();
        $this->cancelar();
    }
    public function cancelar(){
        $this->cform->canclearForm();
        $this->openCrear=false;
    }
   
}
