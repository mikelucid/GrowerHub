@csrf
@formGroup('title')
    {!!  Form::label('title', 'Question Title')!!}
{!! Form::text('title', old('title', $question->title), [
				'class'      => 'form-control',
				'name'       => 'title',
				'id'         => 'question-title',
			]) !!}
    @error('title')
@endFormGroup

@formGroup('body')
    {!! Form::label('body', 'Explain you question') !!}
    {!! Form::textarea('body', null, [
                    'class'      => 'form-control',
                    'rows'       => 10,
                    'name'       => 'body',
                    'id'         => 'question-body',
                ]) !!}
    @error('body')
@endFormGroup

@formGroup('tag_list')
    {!! Form::label('tag_list', 'Tags') !!}
    {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control', 'multiple']) !!}
    @error('tag_list')
@endFormGroup
<a href="#create-tag" data-toggle="modal" data-target="#create-tag">
    Suggest a new tag...
</a>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
</div>