<?php

namespace App\Http\Middleware;

use Closure;
use App\Credentials;

class CheckCredentials
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
        $credentials = Credentials::where('access_token', $request->header('access_token'))->first();

        if(is_null($credentials)){

            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
