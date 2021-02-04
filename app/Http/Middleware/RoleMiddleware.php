<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class RoleMiddleware
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
        if(!Auth::check()){
            
              return redirect()->route('auth.auth.login');
           
        }else{
            $permission = Auth::user()->permission;
            if($permission == 0){
                return redirect()->route('auth.auth.login');
            }
        }    
        return $next($request);
    }
}
