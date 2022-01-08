<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PasswordInit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //if not initialize then password init
        if(is_null(auth()->user()->login_date)){
           
            return redirect('create_password');
          }
         return $next($request);
    }
}
