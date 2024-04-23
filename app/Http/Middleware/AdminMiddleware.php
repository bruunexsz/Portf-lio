<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifique se o usuário está autenticado e tem permissão de administrador
        if (!auth()->check() || auth()->user()->Permissao !== 'admin') {
            // Se não tiver permissão, redirecione ou retorne uma resposta de acesso negado
            return redirect()->route('acesso-negado'); // ou return abort(403, 'Acesso negado.');
        }

        // Se o usuário tiver permissão, continue com a solicitação
        return $next($request);
    }
}
