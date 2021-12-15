<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Tags\Tag as oldTagClass;

class Tag extends oldTagClass
{
    use HasFactory, Prunable;

    protected $fillable = [
    	'name'
    ];

	public function question()
	{
		return $this->morphedByMany(Question::class, 'taggable');
	}

	public function answer()
	{
		return $this->morphedByMany(Answer::class, 'taggable');
	}

	public function prunable()
	{
		$tag = static::where('created_at', '<', now()->subMonths(6))->orWhere('permanent', 0);
		if($tag->get()->count('name') == 1){
			return $tag;
		}
	}

	public function pruning()
	{
		$message = 'Removing tag: '.$this->name . PHP_EOL;
		echo $message;
		Log::info($message);
		$this->getRelations($this);
	}
}
