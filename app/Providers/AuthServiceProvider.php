<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Question;
use App\Policies\QuestionPolicy;
use App\Models\Answer;
use App\Policies\AnswerPolicy;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Question::class => QuestionPolicy::class,
        Answer::class => AnswerPolicy::class,
	    Comment::class => CommentPolicy::class,
	    User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization Services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
