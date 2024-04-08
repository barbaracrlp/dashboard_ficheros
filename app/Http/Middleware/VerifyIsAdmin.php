<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Verificar si es un usuario validado y despues ver si es admin
         * ve al modelo del user agregues al fillable is_admin
         * i en los casts como que es un boolean
         */
        if(Auth::user() && Auth::user()->is_admin){
            return $next($request);
        }

        // abort(403,'You are no allowed to enter this page');
       return redirect('/panel2');
    }
}
