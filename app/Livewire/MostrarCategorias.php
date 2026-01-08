<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class MostrarCategorias extends Component
{
    public string $campo="id";
    public string $orden="asc";
    public function render()
    {
        $categorias=Category::orderBy($this->campo, $this->orden)->get();
        return view('livewire.mostrar-categorias', compact('categorias'));
    }
    public function ordenar(string $campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
        $this->campo=$campo;
    }
}
