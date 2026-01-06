<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class verifyEntreprise
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->guard('entreprise')->check())  {
             $user = auth()->guard('entreprise')->user();
            if($user && $user->status == "ACTIVATED" ) {
                return $next($request);
            }else{
                return redirect()->route('login.entreprise');
            }
        }else{
            return redirect()->route('login.entreprise');
        }


    }
}
