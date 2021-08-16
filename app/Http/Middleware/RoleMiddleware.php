<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        // return "role is null";
        if(!$request->user()->hasRole($role)) {

            // return redirect()->to('welcome');
            abort(404);
        }

        if($permission !== null && !$request->user()->can($permission)) {

              abort(404);
        }

        return $next($request);
    }
}
