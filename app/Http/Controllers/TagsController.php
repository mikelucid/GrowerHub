<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Response;

class TagsController extends Controller
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
        //create form loads in modal
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTagRequest $request
     * @return Response
     */
    public function store(StoreTagRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     *
     * @return Response
     */
	public function show(Tag $tag)
	{
		$tag = Tag::getWithType('category');

		views($tag)->record();
		return view('tags.show',compact('tag'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     *
     * @return Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTagRequest $request
     * @param  Tag  $tag
     *
     * @return Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag  $tag
     *
     * @return Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
