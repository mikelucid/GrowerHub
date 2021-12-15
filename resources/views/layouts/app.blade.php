<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- Fonts -->
		<link rel="dns-prefetch" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<style>
			.bootstrap-tagsinput .tag {
				margin-right: 2px;
				color: #ffffff;
				background: #2196f3;
				padding: 3px 7px;
				border-radius: 3px;
			}

			.bootstrap-tagsinput {
				width: 100%;
			}

		</style>
	</head>
	<body>
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
				<div class="container">
					<a class="navbar-brand" href="{{ url('/') }}">
						{{ config('app.name', 'CAnnabis Q&A') }}
					</a>
					<button class="navbar-toggler"
					        type="button"
					        data-toggle="collapse"
					        data-target="#navbarSupportedContent"
					        aria-controls="navbarSupportedContent"
					        aria-expanded="false"
					        aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">
							<!-- Authentication Links -->
							@guest
								<li>
									<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
								</li>
								<li>
									<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
								</li>
							@else
								<li class="nav-item dropdown">
									<a id="navbarDropdown"
									   class="nav-link dropdown-toggle"
									   href="#"
									   role="button"
									   data-toggle="dropdown"
									   aria-haspopup="true"
									   aria-expanded="false"
									   v-pre>
										{{ Auth::user()->name }}
										<span class="caret"></span>
									</a>

									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>

										<form id="logout-form"
										      action="{{ route('logout') }}"
										      method="POST"
										      style="display: none;">
											@csrf
										</form>
									</div>
								</li>
							@endguest
						</ul>
					</div>
				</div>
			</nav>
			<main class="container row py-4 px-0 mx-auto">
				<section id="main" class="col-8 py-4">
					@yield('content')
				</section>
				<section id="sidebar" class="col-4">
					@include('layouts._sidebar')
				</section>
			</main>
		</div>

		<!-- Scripts -->
		<script>
			window.Auth = {!! json_encode([
            'signedIn' => Auth::check(),
            'user' => Auth::user()
        ]) !!}
		</script>
		<script src="{{ asset('js/app.js') }}"></script>

	</body>
	@stack('modals')
</html>
