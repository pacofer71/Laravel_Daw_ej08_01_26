<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use Livewire\Component;

class CreatePosts extends Component
{
    public bool $openCrear=false;
    public function render()
    {
        $categorias=Category::select('nombre', 'id')->orderBy('nombre')->get();
        return view('livewire.posts.create-posts', compact('categorias'));
    }
}
