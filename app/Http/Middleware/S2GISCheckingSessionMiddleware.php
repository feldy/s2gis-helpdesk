<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cookie;
use Psr\Http\Message\ResponseInterface;

class S2GISCheckingSessionMiddleware
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
//        dd($request);
        if(empty(Cookie::get('username_sid'))) {
            return redirect('../');
        }
        return $next($request);
    }
}
