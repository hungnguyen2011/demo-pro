<?php

namespace App\Repositories;

use App\User;

class UserRepository {
	public static function allUser()
	{
		return User::all();
	}

	public static function createUser(array $attributes)
	{
		return User::create($attributes);
	}

	public static function findUser($id)
	{
		return User::find($id);
	}

	public static function checkMail($request)
    {
        return User::where('email', $request->input('email'))->exists();
    }
}