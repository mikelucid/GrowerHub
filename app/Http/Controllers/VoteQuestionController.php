<?php

namespace App\Http\Controllers;
use App\Gamify\Points\AnswerVote;
use App\Gamify\Points\QuestionVote;
use App\Gamify\Points\Vote;
use App\Models\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Question $question)
    {
        $vote = (int) request()->vote;

        $votesCount = auth()->user()->voteQuestion($question, $vote);

	    auth()->user()->givePoint(new Vote($question));
	    $question->user->givePoint(new QuestionVote($question));

        if(request()->expectsJson()) {
            return response()->json([
                'message' => 'Thanks for the feedback',
                'votesCount' => $votesCount
            ]);
        }

        return back();
    }
}
