<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Tecnología' => '#4A90E2', // Azul moderno
            'Salud' => '#7ED321', // Verde fresco
            'Educación' => '#F5A623', // Naranja suave
            'Negocios' => '#9013FE', // Morado profesional
            'Cultura' => '#D0021B',  // Rojo elegante
        ];
        foreach($categorias as $nombre=>$color){
            Category::create([
                'nombre'=>$nombre,
                'color'=>$color
            ]);
            //Category::create(compact('nombre', 'color'));
        }
    }
}
