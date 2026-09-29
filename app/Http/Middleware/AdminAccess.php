<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == "admin" || Auth::user()->user_type == "superAdmin")
            {   
                return $next($request);
            }
            else
            {
                return redirect('/accounts');
            }
        }
        else
        {
            return redirect('login');
        }
    }
}
