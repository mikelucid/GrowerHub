<?php

namespace App\Http\Controllers;

use App\Gamify\Points\AnswerAccepted;
use App\Gamify\Points\PostCreated;
use App\Gamify\Points\QuestionAnswered;
use Illuminate\Http\Request;
use App\Models\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept', $answer);

        $answer->question->acceptBestAnswer($answer);

        //give reputation
	    $answer->user->givePoint(new QuestionAnswered($answer));
	    $answer->question->user->givePoint(new AnswerAccepted($answer));

	    if(request()->expectsJson()){
            return response()->json([
                'message' => 'You have accepted this answer as best answer'
            ]);
        }

        return back();
    }
}
