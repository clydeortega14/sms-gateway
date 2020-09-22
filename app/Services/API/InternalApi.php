<?php

namespace App\Services\API;

use GuzzleHttp\Client;

class InternalApi {

	public function __construct()
	{
		$this->client = new Client([

			'base_uri' => config('app.url')

		]);
	}

	public function request($method, $uri, $data)
	{
		try {

			$response = $this->client->request($method, $uri, $data);
			
			return response()->json(json_decode((string) $response->getBody(), true));
			
		} catch (\GuzzleHttp\Exception\BadResponseException $e) {
			
			if($e->getCode() == 400){

                return response()->json('Bad Request', $e->getCode());

            }else if($e->getCode() == 401){

                return response()->json('Incorrect Credentials', $e->getCode());
                
            }else if($e->getCode() == 500){

            	return response()->json('Internal Server Error', $e->getCode());
            }
		}
	}
}