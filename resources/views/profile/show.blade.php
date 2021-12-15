@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h2>Profile</h2>
							<div class="ml-auto">
								<a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Edit Profile
								</a>
							</div>
						</div>
					</div>


					<div class="card-body">
						{{$user->name}}
						{{--<profile-page :question="{{ $question }}"></profile-page>--}}
					</div>
				</div>
			</div>
		</div>
@endsection
