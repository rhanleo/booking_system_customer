<?php

namespace App\Http\Middleware;

use Closure;

class Authkey
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
        $token = $request->header('APP_KEY');
        //print_r($token);exit;
        if($token != 'ejkgUo28WWwXgQzZb2JDr08rLg9tK3osEFsmSAFMkNAX5hdaCCVT1zefWym5'){
            return response()->json(['message' => ' app key not found'], 401);
        }
        return $next($request);
    }
}
