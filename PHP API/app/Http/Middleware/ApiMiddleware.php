<?php

namespace App\Http\Middleware;

use Closure;

class ApiMiddleware
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


        if($request->bearerToken() !== 'sWCkATuQlzT2solMGTM8BumHnr5CcKtrl70r3kVAK6wuVHPq2nAq1O2M0D4w') {
            return response()->json([
                'state' => 401,
                'message' => 'Clave de API inválida'
            ], 401);
        }
        return $next($request);
    }
}
