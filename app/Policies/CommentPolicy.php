<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can update the question.
	 *
	 * @param User $user
	 * @param Comment $comment
	 *
	 * @return mixed
	 */
	public function create(User $user, Comment $comment)
	{
		return $user->id === $comment->user_id;
	}
	/**
	 * Determine whether the user can delete the question.
	 *
	 * @param User $user
	 * @param Comment $comment
	 *
	 * @return mixed
	 */
	public function edit(User $user, Comment $comment)
	{
		return $user->id === $comment->user_id && $comment->answers_count < 1;
	}
	/**
	 * Determine whether the user can delete the question.
	 *
	 * @param User $user
	 * @param Comment $comment
	 *
	 * @return mixed
	 */
	public function delete(User $user, Comment $comment)
	{
		return $user->id === $comment->user_id && $comment->answers_count < 1;
	}
}
