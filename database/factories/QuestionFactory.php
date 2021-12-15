<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;

class QuestionFactory extends Factory
{
	use HasTags;
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Question::class;



	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'title' => rtrim($this->faker->sentence(rand(5, 10)), "."),
			'body' => $this->faker->paragraphs(rand(3, 7), true),
			'views' => rand(0, 10)
			// 'votes_count' => rand(-3, 10)
		];
	}
}