<?php

namespace App\Http\Traits;
use App\Credentials;

trait ClientsTrait {

	protected function tokenCode()
	{
		return Credentials::where('access_token', request()->header('access_token'))
            ->where('short_code', request()->header('short_code'))
            ->first();
	}

	protected function branch()
	{
		return $this->tokenCode()->client->branches()->where('id', request()->header('BR_CODE'))->first();
	}
}