<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
	/**
	 * Don't auto-apply mass assignment protection.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * Fetch the associated subject for the activity.
	 *
	 * @return MorphTo
	 */
	public function subject()
	{
		return $this->morphTo();
	}

	/**
	 * Fetch an activity feed for the given user.
	 *
	 * @param User $user
	 * @param int $take
	 *
	 * @return Collection;
	 */
	public static function feed(User $user, int $take = 50)
	{
		return static::where('user_id', $user->id)
			->latest()
			->with('subject')
			->take($take)
			->get()
			->groupBy(function ($activity) {
				return $activity->created_at->format('Y-m-d');
			});
	}
}