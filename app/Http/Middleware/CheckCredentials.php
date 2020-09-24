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

        }else if($this->tokenCode()->status != 1){

            return response()->json(['status' => 'error', 'message' => 'Credentials is not activated!'], 401);

        }else if($request->has($this->branchName()) && 
                ( is_null($this->getBranch()) || 
                !$this->getBranch()->status )){

                return response()->json(['status' => 'error', 'message' => 'Branch Not Foud Or Branch is currently inactive'], 404);
        }

        return $next($request);
    }
}
