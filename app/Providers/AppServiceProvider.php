<?php

namespace App\Providers;

use App\Theme;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer(['layouts.app', 'admin.articulos.create', 'admin.articulos.edit','moderador.articulos.create','moderador.articulos.edit'], function($view){
            $temasTodos = Theme::all();
            $view->with(compact('temasTodos'));
        });
    }
}
