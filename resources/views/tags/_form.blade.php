@csrf
@formGroup('name')
	{!! Form::label('name', 'Tag Name')!!}
	{!! Form::text('name', old('name', $question->title), [
					'class'      => 'form-control',
					'name'       => 'name',
					'id'         => 'tag-name',
				]) !!}
	@error('name')
@endFormGroup