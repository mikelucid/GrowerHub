<?php

namespace App\Traits;

trait Adminable
{
	/**
	 * Returns true if this user is admin
	 *
	 * @return boolean
	 */
	public function isAdmin()
	{
		return \App\Models\Admin::where('id', $this->id)->exists();
	}

	/**
	 * Returns instance of the Admin
	 *
	 * @return mixed
	 */
	public function admin()
	{
		return $this->hasOne(\App\Models\Admin::class, 'id', 'id');
	}
}
