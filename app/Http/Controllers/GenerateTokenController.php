<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientCredentials;

class GenerateTokenController extends Controller
{
    
    public function accessToken(ClientCredentials $credentials)
    {
        return $credentials->getToken([

            'client_id' => request()->client_id,
            'client_secret' => request()->client_secret
            
        ]);
    }
}
