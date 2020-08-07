<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientCredentials extends Controller
{
	private $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
		view()->share(['page_title' => 'Credentials']);
	}
    public function index($id)
    {
    	return view('pages.credentials.index')->with('client', $this->client->findOrFail($id));
    }
}
