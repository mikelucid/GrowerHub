<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
    	'body',
	    'parent_id'
    ];

	public static function boot()
	{
		parent::boot();

		static::created(function ($comment) {
			$comment->commentable->increment('comment_count');
		});

		static::deleted(function ($comment) {
			$comment->commentable->decrement('comment_count');
		});
	}
	public function commentable()
	{
		return $this->morphTo();
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function replies()
	{
		return $this->hasMany(Comment::class, 'parent_id');
	}

}
