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
            $dados = Vistoria::where('id_imobiliaria', Auth::user()->id)
                                        ->with('locador')
                                        ->get();
            $view->with('dados', $dados);
        });
    }

    public function register()
    {
        //
    }
}