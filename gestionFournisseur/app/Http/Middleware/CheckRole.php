<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        
        $fournisseur = Auth::guard('fournisseurs')->check();
        
        $user = Auth::guard('responsables')->user();
        if (($fournisseur && in_array('fournisseur', $roles) || (Auth::guard('responsables')->check() && in_array($user->role, $roles)))) {
            return $next($request);
        }
        if(in_array('fournisseur', $roles))
            return redirect()->route('fournisseur.index');
        else
            return redirect()->route('responsable.index');
    }
}
