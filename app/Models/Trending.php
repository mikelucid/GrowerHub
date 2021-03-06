<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Trending
{
	/**
	 * Fetch all trending threads.
	 *
	 * @return array
	 */
	public function get()
	{
		return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 4));
	}

	/**
	 * Push a new thread to the trending list.
	 *
	 * @param Question $question    
	 */
	public function push($question)
	{
		Redis::zincrby($this->cacheKey(), 1, json_encode([
			'title' => $thread->title,
			'path' => $thread->path()
		]));
	}

	/**
	 * Get the cache key name.
	 *
	 * @return string
	 */
	public function cacheKey()
	{
		return app()->environment('testing')
			? 'testing_trending_threads'
			: 'trending_threads';
	}

	/**
	 * Reset all trending threads.
	 */
	public function reset()
	{
		Redis::del($this->cacheKey());
	}
}
