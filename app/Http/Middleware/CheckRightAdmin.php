<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRightAdmin
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  $param
     * @return mixed
     */
    public function handle($request, Closure $next, $param, $action)
    {
        // Utilise le paramètre pour des vérifications ou conditions
        if( checkifRight(auth()->user()->role_id, Menu::where('libelle',$param)->first()->id, $action) || Role::where('id',auth()->user()->role_id)->first()->libelle == "SuperAdmin"  ){
            return $next($request);
        }else{
            return redirect()->back()->with('error','Vous n\'avez pas le droit d\'accéder à cette page');
        }

    }
}
