<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
        if(!session()->has('role_id')){ 
            return redirect()->route('login');   
        }

        return $next($request);
    }

}