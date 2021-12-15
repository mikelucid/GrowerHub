<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;    

    /**
     * Determine whether the user can update the question.
     *
     * @param User $user
     * @param Question $question
     *
     * @return mixed
     */
    public function update(User $user, Question $question)
    {
        return $user->id === $question->user_id;
    }

    /**
     * Determine whether the user can delete the question.
     *
     * @param User $user
     * @param Question $question
     *
     * @return mixed
     */
    public function delete(User $user, Question $question)
    {
        return $user->id === $question->user_id && $question->answers_count < 1 ||
	        $user->type === User::ADMIN;
    }
}
