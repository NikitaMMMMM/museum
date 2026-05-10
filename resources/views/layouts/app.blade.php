<!DOCTYPE html>
<html lang="ru">

<head>
	@yield('head')
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
	<header>
		@include('partials.site-header')
	</header>

	<main class="container">
		@yield('content')
	</main>

	@('footer')
	@include('partials.site-footer')
	@show

	@yield('scripts')
	<script src="js/app.js"></script>
</body>

</html>