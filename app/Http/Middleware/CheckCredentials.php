<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Traits\ClientsTrait;

class CheckCredentials
{
    use ClientsTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(is_null($this->tokenCode())){

            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);

        }else if(!request()->header('BR_CODE')){

            return response()->json(['status' => 'error', 'message' => 'Branch Code / Branch ID has not been set!'], 401);

        }else if(is_null($this->branch())){

            return response()->json(['status' => 'error', 'message' => 'Branch does not exists'], 403);

        }else if(!$this->branch()->status){

            return response()->json(['status' => 'error', 'message' => 'Your branch is currently inactive right now, Please contact administrator to activate'], 403);
        }

        return $next($request);
    }
}
