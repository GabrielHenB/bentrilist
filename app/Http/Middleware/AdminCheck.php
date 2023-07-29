<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        if(auth()->user()?->username != "Admin"){
            //This aborts with a error code generating an exception with it
            //Also could be just abort(403);
            abort(403);
            //ddd(auth()->user()->username);
        }

        return $next($request);
    }
}