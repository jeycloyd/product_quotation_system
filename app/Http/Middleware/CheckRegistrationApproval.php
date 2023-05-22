<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check if user registration is approved
        if(Auth()->user()->approval_status == 'For Approval'){
            
            // Your existing code to create the view
            $view = view('pages.pending_registration');

            // Convert the view into a response
            $response = response($view);

            return $response;
            
        }else{
            return $next($request);
        }
    }
}
