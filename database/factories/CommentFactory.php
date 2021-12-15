<?php

namespace Database\Factories;


use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;

class CommentFactory extends Factory
{
	use HasTags;

	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Comment::class;


	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'body' => rtrim($this->faker->sentence(rand(11, 22)),'.'),
			'user_id' => User::factory(),

			// 'votes_count' => rand(-3, 10)
		];
	}
}