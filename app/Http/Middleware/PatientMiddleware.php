<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PatientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->usertype == 'patient')
        {
            return $next($request);
        }
        
        else
        {
            return redirect('/home')->with('status','You are Not Allowed To Patient Dashboard');
        }
    }
}
