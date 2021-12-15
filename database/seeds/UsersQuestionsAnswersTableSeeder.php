<?php

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
	private \Faker\Generator $faker;

	public function __construct()
	{
		$this->faker = Faker::create();
	}
	protected function tags(){
		$tags = explode(' ', $this->faker->sentence(8));
		return $this->faker->randomElements($tags, 3);
	}
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('answers')->delete();
		DB::table('questions')->delete();
		DB::table('users')->delete();
		DB::table('tags')->delete();
		DB::table('comments')->delete();

		User::factory(1)->create([
			'name' => 'admin',
			'password' => Hash::make('admin123'),
			'email' => 'admin@test.com'
		]);

		User::factory(15)
			->create()
			->each(function($user) {
				$user->questions()
					->saveMany(
						Question::factory(rand(1,3))
							->hasAnswers(rand(2,6)))
							->create(['user_id' => $user->id])
							->each(function ($question, $user) {
								$question->attachTags(
									$this->tags(), 'category');
								$question->comments()
									->saveMany(
										Comment::factory(5)
											->make([
												'user_id' => User::all()->random()->id,
												'parent_id' => null,
											])
										);
							})->make();
			});
	}
}

