<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use QCod\Gamify\Gamify;
use QCod\Gamify\HasReputations;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory, Gamify, HasReputations;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
	    'email',
	    'password',
	    'avatar_path'
    ];

    protected $appends = [
    	'url',
	    'avatar'];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
	    'remember_token',
	    'email'
    ];

	const DEFAULT = 1;
	const VENDOR = 2;
	const MODERATOR = 3;
	const ADMIN = 4;

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'confirmed' => 'boolean'
	];


	/**
	 * Get the route key name for Laravel.
	 */
	public function getRouteKeyName()
	{
		return 'name';
	}

	public function roles(){
		return $this->belongsToMany(Role::class);
	}

	public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute()
    {
        // return route("questions.show", $this->id);
        return '#';
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

	public function activity()
	{
		return $this->hasMany(Activity::class);
	}

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps(); //, 'author_id', 'question_id');
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();

        return $this->_vote($voteQuestions, $question, $vote);
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();

        return $this->_vote($voteAnswers, $answer, $vote);
    }

    private function _vote($relationship, $model, $vote)
    {
        if ($relationship->where('votable_id', $model->id)->exists()) {
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        }
        else {
            $relationship->attach($model, ['vote' => $vote]);
        }

        $model->load('votes');
        $downVotes = (int) $model->downVotes()->sum('vote');
        $upVotes = (int) $model->upVotes()->sum('vote');

        $model->votes_count = $upVotes + $downVotes;
        $model->save();

        return $model->votes_count;
    }

	public function setNameAttribute($value)
	{
		$this->attributes['name'] = $value;
		$this->attributes['slug'] = Str::slug($value);
	}

	public function getAvatarAttribute()
	{
		$email = $this->email;
		$size = 32;

		return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?s=' . $size;
	}

	public function getSlugAttribute($slug){
		return $this->attributes['slug'];
	}

	public function confirm()
	{
		$this->confirmed = true;
		$this->confirmation_token = null;

		$this->save();
	}

	public function read($question)
	{
		cache()->forever(
			$this->visitedThreadCacheKey($question),
			Carbon::now()
		);
	}

	public function getAvatarPathAttribute($avatar)
	{
		return asset($avatar ?: 'images/avatars/default.png');
	}

	public function visitedQuestionCacheKey($question)
	{
		return sprintf('users.%s.visits.%s', $this->id, $question->id);
	}
}
