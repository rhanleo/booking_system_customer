<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Customers;
use Illuminate\Http\Request;
use Redirect;
use Closure;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,  $guard = null)
    {
        if (!Auth::guard($guard)->check() ) {
            return Redirect::route('customer.index');
        }
        return $next($request);
    }
}
