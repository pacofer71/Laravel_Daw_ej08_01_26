<?php

use App\Livewire\MostrarCategorias;
use App\Livewire\Posts\MostrarUserPosts;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts=Post::with('category', 'user')->where('estado', 'Publicado')->paginate(5);
    return view('welcome', compact('posts'));
})->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('categorias', MostrarCategorias::class)->name('categorias');
    Route::get('posts', MostrarUserPosts::class)->name('posts');
});
