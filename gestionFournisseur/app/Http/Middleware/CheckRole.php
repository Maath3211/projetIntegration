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
        if (($fournisseur && $roles == 'fournisseur' || (Auth::guard('responsables')->check() && in_array($user->role, $roles)))) {
            return $next($request);
        }

        return redirect()->route('fournisseur.index');
    }
}
