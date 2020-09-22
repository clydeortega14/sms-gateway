<?php

namespace App\Http\Traits;
use App\Credentials;

trait ClientsTrait {

	protected function tokenCode()
	{
		return Credentials::where('app_id', request()->header('App-ID'))
            ->where('app_secret', request()->header('App-Secret'))
            ->first();
	}

	protected function branch()
	{
		return request()->headers->has('Br-Code') ? $this->getBranch()->id : null;
	}

	protected function getBranch()
	{
		return $this->tokenCode()->client->branches()->where('id', request()->header('Br-Code'))->first();
	}
}