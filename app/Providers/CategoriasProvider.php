<?php

namespace App\Providers;
use View;
use App\CategoriaReceta;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    //este cuando no se usa nada de laravel
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    //se usa boot cuando tenes que usar cosas de laravel
    public function boot()
    {
        View::composer('*', function ($view) {
            $categorias = CategoriaReceta::all();
            $view->with('categorias', $categorias);
        });
    }
}
