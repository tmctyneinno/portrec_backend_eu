<?php

namespace App\Http\Controllers\User\Trait;


trait UserTrait
{
	public function UserID($type = "update")
	{
		$user = auth()->user();
		$this->authorize($type, $user);
		return $user;
	}

	public function condition($id, $userId)
	{
		return [["id", "=", $id], ["user_id", "=",  $userId]];
	}
}
