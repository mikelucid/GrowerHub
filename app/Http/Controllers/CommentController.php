<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

	/**
	 * Store a newly created comment in database.
	 *
	 * @param Question $question
	 * @param Request $request
	 *
	 * @return Response
	 */
    public function store(Question $question, Request $request)
    {
	    $comment = $this->createComment($question, $request);

	    if ( $request->expectsJson() ) {
		    return response()->json([
			    'message' => 'Your comment has been created succesfully.',
			    'body' => $comment->body,
		    ]);
	    }
	    return back();
    }

	/**
	 * Store a reply to a omment.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function replyStore(Request $request)
	{
		$reply = new Comment();
		$reply->body = $request->get('comment_body');
		$reply->user()->associate($request->user());
		$reply->parent_id = $request->get('comment_id');
		$post = Post::find($request->get('post_id'));

		$post->comments()->save($reply);

		return back();

	}

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommentRequest $request
     * @param Comment $comment
     *
     * @return Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     *
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

	/**
	 * @param Question $question
	 * @param Request $request
	 *
	 * @return Model
	 */
	public function createComment(Question $question, Request $request)
	{
		$comment = $question->comments()->create($request->only('comment_body'));
		$comment->user()->associate($request->user());
		return $comment;
	}
}
