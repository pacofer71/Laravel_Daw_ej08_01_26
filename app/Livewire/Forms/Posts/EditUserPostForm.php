<?php

namespace App\Livewire\Forms\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class EditUserPostForm extends Form
{
    public ?Post $post = null;

    #[Validate(['required', 'string', 'min:3', 'max:150'])]
    public string $titulo = '';

    #[Validate(['required', 'string', 'min:10', 'max:500'])]
    public string $contenido = '';

    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado = '';

    #[Validate(['required', 'exists:categories,id'])]
    public int $category_id = -1;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public ?TemporaryUploadedFile $imagen = null;

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->titulo = $post->titulo;
        $this->contenido = $post->contenido;
        $this->estado = $post->estado;
        $this->category_id = $post->category_id;
    }

    public function editarForm()
    {
        $datos = $this->validate();
        $datos['imagen'] = $this->imagen?->store('images/posts') ?? $this->post->imagen;

        $imagenAnterior = $this->post->imagen;
        $this->post->update($datos);
        // debemos borrar antigua solo si hemos subido una imagen nueva
        // y la anterior NO era default.jpg
        if ($this->imagen && basename($imagenAnterior) != 'default.jpg') {
            Storage::delete($imagenAnterior);
        }
    }

    public function cancelarForm()
    {
        $this->resetvalidation();
        $this->reset();
    }
}
