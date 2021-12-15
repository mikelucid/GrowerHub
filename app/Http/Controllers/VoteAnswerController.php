<?php

namespace App\Http\Controllers;
use App\Gamify\Points\AnswerVote;
use App\Gamify\Points\QuestionAnswered;
use App\Gamify\Points\Vote;
use App\Models\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Answer $answer)
    {
        $vote = (int) request()->vote;

        $votesCount = auth()->user()->voteAnswer($answer, $vote);

	    auth()->user()->givePoint(new Vote($answer));
	    $answer->user->givePoint(new AnswerVote($answer));

	    if(request()->expectsJson()) {
            return response()->json([
                'message' => 'Thanks for the feedback',
                'votesCount' => $votesCount
            ]);
        }

        return back();
    }
}
