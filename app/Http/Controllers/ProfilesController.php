<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;

class ProfilesController extends Controller
{
	/**
	 * Show the user's profile.
	 *
	 * @param  User $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(User $user)
	{
		return view('profile.show', [
			'user' => $user,
			//'activities' => Activity::feed($user)
		]);
	}
}