<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Bilions\FakerImages\FakerImageProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new FakerImageProvider(fake()));
        $image = fake()->image(sys_get_temp_dir(), 640, 480);
        $users=User::all();
        $categorias=Category::all();
        return [
            'titulo'=>fake()->realText(50),
            'contenido'=>fake()->realText(250),
            'estado'=>fake()->randomElement(['Publicado', 'Borrador']),
            'user_id'=>$users->random()->id,
            'category_id'=>$categorias->random()->id,
            'imagen'=>Storage::disk('public')->putFileAs('images/posts', new File($image), basename($image)),
        ];
    }
}
