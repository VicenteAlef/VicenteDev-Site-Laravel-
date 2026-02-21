<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Se o utilizador logado for root ou admin, deixa passar
        if (Auth::check() && (Auth::user()->role === 'root' || Auth::user()->role === 'admin')) {
            return $next($request);
        }

        // Se for apenas editor, redireciona de volta para o dashboard com erro
        return redirect()->route('admin.projetos.index')->withErrors(['Acesso negado. Você não tem permissão para gerenciar usuários.']);
    }
}
