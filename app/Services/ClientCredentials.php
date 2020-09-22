<?php

namespace App\Services;

use App\Services\API\InternalApi;

class ClientCredentials {

	protected $internal_api;

	public function __construct(InternalApi $internal_api)
	{
		$this->http_client = $internal_api;
	}

	public function getToken(array $data)
	{
		return $this->http_client->request('POST', '/oauth/token', [

			'form_params' => [

				'grant_type' => 'client_credentials',
                'client_id' => $data['client_id'],
                'client_secret' => $data['client_secret'],
                'scope' => "",
			]

		]);
	}
}