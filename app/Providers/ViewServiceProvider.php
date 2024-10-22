<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Vistoria;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Carregar as vistorias para a view específica 'home.imobiliaria'
        View::composer('home.imobiliaria', function ($view) {
            $pendentes = Vistoria::where('id_imobiliaria',  Auth::user()->id)
                ->where('status', 0)
                ->with('locador')
                ->get();
            $view->with('pendentes', $pendentes);
        });

        View::composer('home.imobiliaria', function ($view) {
            $realizadas = Vistoria::where('id_imobiliaria',  Auth::user()->id)
                ->where('status', 1)
                ->with('locador')
                ->get();
            $view->with('realizadas', $realizadas);
        });
        View::composer('home.vistoriador', function ($view) {
            $realizadas = Vistoria::where('id_vistoriador',  Auth::user()->id)
                ->where('status', 1)
                ->with('locador')
                ->get();
            $view->with('realizadas', $realizadas);
        });

        View::composer('home.vistoriador', function ($view) {
            $pendentes = Vistoria::where('id_vistoriador',  Auth::user()->id)
                ->where('status', 0)
                ->with('locador')
                ->get();
            $view->with('pendentes', $pendentes);
        });
    }

    public function register()
    {
        //
    }
}
