<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado e se está inativo
        if (Auth::check() && !Auth::user()->ativo) {
            // Desloga o usuário
            Auth::logout();

            // Redireciona para a página de login com uma mensagem
            return redirect()->route('login')->with('erro', 'Sua conta foi desativada.');
        }

        return $next($request);
    }
}
