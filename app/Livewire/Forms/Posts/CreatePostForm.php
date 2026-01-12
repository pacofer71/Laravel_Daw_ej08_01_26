<?php

namespace App\Livewire\Forms\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class CreatePostForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:150'])]
    public string $titulo="";

    #[Validate(['required', 'string', 'min:10', 'max:500'])]
    public string $contenido="";

    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado="";

    #[Validate(['required', 'exists:categories,id'])]
    public int $category_id=-1;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public ?TemporaryUploadedFile $imagen=null;

    public function guardarForm(){
        $datos=$this->validate();
        $datos['user_id']=Auth::id();
        $datos['imagen']=$this->imagen?->store('images/posts') ?? 'images/posts/default.png';
        Post::create($datos);
    }
    public function cancelarForm(){
        $this->resetvalidation();
        $this->reset();
    }


}
