<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Question;

class FavoritesController extends Controller
{
    public function store(Question $question)
    {
        $question->favorite();

        if(request()->expectsJson()){
            return response()->json(null, 204);
        }
    }

    public function destroy(Question $question)
    {
        $question->unfavorite();

        if(request()->expectsJson()){
            return response()->json(null, 204);
        }
    }
}
