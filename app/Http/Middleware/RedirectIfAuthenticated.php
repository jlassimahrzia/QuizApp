<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
           /*  // User role
            $role = Auth::user()->role;

            // Check user role
            switch ($role) {
                case '1':
                    return '/enseignant';
                    break;
                case '2':
                    return '/matiere';
                    break;
                case '3':
                    return '/matiere_etudiant';
                    break;
            } */
        }

        return $next($request);
    }
}
