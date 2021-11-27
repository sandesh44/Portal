<?php

namespace App\Http\Middleware;

use Closure;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class IsAdmin
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
        return $next($request);
        if(auth()->user()->is_admin == 1){
            return redirect()->route('admin.dashboard');
            
        }
   
        return $next($request);
    }
}
