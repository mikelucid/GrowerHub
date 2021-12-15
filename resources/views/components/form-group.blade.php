<div class="form-group">
    {{slot}}
    {{$errors->first($expression, '<span class=\"help-block\">:message</span>'); ?>}}

	@if ($errors->has($name))
		@foreach ($errors->get($name) as $error)
			<p class="mt-2 text-sm text-red-600">{{ $error }}</p>
		@endforeach
	@endif
</div>