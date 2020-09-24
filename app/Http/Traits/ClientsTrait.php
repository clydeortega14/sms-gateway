<?php

namespace App\Http\Traits;
use App\Credentials;
use App\OauthClient;

trait ClientsTrait {

	protected function tokenCode()
	{
		return Credentials::where('app_id', request()->SMS_APP_ID)->first();
	}

	protected function branch()
	{
		return request()->has($this->branchName()) ? $this->getBranch()->id : null;
	}

	protected function getBranch()
	{
		return $this->tokenCode()->client->branches()->where('id', request()->get($this->branchName()))->first();
	}
	protected function branchName()
	{
		return 'CLIENT_BRANCH_CODE';
	}
}