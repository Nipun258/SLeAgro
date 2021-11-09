<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Farmer
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
       if (Auth::user()->usertype =='Farmer' || Auth::user()->usertype =='Farmer-Buyer') {
            
            return $next($request);

        }else{

            return redirect()->route('dashboard');
        }
    }
}
