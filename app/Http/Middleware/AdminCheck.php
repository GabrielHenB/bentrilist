<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Classe Middleware que faz verificacao de autorizacao
 * atraves de um Gate definido em AppServiceProvider.php
 * Depois pode ser substituida pelo Middleware Can do Laravel
 */
class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*if(auth()->guest()){

            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }
        Devido ao php 8 posso verificar se auth()->user() retornou null ou nao direto no segundo if
        */

        //Agora sim checa se o user esta logado pelo ? e se eh admin
        //O cannot verifica o Gate definido em AppServiceProvider.php
        if(auth()->user()?->cannot('admin')){
            //This aborts with a error code generating an exception with it
            //Also could be just abort(403);
            abort(403);
            //ddd(auth()->user()->username);
        }

        return $next($request);
    }
}
