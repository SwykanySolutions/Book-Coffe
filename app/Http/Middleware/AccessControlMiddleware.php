<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class AccessControlMiddleware
{
    use AuthorizesRequests;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ignoreResources = config('accesscontrollist')['ignore.resources'];
        $routeName = $request->route()->getName();
        if(!in_array($routeName, $ignoreResources)){
            $this->authorize($routeName);
        }
        return $next($request);
    }
}
