<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isSuperadmin
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
        if (Auth::user()->roles->id == 1) {
            return redirect('menu-management');
        }
        else{
            return redirect('dashboard');

        }
        return $next($request);
    }
}
