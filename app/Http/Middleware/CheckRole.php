<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //get the current user's role
        $userRole = auth()->user()->role;

        //check if the role of the current user is admin
        if($userRole == 'admin'){
            return $next($request);
        }else{
            //output forbidden message error
            abort(code: 403);
        }
    }
}
