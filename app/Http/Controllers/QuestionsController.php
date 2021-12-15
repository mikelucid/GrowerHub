<?php

namespace App\Http\Controllers;


use App\Gamify\Points\AnswerVote;
use App\Gamify\Points\CompletedAnswerView;
use App\Gamify\Points\CompletedQuestionView;
use App\Gamify\Points\IncompletedQuestionView;
use App\Gamify\Points\QuestionAsked;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;
use Illuminate\Http\Response;

class QuestionsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$questions = Question::with('user')->latest()->paginate(10);

		return view('questions.index', compact('questions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$question = new Question();
		$tags = Tag::getWithType('category')->pluck('name')->toArray();;
		$tags = array_combine($tags,$tags);

		return view('questions.create')
			->withQuestion($question)
			->withTags($tags);
	}

	/**
	 * Store a newly created wresource in storage.
	 *
	 * @param AskQuestionRequest $request
	 *
	 * @return AskQuestionRequest
	 */
	public function store(AskQuestionRequest $request)
	{
		$this->createQuestion($request);
		return redirect()->route('questions.index')->with('success', "Your question has been submitted");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Question $question
	 *
	 * @return Response
	 */
	public
	function show(Question $question)
	{
		$question->increment('views');

		$this->awardPoints($question);

		views($question)->record();

		return view('questions.show', compact('question'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Question $question
	 *
	 * @return Response
	 * @throws AuthorizationException
	 */
	public function edit(Question $question)
	{
		$this->authorize("update", $question);
		return view("questions.edit", compact('question'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param Question $question
	 *
	 * @return Response
	 */
	public function update(AskQuestionRequest $request, Question $question)
	{
		$this->authorize("update", $question);

		$question->update($request->only('title', 'body', 'tags'));

		if ( $request->expectsJson() ) {
			return response()->json([
				'message' => "Your question has been updated.",
				'body_html' => $question->body_html,
			]);
		}

		return redirect('/questions')->with('success', "Your question has been updated.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Question $question
	 *
	 * @return Response
	 */
	public function destroy(Question $question)
	{
		$this->authorize("delete", $question);

		$question->delete();

		if ( request()->expectsJson() ) {
			return response()->json([
				'message' => 'Your question has been deleted.'
			]);
		}

		return redirect('/questions')->with('success', "Your question has been deleted.");
	}

	/**
	 * @param AskQuestionRequest $request
	 *
	 */
	public function createQuestion(AskQuestionRequest $request)
	{
		$user = $request->user();
		$question = $user->questions()->create($request->only('title', 'body',));

		$question->attachTags($request->tag_list, 'category');
		$user->givePoint(new QuestionAsked($question));

	}

	/**
	 * @param Question $question
	 */
	public function awardPoints(Question $question): void
	{
		if ( $question->isAnswered() ) {
			$question - r->givePoint(new CompletedQuestionView($question));
			$question->answer->user()->givePoint(new CompletedAnswerView($question));
		}
		$question->user->givePoint(new IncompletedQuestionView($question));
	}
}