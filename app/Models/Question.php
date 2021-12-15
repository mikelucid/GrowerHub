<?php

namespace App\Models;


use App\Traits\Adminable;
use App\Traits\RecordsActivity;
use App\Traits\Votable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Spatie\Tags\HasTags;

class Question extends Model implements Viewable
{
	use Votable, RecordsActivity, HasFactory, HasTags, InteractsWithViews;


	protected $fillable = ['id', 'title', 'body', 'tagsArray'];

	protected $appends = ['created_date', 'is_favorited', 'favorites_count', 'body_html', 'tag_list'];

	protected $with = ['user', 'comments'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function tags(): MorphToMany
	{
		return $this->morphToMany(Tag::class, 'taggable');
	}

	public function comments()
	{
		return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
	}


	public function getTagListAttribute()
	{
		return $this->tags->pluck('name->en','id');
	}

	public function getCommentAttribute(){
		return $this->comments()->get();
	}

	public function setTitleAttribute($value)
	{
		$this->attributes['title'] = $value;
		$this->attributes['slug'] = Str::slug($value);
	}

	 public function setBodyAttribute($value)
	 {
	     $this->attributes['body'] = clean($value);
	 }


	public function getUrlAttribute()
	{
		return route('questions.show', $this->slug);
	}

	public function getCreatedDateAttribute()
	{
		return $this->created_at->diffForHumans();
	}

	public function getUniqueViewCount()
	{
		$this->unique_views_count = $this->views()->unique()->count();
	}

	public function getStatusAttribute()
	{
		if ( $this->answers_count > 0 ) {
			if ( $this->best_answer_id ) {
				return "answered-accepted";
			}
			return "answered";
		}
		return "unanswered";
	}

	public function getBodyHtmlAttribute()
	{
		return clean($this->bodyHtml());
	}

	public function answers()
	{
		return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC');
	}

	public function acceptBestAnswer(Answer $answer)
	{
		$this->best_answer_id = $answer->id;
		$this->save();
	}

	public function isAnswered()
	{
		return $this->best_answer_id != null;
	}

	public function favorites()
	{
		return $this->belongsToMany(User::class, 'favorites')->withTimestamps(); //, 'question_id', 'user_id');
	}

	public function isFavorited()
	{
		return $this->favorites()->where('user_id', auth()->id())->count() > 0;
	}

	public function getIsFavoritedAttribute()
	{
		return $this->isFavorited();
	}

	public function getFavoritesCountAttribute()
	{
		return $this->favorites->count();
	}

	public function getExcerptAttribute()
	{
		return $this->excerpt(250);
	}

	public function excerpt($length): string
	{
		return Str::limit(strip_tags($this->bodyHtml()), $length);
	}

	private function bodyHtml(): string
	{
		return markdown()->convertToHtml($this->body);
	}


}
