<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ViewerRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$actions): Response
    {
        $user = $request->user();
        if($user->hasRole('admin')){
            return $next($request);
        }
     
        if (!$user || !$user->hasRole('viewer')) {
            abort(403, 'Unauthorized action.');
        }
        
        $routeName = $request->route()->getName();
        $routeParts = explode('.', $routeName);
        $endRouteName = end($routeParts);
    
        if (in_array($endRouteName, $actions)) {
            return $next($request);
        }
    
        abort(403, 'Unauthorized action.');
    }
}
