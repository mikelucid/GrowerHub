@auth
<a href="{{route('profile.show', auth()->user()->slug)}}">Your Profile</a>
@endauth
<h3>Tags</h3>
<ul class="list-unstyled">
	@foreach($sidebar_tags as $tag)
		<li>
			<a href="{{url('tags/'.$tag->slug)}}">{{strtolower($tag->name)}}</a>
		</li>
	@endforeach
</ul>
