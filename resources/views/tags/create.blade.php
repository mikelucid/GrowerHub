<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
	Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="create-tag" tabindex="-1" role="dialog" aria-labelledby="create-tag-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			{!! Form::open(['route' => 'tags.store', 'method' => 'post']) !!}
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Suggest a new tag</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="well prose">
						<p class="lead">Some things to consider when adding new tags:</p>
						<ul>
							<li>Any tag that exists for <strong>6 months</strong> without more than one use will be automagically pruned.</li>
							<li>A tag should be strong enough that it could, without question or explanation, categorize the question by itself.</li>
							<li>No meta-tags/keyword spam. These will be filtered out when a mod reviews them at the end of the day.</li>
						</ul>
					</div>
						@include ("tags._form", ['buttonText' => "Ask Question"])
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>